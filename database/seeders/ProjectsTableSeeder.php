<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProjectsTableSeeder extends Seeder
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
        DB::table('projects')->truncate();
        // Enable foreign key checks
        Schema::enableForeignKeyConstraints();

        $projects = [
            [
                'title' => 'SPIRITUAL MOUNTAIN',
                'slug' => 'spiritual-mountain',
                'description' => 'We believe that Canada’s success is rooted in its Judeo-Christian framework, and that returning to this foundation will bring God’s blessing. We believe in the power of Prayer.',
                'image_path' => 'mountain_images/spiritual.webp',
            ],
            [
                'title' => 'HEALTH MOUNTAIN',
                'slug' => 'health-mountain',
                'description' => 'We believe that respecting natural processes and ingredients is fundamental to achieving and maintaining health. Effective medicine is not about manipulating nature, but about cooperating with God’s creation. Access to clean water for all is crucial for good health.',
                'image_path' => 'mountain_images/health.webp',
            ],
            [
                'title' => 'INFORMATION MOUNTAIN',
                'slug' => 'information-mountain',
                'description' => 'We believe that open dialogue spoken in love is essential for bringing order and truth to minds and lives, and that human beings have a unique ability to create and share information.',
                'image_path' => 'mountain_images/information.webp',
            ],
            [
                'title' => 'FREEDOM MOUNTAIN',
                'slug' => 'freedom-mountain',
                'description' => 'We believe that all people who are willing to use their talents and resources to serve others should have access to a comfortable existence, including affordable housing and sufficient food. We reject scarcity and believe that resources are abundant.',
                'image_path' => 'mountain_images/freedom.webp',
            ],
            [
                'title' => 'FINANCIAL MOUNTAIN',
                'slug' => 'financial-mountain',
                'description' => 'We believe in self-discipline, moderation, and generosity, and reject the corrupt and flawed fiat system. Instead, we advocate for a better financial system backed with assets of true value.',
                'image_path' => 'mountain_images/financial.webp',
            ],
            [
                'title' => 'TRUTH MOUNTAIN',
                'slug' => 'truth-mountain',
                'description' => 'We believe that education should be centred on discovering and applying what we know is true. Education is intended to shape moral character as well as develop intellectual knowledge and support the development of personal ability.',
                'image_path' => 'mountain_images/truth.webp',
            ],
            [
                'title' => 'JUSTICE MOUNTAIN',
                'slug' => 'justice-mountain',
                'description' => 'We believe that families are the primary source of learning justice and fairness, and should be supported in this role. The government’s role is limited to enforcing the law and should not encroach on personal, family, and religious autonomy.',
                'image_path' => 'mountain_images/justice.webp',
            ],
        ];

        DB::table('projects')->insert($projects);
    }
}
