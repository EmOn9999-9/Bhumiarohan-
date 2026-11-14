<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\TeamMember;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DatabaseSeederTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        config(['company.admin.email' => 'admin@example.com', 'company.admin.password' => 'first-password']);
    }

    public function test_it_creates_the_initial_content_on_an_empty_database(): void
    {
        $this->seed(DatabaseSeeder::class);

        $admin = User::sole();
        $this->assertSame('admin@example.com', $admin->email);
        $this->assertTrue(Hash::check('first-password', $admin->password));
        $this->assertSame(8, Service::count());
        $this->assertSame('Rohan Sharma Paudel', TeamMember::sole()->name);
    }

    public function test_running_it_again_keeps_admin_panel_changes(): void
    {
        $this->seed(DatabaseSeeder::class);

        User::sole()->update(['password' => 'changed-in-admin-panel']);
        Service::first()->update(['title' => 'Edited title']);
        Service::latest('id')->first()->delete();

        $this->seed(DatabaseSeeder::class);

        $this->assertTrue(Hash::check('changed-in-admin-panel', User::sole()->password));
        $this->assertSame('Edited title', Service::first()->title);
        $this->assertSame(7, Service::count());
    }

    public function test_it_refuses_to_create_an_admin_without_a_password(): void
    {
        config(['company.admin.password' => null]);

        $this->expectException(\RuntimeException::class);

        $this->seed(DatabaseSeeder::class);
    }
}
