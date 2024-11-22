<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->withPersonalTeam()
            ->hasAttached(Team::factory()->count(3))
            ->create([
                'name' => 'Faisal Ahmed',
                'email' => 'fftfaisal@gmail.com',
            ]);

        $others = User::factory(10)->withPersonalTeam()->create();
        $team = Team::first();
        $others->each(fn ($user) => $user->teams()->attach($team, ['role' => 'editor']));

        $this->call(PermissionSeeder::class);
    }
}
