<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add a founder flag and a personal quote to team members, and update the founder's
     * existing entry (fixes the "Poudel" spelling and fills in only fields that are empty,
     * so nothing edited in the admin panel is overwritten).
     */
    public function up(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->boolean('is_founder')->default(false)->after('is_active');
            $table->text('quote')->nullable()->after('bio');
        });

        $founder = config('company.founder');

        DB::table('team_members')
            ->whereIn('name', ['Rohan Sharma Poudel', 'Rohan Sharma Paudel'])
            ->get()
            ->each(function (object $member) use ($founder) {
                DB::table('team_members')->where('id', $member->id)->update([
                    'name' => 'Rohan Sharma Paudel',
                    'is_founder' => true,
                    'qualification' => $member->qualification ?: $founder['qualification'],
                    'bio' => $member->bio ?: $founder['bio'],
                    'quote' => $founder['quote'],
                    'updated_at' => now(),
                ]);
            });
    }

    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->dropColumn(['is_founder', 'quote']);
        });
    }
};
