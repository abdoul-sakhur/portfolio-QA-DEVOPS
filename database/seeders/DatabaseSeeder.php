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
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Toutes les écritures utilisent updateOrCreate/firstOrCreate : ce seeder
     * doit pouvoir tourner à chaque démarrage de conteneur (ex: réveil après
     * mise en veille sur un hébergement sans disque persistant) sans dupliquer
     * les données.
     */
    public function run(): void
    {
        // ── Admin User ──────────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'admin@portfolio.test'],
            [
                'name'     => 'Abdoul Sarba',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

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
            'social_whatsapp' => '2250170998499',

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
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
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
            Skill::updateOrCreate(['name' => $s['name']], $s);
        }

        // ── Experiences ─────────────────────────────────────────
        $experiences = [
            [
                'title'       => 'QA Engineer',
                'company'     => 'TechCorp Solutions',
                'start_date'  => '2022-03-01',
                'end_date'    => null,
                'is_current'  => true,
                'description' => "Mise en place de stratégies de tests automatisés (Selenium, Cypress).\nIntégration des tests dans les pipelines CI/CD Jenkins.\nRevue de code et accompagnement des développeurs sur les bonnes pratiques de test.",
                'order'       => 1,
            ],
            [
                'title'       => 'Testeur Logiciel',
                'company'     => 'Digital Agency',
                'start_date'  => '2020-06-01',
                'end_date'    => '2022-02-28',
                'is_current'  => false,
                'description' => "Rédaction de plans de test et de cas de test.\nExécution de campagnes de tests manuels et automatisés.\nSuivi des anomalies et reporting via Jira.",
                'order'       => 2,
            ],
            [
                'title'       => 'Stagiaire QA',
                'company'     => 'StartupLab',
                'start_date'  => '2019-09-01',
                'end_date'    => '2020-05-31',
                'is_current'  => false,
                'description' => "Découverte des méthodologies agiles.\nPremiers pas en automatisation avec Selenium WebDriver.\nParticipation aux sprints et aux rétrospectives.",
                'order'       => 3,
            ],
        ];

        foreach ($experiences as $e) {
            Experience::updateOrCreate(['title' => $e['title'], 'company' => $e['company']], $e);
        }

        // ── Educations ──────────────────────────────────────────
        $educations = [
            [
                'degree'      => 'Master Qualité Logicielle & Test',
                'school'      => 'Université Paris-Saclay',
                'start_year'  => 2017,
                'end_year'    => 2019,
                'description' => 'Spécialisation en ingénierie de la qualité logicielle, automatisation des tests et gestion de projets IT.',
            ],
            [
                'degree'      => 'Licence Informatique',
                'school'      => 'Université de Cergy-Pontoise',
                'start_year'  => 2014,
                'end_year'    => 2017,
                'description' => 'Fondamentaux en programmation, bases de données, réseaux et systèmes.',
            ],
        ];

        foreach ($educations as $ed) {
            Education::updateOrCreate(['degree' => $ed['degree'], 'school' => $ed['school']], $ed);
        }

        // ── Project Categories ──────────────────────────────────
        $pcAutomation = ProjectCategory::updateOrCreate(['slug' => 'automatisation'], ['name' => 'Automatisation', 'color' => '#64ffda']);
        $pcCiCd       = ProjectCategory::updateOrCreate(['slug' => 'ci-cd'],          ['name' => 'CI/CD',          'color' => '#82aaff']);
        $pcPerf       = ProjectCategory::updateOrCreate(['slug' => 'performance'],    ['name' => 'Performance',    'color' => '#c792ea']);

        // ── Projects ────────────────────────────────────────────
        Project::updateOrCreate(['slug' => 'framework-tests-e2e'], [
            'title'       => 'Framework de Tests E2E',
            'description' => 'Framework d\'automatisation complet basé sur Cypress pour les tests end-to-end d\'une application SaaS. Intégration avec Jenkins et reporting Allure.',
            'category_id' => $pcAutomation->id,
            'github_url'  => 'https://github.com/abdoul-sarba/e2e-framework',
            'is_featured' => true,
            'order'       => 1,
        ]);

        Project::updateOrCreate(['slug' => 'pipeline-cicd-multi-env'], [
            'title'       => 'Pipeline CI/CD Multi-environnements',
            'description' => 'Mise en place d\'un pipeline CI/CD avec Docker, Jenkins et Kubernetes pour le déploiement automatisé sur 3 environnements (dev, staging, prod).',
            'category_id' => $pcCiCd->id,
            'github_url'  => 'https://github.com/abdoul-sarba/cicd-pipeline',
            'is_featured' => true,
            'order'       => 2,
        ]);

        Project::updateOrCreate(['slug' => 'tests-performance-api'], [
            'title'       => 'Tests de Performance API',
            'description' => 'Suite de tests de charge avec JMeter pour valider la scalabilité d\'une API REST. Génération de rapports et intégration dans le pipeline CI.',
            'category_id' => $pcPerf->id,
            'is_featured' => true,
            'order'       => 3,
        ]);

        // ── Blog Categories ─────────────────────────────────────
        $bcQa     = BlogCategory::updateOrCreate(['slug' => 'qa'],            ['name' => 'QA']);
        $bcDevOps = BlogCategory::updateOrCreate(['slug' => 'devops'],        ['name' => 'DevOps']);
        $bcAuto   = BlogCategory::updateOrCreate(['slug' => 'automatisation'], ['name' => 'Automatisation']);

        // ── Blog Posts ──────────────────────────────────────────
        BlogPost::updateOrCreate(['slug' => 'introduction-tests-automatises-cypress'], [
            'title'        => 'Introduction aux tests automatisés avec Cypress',
            'excerpt'      => 'Découvrez comment démarrer avec Cypress pour automatiser vos tests front-end.',
            'content'      => "## Pourquoi Cypress ?\n\nCypress est un framework de test moderne conçu pour le web. Contrairement à Selenium, il s'exécute directement dans le navigateur.\n\n### Installation\n\n```bash\nnpm install cypress --save-dev\n```\n\n### Premier test\n\n```javascript\ndescribe('Ma première suite', () => {\n  it('visite la page d\\'accueil', () => {\n    cy.visit('/')\n    cy.contains('Bienvenue')\n  })\n})\n```\n\nCypress offre une excellente expérience développeur avec son runner interactif et ses capacités de débogage.",
            'category_id'  => $bcAuto->id,
            'is_published' => true,
            'published_at' => now()->subDays(5),
        ]);

        BlogPost::updateOrCreate(['slug' => 'pipeline-cicd-jenkins'], [
            'title'        => 'Mettre en place un pipeline CI/CD avec Jenkins',
            'excerpt'      => 'Guide pas à pas pour configurer un pipeline d\'intégration continue avec Jenkins.',
            'content'      => "## Jenkins et le CI/CD\n\nJenkins est l'outil d'intégration continue le plus utilisé. Voici comment configurer un pipeline pour un projet web.\n\n### Jenkinsfile\n\n```groovy\npipeline {\n    agent any\n    stages {\n        stage('Build') {\n            steps { sh 'npm install' }\n        }\n        stage('Test') {\n            steps { sh 'npm test' }\n        }\n        stage('Deploy') {\n            steps { sh './deploy.sh' }\n        }\n    }\n}\n```\n\nCe pipeline exécute automatiquement le build, les tests et le déploiement à chaque commit.",
            'category_id'  => $bcDevOps->id,
            'is_published' => true,
            'published_at' => now()->subDays(12),
        ]);

        // ── Certification Categories ────────────────────────────
        $ccCloud = CertificationCategory::updateOrCreate(['slug' => 'cloud'],   ['name' => 'Cloud']);
        $ccQa    = CertificationCategory::updateOrCreate(['slug' => 'qa'],      ['name' => 'QA']);
        $ccAgile = CertificationCategory::updateOrCreate(['slug' => 'agilite'], ['name' => 'Agilité']);

        // ── Certifications (pas de slug : on matche sur le titre) ─
        Certification::updateOrCreate(['title' => 'ISTQB Foundation Level'], [
            'issuer'      => 'ISTQB',
            'issue_date'  => '2021-06-15',
            'category_id' => $ccQa->id,
        ]);

        Certification::updateOrCreate(['title' => 'AWS Certified Cloud Practitioner'], [
            'issuer'      => 'Amazon Web Services',
            'issue_date'  => '2022-11-20',
            'category_id' => $ccCloud->id,
            'credential_url' => 'https://www.credly.com/badges/example',
        ]);

        Certification::updateOrCreate(['title' => 'Professional Scrum Master I (PSM I)'], [
            'issuer'      => 'Scrum.org',
            'issue_date'  => '2023-03-10',
            'category_id' => $ccAgile->id,
        ]);

        // ── Services ────────────────────────────────────────────
        Service::updateOrCreate(['slug' => 'audit-qa-strategie-tests'], [
            'title'             => 'Audit QA & Stratégie de Tests',
            'short_description' => 'Analyse de votre processus de test existant, identification des axes d\'amélioration et mise en place d\'une stratégie de tests adaptée à votre contexte.',
            'description'       => "Revue complète de vos pratiques de test actuelles.\nÉvaluation de la couverture de tests.\nRecommandations priorisées avec plan d\'action.\nAccompagnement à la mise en œuvre.",
            'price_label'       => 'À partir de 800€',
            'duration'          => '1-2 semaines',
            'is_featured'       => true,
            'order'             => 1,
        ]);

        Service::updateOrCreate(['slug' => 'automatisation-tests'], [
            'title'             => 'Automatisation des Tests',
            'short_description' => 'Mise en place de frameworks d\'automatisation (Selenium, Cypress, Playwright) pour vos tests fonctionnels, E2E et API.',
            'description'       => "Choix du framework adapté à votre stack.\nÉcriture des scénarios de tests automatisés.\nIntégration dans votre pipeline CI/CD.\nFormation de votre équipe à la maintenance des tests.",
            'price_label'       => 'Sur devis',
            'duration'          => '2-6 semaines',
            'is_featured'       => true,
            'order'             => 2,
        ]);

        Service::updateOrCreate(['slug' => 'mise-en-place-cicd'], [
            'title'             => 'Mise en place CI/CD',
            'short_description' => 'Conception et déploiement de pipelines CI/CD avec Jenkins, GitLab CI ou GitHub Actions. Docker & Kubernetes inclus.',
            'description'       => "Architecture du pipeline adaptée à vos besoins.\nContainerisation avec Docker.\nDéploiement automatisé multi-environnements.\nMonitoring et alerting.",
            'price_label'       => 'Sur devis',
            'duration'          => '2-4 semaines',
            'is_featured'       => false,
            'order'             => 3,
        ]);

        Service::updateOrCreate(['slug' => 'tests-performance'], [
            'title'             => 'Tests de Performance',
            'short_description' => 'Campagnes de tests de charge et de performance avec JMeter ou k6. Identification des goulots d\'étranglement.',
            'description'       => "Définition des scénarios de charge.\nExécution des tests et analyse des résultats.\nRapport détaillé avec recommandations.\nRetest après optimisations.",
            'price_label'       => 'À partir de 600€',
            'duration'          => '1-2 semaines',
            'is_featured'       => false,
            'order'             => 4,
        ]);

        Service::updateOrCreate(['slug' => 'formation-coaching-qa'], [
            'title'             => 'Formation & Coaching QA',
            'short_description' => 'Formation sur mesure pour vos équipes : bonnes pratiques de test, automatisation, outils CI/CD, méthodologies agiles.',
            'price_label'       => 'À partir de 500€/jour',
            'duration'          => '1-5 jours',
            'is_featured'       => false,
            'order'             => 5,
        ]);

        // ── Testimonials (pas de slug : on matche sur le nom du client) ─
        Testimonial::updateOrCreate(['client_name' => 'Sophie Martin'], [
            'client_company' => 'FinTech Solutions',
            'client_role'    => 'CTO',
            'content'        => 'Abdoul a mis en place notre stratégie de tests automatisés en un temps record. La couverture de tests est passée de 20% à 85%. Un vrai professionnel.',
            'rating'         => 5,
            'is_published'   => true,
            'order'          => 1,
        ]);

        Testimonial::updateOrCreate(['client_name' => 'Marc Dubois'], [
            'client_company' => 'E-Commerce Plus',
            'client_role'    => 'Lead Developer',
            'content'        => 'La mise en place du pipeline CI/CD a transformé notre workflow. Les déploiements qui prenaient des heures se font maintenant en quelques minutes.',
            'rating'         => 5,
            'is_published'   => true,
            'order'          => 2,
        ]);

        Testimonial::updateOrCreate(['client_name' => 'Amina Koné'], [
            'client_company' => 'HealthApp',
            'client_role'    => 'Product Owner',
            'content'        => 'Son audit QA nous a permis d\'identifier et corriger des problèmes critiques avant la mise en production. Je recommande vivement.',
            'rating'         => 5,
            'is_published'   => true,
            'order'          => 3,
        ]);
    }
}
