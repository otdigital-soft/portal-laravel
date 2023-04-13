<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Run the seeder only if it hasn't already been run
        if (! $this->alreadyRun('ProjectsTableSeeder')) {
            User::create([
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'type' => 'admin',
                'password' => Hash::make('adminpass'),
                'status' => 'verified'
            ]);
            $this->call(CategoryDatabaseSeeder::class);
            $this->call(LocationDatabaseSeeder::class);
            $this->call(BeliefsTableSeeder::class);
            $this->call(ProjectsTableSeeder::class);
            $this->markAsRun('ProjectsTableSeeder');
        }
    }

    /**
     * Check if the seeder has already been run.
     *
     * @param  string  $seederName
     * @return bool
     */
    protected function alreadyRun($seederName)
    {
        return DB::table('seeders')->where('seeder', $seederName)->exists();
    }

    /**
     * Mark the seeder as run.
     *
     * @param  string  $seederName
     * @return void
     */
    protected function markAsRun($seederName)
    {
        DB::table('seeders')->insert(['seeder' => $seederName]);
    }
}
