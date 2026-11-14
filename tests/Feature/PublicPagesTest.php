<?php

namespace Tests\Feature;

use App\Models\TeamMember;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_team_page_shows_the_founder_section_above_the_team_cards(): void
    {
        TeamMember::create([
            'name' => 'Rohan Sharma Paudel',
            'role' => 'Founder & Managing Director',
            'qualification' => 'Civil Engineer',
            'bio' => "First paragraph.\n\nSecond paragraph.",
            'quote' => 'Build every structure as if our own family will live in it.',
            'is_active' => true,
            'is_founder' => true,
        ]);
        TeamMember::create(['name' => 'Sita Thapa', 'role' => 'Site Engineer', 'is_active' => true]);

        $this->get(route('team'))
            ->assertOk()
            ->assertSeeInOrder([
                'Rohan Sharma Paudel',
                'Civil Engineer',
                '<p>First paragraph.</p>',
                '<p>Second paragraph.</p>',
                'Build every structure as if our own family will live in it.',
                'Meet the team',
                'Sita Thapa',
            ], false);
    }

    public function test_team_page_without_founder_shows_only_cards(): void
    {
        TeamMember::create(['name' => 'Sita Thapa', 'role' => 'Site Engineer', 'is_active' => true]);

        $this->get(route('team'))
            ->assertOk()
            ->assertSee('Sita Thapa')
            ->assertDontSee('Meet the team');
    }

    public function test_projects_page_shows_the_project_count_in_the_hero(): void
    {
        config(['company.projects_count' => '20+']);

        $this->get(route('projects.index'))
            ->assertOk()
            ->assertSeeInOrder(['Our projects', '20+', 'Projects']);
    }
}
