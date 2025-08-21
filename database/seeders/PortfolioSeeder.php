<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Contact;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear proyectos de ejemplo
        $projects = [
            [
                'title' => 'E-commerce Platform',
                'description' => 'Plataforma de comercio electrónico completa con Laravel y React. Incluye gestión de productos, carrito de compras, pagos y panel de administración.',
                'technologies' => 'Laravel,React,MySQL,Stripe',
                'url' => 'https://ejemplo-ecommerce.com',
                'github_url' => 'https://github.com/tuusuario/ecommerce',
                'featured' => true,
                'order' => 1
            ],
            [
                'title' => 'App Móvil Fitness',
                'description' => 'Aplicación móvil para seguimiento de rutinas de ejercicio con planificación personalizada y estadísticas de progreso.',
                'technologies' => 'React Native,Node.js,MongoDB',
                'url' => 'https://play.google.com/store/apps/details?id=com.fitnessapp',
                'github_url' => 'https://github.com/tuusuario/fitness-app',
                'featured' => true,
                'order' => 2
            ],
            [
                'title' => 'Dashboard Analytics',
                'description' => 'Panel de control para análisis de datos empresariales con gráficos interactivos y reportes personalizables.',
                'technologies' => 'Vue.js,Python,PostgreSQL',
                'url' => 'https://analytics.ejemplo.com',
                'github_url' => 'https://github.com/tuusuario/analytics-dashboard',
                'featured' => true,
                'order' => 3
            ],
            [
                'title' => 'Sistema CRM',
                'description' => 'Sistema de gestión de relaciones con clientes con seguimiento de leads, oportunidades y reportes de ventas.',
                'technologies' => 'Angular,Laravel,Redis',
                'url' => 'https://crm.ejemplo.com',
                'github_url' => 'https://github.com/tuusuario/crm-system',
                'featured' => false,
                'order' => 4
            ],
            [
                'title' => 'API REST',
                'description' => 'API RESTful para servicios de terceros con autenticación JWT y documentación completa.',
                'technologies' => 'Express.js,MongoDB,JWT',
                'url' => 'https://api.ejemplo.com',
                'github_url' => 'https://github.com/tuusuario/rest-api',
                'featured' => false,
                'order' => 5
            ],
            [
                'title' => 'Landing Page',
                'description' => 'Página de aterrizaje optimizada para conversiones con diseño responsive y SEO optimizado.',
                'technologies' => 'HTML/CSS,JavaScript,SEO',
                'url' => 'https://landing.ejemplo.com',
                'github_url' => 'https://github.com/tuusuario/landing-page',
                'featured' => false,
                'order' => 6
            ]
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }

        // Crear habilidades de ejemplo
        $skills = [
            // Frontend
            ['name' => 'HTML/CSS', 'category' => 'frontend', 'percentage' => 95, 'icon' => 'fab fa-html5', 'color' => 'orange', 'order' => 1],
            ['name' => 'JavaScript', 'category' => 'frontend', 'percentage' => 90, 'icon' => 'fab fa-js-square', 'color' => 'yellow', 'order' => 2],
            ['name' => 'React', 'category' => 'frontend', 'percentage' => 85, 'icon' => 'fab fa-react', 'color' => 'blue', 'order' => 3],
            ['name' => 'Vue.js', 'category' => 'frontend', 'percentage' => 80, 'icon' => 'fab fa-vuejs', 'color' => 'green', 'order' => 4],
            ['name' => 'Angular', 'category' => 'frontend', 'percentage' => 85, 'icon' => 'fab fa-angular', 'color' => 'red', 'order' => 5],
            ['name' => 'AngularJS', 'category' => 'frontend', 'percentage' => 90, 'icon' => 'fab fa-angular', 'color' => 'red', 'order' => 5],
            ['name' => 'Bootstrap', 'category' => 'frontend', 'percentage' => 90, 'icon' => 'fab fa-bootstrap', 'color' => 'purple', 'order' => 5],
            ['name' => 'Tailwind', 'category' => 'frontend', 'percentage' => 90, 'icon' => 'fab fa-tailwind', 'color' => 'blue', 'order' => 5],
            ['name' => 'Material UI', 'category' => 'frontend', 'percentage' => 90, 'icon' => 'fab fa-material-ui', 'color' => 'green', 'order' => 5],
            // Backend
            ['name' => 'PHP/Laravel', 'category' => 'backend', 'percentage' => 100, 'icon' => 'fab fa-php', 'color' => 'purple', 'order' => 1],
            ['name' => 'Node.js', 'category' => 'backend', 'percentage' => 88, 'icon' => 'fab fa-node-js', 'color' => 'green', 'order' => 2],
            ['name' => 'Python', 'category' => 'backend', 'percentage' => 75, 'icon' => 'fab fa-python', 'color' => 'blue', 'order' => 3],
            ['name' => 'MySQL/PostgreSQL', 'category' => 'backend', 'percentage' => 90, 'icon' => 'fas fa-database', 'color' => 'blue', 'order' => 4],
            ['name' => 'Codeigniter', 'category' => 'backend', 'percentage' => 90, 'icon' => 'fas fa-leaf', 'color' => 'green', 'order' => 5],


            // Herramientas
            ['name' => 'Git', 'category' => 'tools', 'percentage' => 90, 'icon' => 'fab fa-git-alt', 'color' => 'red', 'order' => 1],
            ['name' => 'Docker', 'category' => 'tools', 'percentage' => 85, 'icon' => 'fab fa-docker', 'color' => 'blue', 'order' => 2],
            ['name' => 'AWS', 'category' => 'tools', 'percentage' => 80, 'icon' => 'fab fa-aws', 'color' => 'orange', 'order' => 3],
            ['name' => 'Linux', 'category' => 'tools', 'percentage' => 85, 'icon' => 'fab fa-linux', 'color' => 'yellow', 'order' => 4],
            ['name' => 'WordPress', 'category' => 'tools', 'percentage' => 90, 'icon' => 'fab fa-wordpress', 'color' => 'blue', 'order' => 5],
            ['name' => 'Postman', 'category' => 'tools', 'percentage' => 90, 'icon' => 'fa-brands fa-pied-piper-hat', 'color' => 'orange', 'order' => 5],
            ['name' => 'Figma', 'category' => 'tools', 'percentage' => 90, 'icon' => 'fa-brands fa-figma', 'color' => 'green', 'order' => 5],
            ['name' => 'Cursor', 'category' => 'tools', 'percentage' => 90, 'icon' => 'fa-brands fa-codepen', 'color' => 'gray', 'order' => 5],
            ['name' => 'VSCode', 'category' => 'tools', 'percentage' => 90, 'icon' => 'fab fa-vscode', 'color' => 'blue', 'order' => 5],
            ['name' => 'Google', 'category' => 'tools', 'percentage' => 90, 'icon' => 'fa-brands fa-google', 'color' => 'red', 'order' => 5],
            ['name' => 'Paypal', 'category' => 'tools', 'percentage' => 90, 'icon' => 'fa-brands fa-paypal', 'color' => 'blue', 'order' => 5],
            ['name' => 'Stripe', 'category' => 'tools', 'percentage' => 90, 'icon' => 'fa-brands fa-stripe', 'color' => 'green', 'order' => 5],
            ['name' => 'Shopify', 'category' => 'tools', 'percentage' => 90, 'icon' => 'fa-brands fa-shopify', 'color' => 'purple', 'order' => 5],
            ['name' => 'Jira', 'category' => 'tools', 'percentage' => 90, 'icon' => 'fa-brands fa-jira', 'color' => 'red', 'order' => 5],
            ['name' => 'Whatsapp', 'category' => 'tools', 'percentage' => 90, 'icon' => 'fa-brands fa-whatsapp', 'color' => 'green', 'order' => 5],
            ['name' => 'Slack', 'category' => 'tools', 'percentage' => 90, 'icon' => 'fa-brands fa-slack', 'color' => 'blue', 'order' => 5],
            ['name' => 'Trello', 'category' => 'tools', 'percentage' => 90, 'icon' => 'fa-brands fa-trello', 'color' => 'red', 'order' => 5],
            ['name' => 'Notion', 'category' => 'tools', 'percentage' => 90, 'icon' => 'fa-brands fa-notion', 'color' => 'green', 'order' => 5],
            ['name' => 'JWT', 'category' => 'tools', 'percentage' => 90, 'icon' => 'fa-brands fa-jwt', 'color' => 'gray', 'order' => 5],
            
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // Crear mensajes de contacto de ejemplo
        $contacts = [
            [
                'name' => 'Juan Pérez',
                'email' => 'juan.perez@ejemplo.com',
                'subject' => 'Consulta sobre desarrollo web',
                'message' => 'Hola, estoy interesado en desarrollar una página web para mi empresa. ¿Podrías contactarme para discutir los detalles?'
            ],
            [
                'name' => 'María García',
                'email' => 'maria.garcia@ejemplo.com',
                'subject' => 'Proyecto de aplicación móvil',
                'message' => 'Necesito desarrollar una aplicación móvil para mi negocio. Me gustaría conocer tus tarifas y disponibilidad.'
            ],
            [
                'name' => 'Carlos López',
                'email' => 'carlos.lopez@ejemplo.com',
                'subject' => 'Mantenimiento de sitio web',
                'message' => 'Tengo un sitio web que necesita mantenimiento y actualizaciones. ¿Ofreces servicios de mantenimiento continuo?'
            ]
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}
