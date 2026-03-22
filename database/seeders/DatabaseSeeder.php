<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Certification;
use App\Models\CertificationCategory;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin User ──────────────────────────────────────────
        User::create([
            'name'     => 'Abdoul Sarba',
            'email'    => 'admin@portfolio.test',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // ── Settings ────────────────────────────────────────────
        $settings = [
            // Hero
            'hero_greeting'    => 'Bonjour, je suis',
            'hero_name'        => 'Abdoul (Sacourou) Sarba',
            'hero_title'       => 'Testeur QA / DevOps Engineer',
            'hero_description' => 'Passionné par la qualité logicielle et l\'automatisation des tests. J\'accompagne les équipes dans la mise en place de pipelines CI/CD robustes et de stratégies de tests efficaces.',
            'hero_location'    => 'France',

            // About
            'about_title'       => 'À propos de moi',
            'about_subtitle'    => 'Mon parcours et mon expertise',
            'about_bio'         => "Ingénieur QA et DevOps avec une solide expérience dans l'automatisation des tests, l'intégration continue et le déploiement continu.\n\nJe maîtrise les outils comme Selenium, Cypress, Jenkins, Docker et Kubernetes pour garantir la qualité et la fiabilité des applications.",
            'about_soft_skills' => 'Rigueur,Esprit d\'analyse,Communication,Travail d\'équipe,Adaptabilité,Résolution de problèmes,Gestion du temps',

            // Contact
            'contact_title'    => 'Contact',
            'contact_subtitle' => 'N\'hésitez pas à me contacter',
            'contact_email'    => 'abdoul.sarba@email.com',
            'contact_phone'    => '+33 6 00 00 00 00',
            'contact_status'   => 'Disponible',

            // Social
            'social_github'   => 'https://github.com/abdoul-sarba',
            'social_linkedin' => 'https://linkedin.com/in/abdoul-sarba',
            'social_twitter'  => '',

            // Sections
            'site_title'              => 'Portfolio QA DevOps',
            'skills_title'            => 'Compétences',
            'skills_subtitle'         => 'Technologies et outils que je maîtrise',
            'projects_title'          => 'Projets phares',
            'projects_subtitle'       => 'Projets récents en QA & DevOps',
            'projects_page_title'     => 'Projets',
            'blog_title'              => 'Derniers articles',
            'blog_subtitle'           => 'Articles sur le QA, DevOps et l\'automatisation',
            'blog_page_title'         => 'Blog',
            'certifications_title'    => 'Certifications',
            'certifications_subtitle' => 'Certifications et accréditations professionnelles',

            // SEO
            'seo_title'       => 'Abdoul Sarba — Testeur QA / DevOps',
            'seo_description' => 'Portfolio de Abdoul Sarba, Testeur Logiciel QA et DevOps Engineer spécialisé en automatisation.',
        ];

        foreach ($settings as $key => $value) {
            Setting::create(['key' => $key, 'value' => $value]);
        }

        // ── Skills ──────────────────────────────────────────────
        $skills = [
            ['name' => 'Selenium',      'icon' => '🔬', 'level' => 90, 'category' => 'Automatisation', 'order' => 1],
            ['name' => 'Cypress',        'icon' => '🌲', 'level' => 85, 'category' => 'Automatisation', 'order' => 2],
            ['name' => 'Playwright',     'icon' => '🎭', 'level' => 80, 'category' => 'Automatisation', 'order' => 3],
            ['name' => 'Postman',        'icon' => '📮', 'level' => 90, 'category' => 'API Testing',    'order' => 4],
            ['name' => 'JMeter',         'icon' => '⚡', 'level' => 75, 'category' => 'Performance',    'order' => 5],
            ['name' => 'Docker',         'icon' => '🐳', 'level' => 85, 'category' => 'DevOps',         'order' => 6],
            ['name' => 'Kubernetes',     'icon' => '☸️', 'level' => 70, 'category' => 'DevOps',         'order' => 7],
            ['name' => 'Jenkins',        'icon' => '🔧', 'level' => 85, 'category' => 'CI/CD',          'order' => 8],
            ['name' => 'GitLab CI',      'icon' => '🦊', 'level' => 80, 'category' => 'CI/CD',          'order' => 9],
            ['name' => 'GitHub Actions', 'icon' => '🐙', 'level' => 80, 'category' => 'CI/CD',          'order' => 10],
            ['name' => 'Jira',           'icon' => '📋', 'level' => 90, 'category' => 'Gestion',        'order' => 11],
            ['name' => 'Git',            'icon' => '🔀', 'level' => 90, 'category' => 'Outils',         'order' => 12],
        ];

        foreach ($skills as $s) {
            Skill::create($s);
        }

        // ── Experiences ─────────────────────────────────────────
        Experience::create([
            'title'       => 'QA Engineer',
            'company'     => 'TechCorp Solutions',
            'start_date'  => '2022-03-01',
            'end_date'    => null,
            'is_current'  => true,
            'description' => "Mise en place de stratégies de tests automatisés (Selenium, Cypress).\nIntégration des tests dans les pipelines CI/CD Jenkins.\nRevue de code et accompagnement des développeurs sur les bonnes pratiques de test.",
            'order'       => 1,
        ]);

        Experience::create([
            'title'       => 'Testeur Logiciel',
            'company'     => 'Digital Agency',
            'start_date'  => '2020-06-01',
            'end_date'    => '2022-02-28',
            'is_current'  => false,
            'description' => "Rédaction de plans de test et de cas de test.\nExécution de campagnes de tests manuels et automatisés.\nSuivi des anomalies et reporting via Jira.",
            'order'       => 2,
        ]);

        Experience::create([
            'title'       => 'Stagiaire QA',
            'company'     => 'StartupLab',
            'start_date'  => '2019-09-01',
            'end_date'    => '2020-05-31',
            'is_current'  => false,
            'description' => "Découverte des méthodologies agiles.\nPremiers pas en automatisation avec Selenium WebDriver.\nParticipation aux sprints et aux rétrospectives.",
            'order'       => 3,
        ]);

        // ── Educations ──────────────────────────────────────────
        Education::create([
            'degree'      => 'Master Qualité Logicielle & Test',
            'school'      => 'Université Paris-Saclay',
            'start_year'  => 2017,
            'end_year'    => 2019,
            'description' => 'Spécialisation en ingénierie de la qualité logicielle, automatisation des tests et gestion de projets IT.',
        ]);

        Education::create([
            'degree'      => 'Licence Informatique',
            'school'      => 'Université de Cergy-Pontoise',
            'start_year'  => 2014,
            'end_year'    => 2017,
            'description' => 'Fondamentaux en programmation, bases de données, réseaux et systèmes.',
        ]);

        // ── Project Categories ──────────────────────────────────
        $pcAutomation = ProjectCategory::create(['name' => 'Automatisation', 'slug' => 'automatisation', 'color' => '#64ffda']);
        $pcCiCd       = ProjectCategory::create(['name' => 'CI/CD',          'slug' => 'ci-cd',          'color' => '#82aaff']);
        $pcPerf       = ProjectCategory::create(['name' => 'Performance',    'slug' => 'performance',    'color' => '#c792ea']);

        // ── Projects ────────────────────────────────────────────
        Project::create([
            'title'       => 'Framework de Tests E2E',
            'slug'        => 'framework-tests-e2e',
            'description' => 'Framework d\'automatisation complet basé sur Cypress pour les tests end-to-end d\'une application SaaS. Intégration avec Jenkins et reporting Allure.',
            'category_id' => $pcAutomation->id,
            'github_url'  => 'https://github.com/abdoul-sarba/e2e-framework',
            'is_featured' => true,
            'order'       => 1,
        ]);

        Project::create([
            'title'       => 'Pipeline CI/CD Multi-environnements',
            'slug'        => 'pipeline-cicd-multi-env',
            'description' => 'Mise en place d\'un pipeline CI/CD avec Docker, Jenkins et Kubernetes pour le déploiement automatisé sur 3 environnements (dev, staging, prod).',
            'category_id' => $pcCiCd->id,
            'github_url'  => 'https://github.com/abdoul-sarba/cicd-pipeline',
            'is_featured' => true,
            'order'       => 2,
        ]);

        Project::create([
            'title'       => 'Tests de Performance API',
            'slug'        => 'tests-performance-api',
            'description' => 'Suite de tests de charge avec JMeter pour valider la scalabilité d\'une API REST. Génération de rapports et intégration dans le pipeline CI.',
            'category_id' => $pcPerf->id,
            'is_featured' => true,
            'order'       => 3,
        ]);

        // ── Blog Categories ─────────────────────────────────────
        $bcQa    = BlogCategory::create(['name' => 'QA',     'slug' => 'qa']);
        $bcDevOps = BlogCategory::create(['name' => 'DevOps', 'slug' => 'devops']);
        $bcAuto   = BlogCategory::create(['name' => 'Automatisation', 'slug' => 'automatisation']);

        // ── Blog Posts ──────────────────────────────────────────
        BlogPost::create([
            'title'        => 'Introduction aux tests automatisés avec Cypress',
            'slug'         => 'introduction-tests-automatises-cypress',
            'excerpt'      => 'Découvrez comment démarrer avec Cypress pour automatiser vos tests front-end.',
            'content'      => "## Pourquoi Cypress ?\n\nCypress est un framework de test moderne conçu pour le web. Contrairement à Selenium, il s'exécute directement dans le navigateur.\n\n### Installation\n\n```bash\nnpm install cypress --save-dev\n```\n\n### Premier test\n\n```javascript\ndescribe('Ma première suite', () => {\n  it('visite la page d\\'accueil', () => {\n    cy.visit('/')\n    cy.contains('Bienvenue')\n  })\n})\n```\n\nCypress offre une excellente expérience développeur avec son runner interactif et ses capacités de débogage.",
            'category_id'  => $bcAuto->id,
            'is_published' => true,
            'published_at' => now()->subDays(5),
        ]);

        BlogPost::create([
            'title'        => 'Mettre en place un pipeline CI/CD avec Jenkins',
            'slug'         => 'pipeline-cicd-jenkins',
            'excerpt'      => 'Guide pas à pas pour configurer un pipeline d\'intégration continue avec Jenkins.',
            'content'      => "## Jenkins et le CI/CD\n\nJenkins est l'outil d'intégration continue le plus utilisé. Voici comment configurer un pipeline pour un projet web.\n\n### Jenkinsfile\n\n```groovy\npipeline {\n    agent any\n    stages {\n        stage('Build') {\n            steps { sh 'npm install' }\n        }\n        stage('Test') {\n            steps { sh 'npm test' }\n        }\n        stage('Deploy') {\n            steps { sh './deploy.sh' }\n        }\n    }\n}\n```\n\nCe pipeline exécute automatiquement le build, les tests et le déploiement à chaque commit.",
            'category_id'  => $bcDevOps->id,
            'is_published' => true,
            'published_at' => now()->subDays(12),
        ]);

        // ── Certification Categories ────────────────────────────
        $ccCloud = CertificationCategory::create(['name' => 'Cloud',     'slug' => 'cloud']);
        $ccQa    = CertificationCategory::create(['name' => 'QA',        'slug' => 'qa']);
        $ccAgile = CertificationCategory::create(['name' => 'Agilité',   'slug' => 'agilite']);

        // ── Certifications ──────────────────────────────────────
        Certification::create([
            'title'       => 'ISTQB Foundation Level',
            'issuer'      => 'ISTQB',
            'issue_date'  => '2021-06-15',
            'category_id' => $ccQa->id,
        ]);

        Certification::create([
            'title'       => 'AWS Certified Cloud Practitioner',
            'issuer'      => 'Amazon Web Services',
            'issue_date'  => '2022-11-20',
            'category_id' => $ccCloud->id,
            'credential_url' => 'https://www.credly.com/badges/example',
        ]);

        Certification::create([
            'title'       => 'Professional Scrum Master I (PSM I)',
            'issuer'      => 'Scrum.org',
            'issue_date'  => '2023-03-10',
            'category_id' => $ccAgile->id,
        ]);
    }
}
