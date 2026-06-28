<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Certification;
use App\Models\CertificationCategory;
use App\Models\ContactMessage;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Génère un volume de données aléatoires (Faker) pour tester
     * pagination, recherche et filtres dans l'admin. Ne touche pas
     * aux données de démo de DatabaseSeeder (additif uniquement).
     */
    public function run(): void
    {
        Skill::factory()->count(25)->create();
        Experience::factory()->count(8)->create();
        Education::factory()->count(5)->create();
        Testimonial::factory()->count(20)->create();
        Service::factory()->count(12)->create();
        ContactMessage::factory()->count(15)->create();

        $projectCategories = ProjectCategory::factory()->count(5)->create();
        Project::factory()
            ->count(25)
            ->recycle($projectCategories)
            ->create();

        $blogCategories = BlogCategory::factory()->count(4)->create();
        BlogPost::factory()
            ->count(20)
            ->recycle($blogCategories)
            ->create();

        $certificationCategories = CertificationCategory::factory()->count(4)->create();
        Certification::factory()
            ->count(18)
            ->recycle($certificationCategories)
            ->create();
    }
}
