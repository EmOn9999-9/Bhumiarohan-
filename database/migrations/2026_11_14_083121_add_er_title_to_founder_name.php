<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Add the "Er." (engineer) title to the founder's name and to the start of his bio.
     */
    public function up(): void
    {
        $this->renameFounder(from: 'Rohan Sharma Paudel', to: 'Er. Rohan Sharma Paudel');
    }

    /**
     * Remove the "Er." title again.
     */
    public function down(): void
    {
        $this->renameFounder(from: 'Er. Rohan Sharma Paudel', to: 'Rohan Sharma Paudel');
    }

    private function renameFounder(string $from, string $to): void
    {
        DB::table('team_members')->where('name', $from)->get(['id', 'bio'])
            ->each(function (object $member) use ($from, $to): void {
                $bio = $member->bio;
                if ($bio !== null && str_starts_with($bio, $from.' ')) {
                    $bio = $to.substr($bio, strlen($from));
                }

                DB::table('team_members')->where('id', $member->id)->update(['name' => $to, 'bio' => $bio]);
            });
    }
};
