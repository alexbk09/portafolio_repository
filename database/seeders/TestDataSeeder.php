<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Testimonial;
use App\Models\Quote;
use App\Models\Notification;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario cliente de prueba
        $client = User::create([
            'name' => 'Cliente Ejemplo',
            'email' => 'cliente@ejemplo.com',
            'password' => Hash::make('password'),
            'role' => 'client',
        ]);

        // Crear testimonios de prueba
        Testimonial::create([
            'user_id' => $client->id,
            'name' => 'María González',
            'position' => 'CEO',
            'company' => 'TechCorp',
            'testimonial' => 'Excelente trabajo en nuestro proyecto web. Keiber fue muy profesional y entregó todo a tiempo. Definitivamente lo recomiendo.',
            'rating' => 5,
            'approved' => true,
            'featured' => true,
        ]);

        Testimonial::create([
            'user_id' => $client->id,
            'name' => 'Carlos Rodríguez',
            'position' => 'Director de Proyectos',
            'company' => 'InnovateLab',
            'testimonial' => 'Keiber demostró un gran conocimiento técnico y habilidades de comunicación. El proyecto superó nuestras expectativas.',
            'rating' => 5,
            'approved' => true,
            'featured' => true,
        ]);

        Testimonial::create([
            'user_id' => $client->id,
            'name' => 'Ana Martínez',
            'position' => 'Fundadora',
            'company' => 'StartupXYZ',
            'testimonial' => 'Trabajar con Keiber fue una experiencia increíble. Su atención al detalle y creatividad hicieron que nuestro proyecto destacara.',
            'rating' => 4,
            'approved' => true,
            'featured' => false,
        ]);

        // Crear cotizaciones de prueba
        Quote::create([
            'user_id' => $client->id,
            'project_name' => 'Sitio Web Corporativo',
            'description' => 'Necesitamos un sitio web moderno y responsivo para nuestra empresa. Debe incluir secciones de servicios, portafolio, blog y formulario de contacto.',
            'project_type' => 'web',
            'budget_min' => 2000,
            'budget_max' => 5000,
            'deadline' => now()->addMonths(2),
            'status' => 'pending',
        ]);

        Quote::create([
            'user_id' => $client->id,
            'project_name' => 'Aplicación Móvil E-commerce',
            'description' => 'Buscamos desarrollar una aplicación móvil para nuestra tienda online con funcionalidades de carrito de compras, pagos y seguimiento de pedidos.',
            'project_type' => 'mobile',
            'budget_min' => 8000,
            'budget_max' => 15000,
            'deadline' => now()->addMonths(4),
            'status' => 'approved',
            'admin_notes' => 'Proyecto interesante con buen presupuesto. Aprobado para desarrollo.',
        ]);

        // Crear notificaciones de prueba
        Notification::create([
            'user_id' => $client->id,
            'type' => 'quote_status',
            'title' => 'Cotización Aprobada',
            'message' => 'Tu cotización "Aplicación Móvil E-commerce" ha sido aprobada. Nos pondremos en contacto contigo pronto.',
            'icon' => 'fas fa-check-circle',
            'color' => 'green',
            'data' => json_encode(['quote_id' => 2]),
        ]);

        Notification::create([
            'user_id' => $client->id,
            'type' => 'testimonial_approved',
            'title' => 'Testimonio Aprobado',
            'message' => 'Tu testimonio ha sido aprobado y ahora es visible en nuestro sitio web.',
            'icon' => 'fas fa-star',
            'color' => 'yellow',
        ]);

        // Crear notificación para admin
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            Notification::create([
                'user_id' => $admin->id,
                'type' => 'new_quote',
                'title' => 'Nueva Cotización',
                'message' => 'Se ha recibido una nueva cotización de Cliente Ejemplo.',
                'icon' => 'fas fa-file-invoice-dollar',
                'color' => 'blue',
                'data' => json_encode(['quote_id' => 1]),
            ]);
        }
    }
}
