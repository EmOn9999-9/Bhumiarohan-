<?php

namespace Tests\Feature;

use App\Mail\NewInquiryMail;
use App\Models\Inquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    private function validSubmission(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Sita Sharma',
            'phone' => '9800000000',
            'email' => 'sita@example.com',
            'service' => 'Renovation',
            'message' => 'I would like to renovate my house in Bharatpur.',
        ], $overrides);
    }

    public function test_submission_is_saved_and_emailed_to_the_company(): void
    {
        Mail::fake();
        config(['company.inquiry_notify' => 'office@example.com']);

        $this->post(route('contact.store'), $this->validSubmission())
            ->assertRedirect()
            ->assertSessionHas('success');

        $inquiry = Inquiry::sole();
        $this->assertSame('Sita Sharma', $inquiry->name);

        Mail::assertSent(NewInquiryMail::class, function (NewInquiryMail $mail) use ($inquiry) {
            return $mail->hasTo('office@example.com')
                && $mail->hasReplyTo('sita@example.com')
                && $mail->inquiry->is($inquiry);
        });
    }

    public function test_email_contains_the_inquiry_details(): void
    {
        $inquiry = Inquiry::create($this->validSubmission());

        $rendered = (new NewInquiryMail($inquiry))->render();

        $this->assertStringContainsString('Sita Sharma', $rendered);
        $this->assertStringContainsString('9800000000', $rendered);
        $this->assertStringContainsString('renovate my house in Bharatpur', $rendered);
    }

    public function test_submission_is_still_saved_when_the_email_fails(): void
    {
        Mail::shouldReceive('to')->andThrow(new \RuntimeException('SMTP down'));

        $this->post(route('contact.store'), $this->validSubmission())
            ->assertSessionHas('success');

        $this->assertDatabaseCount('inquiries', 1);
    }

    public function test_invalid_submission_is_rejected_and_not_emailed(): void
    {
        Mail::fake();

        $this->post(route('contact.store'), $this->validSubmission(['name' => '', 'phone' => 'abc']))
            ->assertSessionHasErrors(['name', 'phone']);

        $this->assertDatabaseCount('inquiries', 0);
        Mail::assertNothingSent();
    }

    public function test_spam_honeypot_submission_is_ignored(): void
    {
        Mail::fake();

        $this->post(route('contact.store'), $this->validSubmission(['website' => 'http://spam.example']))
            ->assertSessionHas('success');

        $this->assertDatabaseCount('inquiries', 0);
        Mail::assertNothingSent();
    }
}
