<x-mail::message>
# New inquiry from the website

Someone has sent a message through the contact form.

<x-mail::table>
| | |
|:--|:--|
| **Name** | {{ $inquiry->name }} |
| **Phone** | {{ $inquiry->phone }} |
| **Email** | {{ $inquiry->email ?: 'Not provided' }} |
| **Service** | {{ $inquiry->service ?: 'Not specified' }} |
| **Received** | {{ $inquiry->created_at->timezone('Asia/Kathmandu')->format('M j, Y g:i A') }} (NPT) |
</x-mail::table>

**Message:**

<x-mail::panel>
{{ $inquiry->message }}
</x-mail::panel>

@if ($inquiry->email)
You can reply to this email directly to respond to {{ $inquiry->name }}.
@else
No email was given, so please call {{ $inquiry->name }} on {{ $inquiry->phone }}.
@endif

<x-mail::button :url="route('admin.inquiries.show', $inquiry)">
Open in admin panel
</x-mail::button>

{{ config('company.legal_name') }}
</x-mail::message>
