<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LocationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks
        Schema::disableForeignKeyConstraints();
        DB::table('locations')->truncate();
        // Enable foreign key checks
        Schema::enableForeignKeyConstraints();

        $locations = [
            'Fort McMurray',
            'Edmonton',
            'Red Deer',
            'Calgary',
            'Medicine Hat',
            'Other Alberta Location'
        ];

        // Generate 6 locations
        for ($i = 0; $i < 6; $i++) {
            Location::create([
                'name' => $locations[$i]
                // 'description' => 'This is location ' . $i,
                // 'latitude' => rand(-90, 90),
                // 'longitude' => rand(-180, 180)
            ]);
        }
    }
}
