<?php

namespace Database\Seeders;

use App\Models\Belief;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BeliefsTableSeeder extends Seeder
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
        DB::table('beliefs')->truncate();
        // Enable foreign key checks
        Schema::enableForeignKeyConstraints();

        $beliefs = [
            'spiritual',
            'health',
            'information',
            'freedom',
            'financial',
            'truth',
            'justice'
        ];

        $descriptions = [
            'We believe that Canada’s success is rooted in its Judeo-Christian framework, and that returning to this foundation will bring God’s blessing. We believe in the power of Prayer.',
            'We believe that respecting natural processes and ingredients is fundamental to achieving and maintaining health. Effective medicine is not about manipulating nature, but about cooperating with God’s creation. Access to clean water for all is crucial for good health.',
            'We believe that open dialogue spoken in love is essential for bringing order and truth to minds and lives, and that human beings have a unique ability to create and share information.',
            'We believe that all people who are willing to use their talents and resources to serve others should have access to a comfortable existence, including affordable housing and sufficient food. We reject scarcity and believe that resources are abundant.',
            'We believe in self-discipline, moderation, and generosity, and reject the corrupt and flawed fiat system. Instead, we advocate for a better financial system backed with assets of true value.',
            'We believe that education should be centred on discovering and applying what we know is true. Education is intended to shape moral character as well as develop intellectual knowledge and support the development of personal ability.',
            'We believe that families are the primary source of learning justice and fairness, and should be supported in this role. The government’s role is limited to enforcing the law and should not encroach on personal, family, and religious autonomy.',
        ];
        // Generate 10 beliefs
        for ($i = 0; $i <= 6; $i++) {
            Belief::create([
                'name' => $beliefs[$i],
                'description' => $descriptions[$i]
            ]);
        }
    }
}
