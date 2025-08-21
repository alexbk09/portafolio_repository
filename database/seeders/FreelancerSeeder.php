<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\FreelancerProfile;
use Illuminate\Support\Facades\Hash;

class FreelancerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $freelancers = [
            [
                'name' => 'María García',
                'email' => 'maria@example.com',
                'password' => Hash::make('password'),
                'role' => 'freelancer',
                'profile' => [
                    'title' => 'Desarrolladora Frontend Senior',
                    'bio' => 'Desarrolladora frontend con 5 años de experiencia especializada en React, Vue.js y TypeScript. Me apasiona crear interfaces de usuario intuitivas y accesibles.',
                    'phone' => '+1 555-0123',
                    'location' => 'Madrid, España',
                    'website' => 'https://mariagarcia.dev',
                    'linkedin' => 'https://linkedin.com/in/mariagarcia',
                    'github' => 'https://github.com/mariagarcia',
                    'hourly_rate' => 45.00,
                    'experience_years' => 5,
                    'skills' => ['React', 'Vue.js', 'TypeScript', 'JavaScript', 'CSS3', 'HTML5', 'Tailwind CSS'],
                    'services' => ['Desarrollo Frontend', 'Optimización de Performance', 'Consultoría UX/UI'],
                    'is_available' => true
                ]
            ],
            [
                'name' => 'Carlos Rodríguez',
                'email' => 'carlos@example.com',
                'password' => Hash::make('password'),
                'role' => 'freelancer',
                'profile' => [
                    'title' => 'Desarrollador Full-Stack',
                    'bio' => 'Desarrollador full-stack con experiencia en Laravel, React y bases de datos. Me especializo en aplicaciones web escalables y APIs RESTful.',
                    'phone' => '+1 555-0456',
                    'location' => 'Barcelona, España',
                    'website' => 'https://carlosrodriguez.com',
                    'linkedin' => 'https://linkedin.com/in/carlosrodriguez',
                    'github' => 'https://github.com/carlosrodriguez',
                    'hourly_rate' => 50.00,
                    'experience_years' => 7,
                    'skills' => ['Laravel', 'React', 'PHP', 'MySQL', 'PostgreSQL', 'Docker', 'AWS'],
                    'services' => ['Desarrollo Full-Stack', 'APIs RESTful', 'DevOps', 'Consultoría Técnica'],
                    'is_available' => true
                ]
            ],
            [
                'name' => 'Ana Martínez',
                'email' => 'ana@example.com',
                'password' => Hash::make('password'),
                'role' => 'freelancer',
                'profile' => [
                    'title' => 'Diseñadora UX/UI',
                    'bio' => 'Diseñadora UX/UI con enfoque en investigación de usuarios y diseño centrado en el usuario. Experiencia en Figma, Adobe Creative Suite y prototipado.',
                    'phone' => '+1 555-0789',
                    'location' => 'Valencia, España',
                    'website' => 'https://anamartinez.design',
                    'linkedin' => 'https://linkedin.com/in/anamartinez',
                    'github' => null,
                    'hourly_rate' => 40.00,
                    'experience_years' => 4,
                    'skills' => ['Figma', 'Adobe XD', 'Sketch', 'User Research', 'Prototyping', 'Design Systems'],
                    'services' => ['Diseño UX/UI', 'Investigación de Usuarios', 'Prototipado', 'Design Systems'],
                    'is_available' => true
                ]
            ],
            [
                'name' => 'Luis Fernández',
                'email' => 'luis@example.com',
                'password' => Hash::make('password'),
                'role' => 'freelancer',
                'profile' => [
                    'title' => 'Desarrollador Backend',
                    'bio' => 'Desarrollador backend especializado en Python, Django y microservicios. Experiencia en arquitecturas escalables y bases de datos NoSQL.',
                    'phone' => '+1 555-0321',
                    'location' => 'Sevilla, España',
                    'website' => 'https://luisfernandez.dev',
                    'linkedin' => 'https://linkedin.com/in/luisfernandez',
                    'github' => 'https://github.com/luisfernandez',
                    'hourly_rate' => 55.00,
                    'experience_years' => 6,
                    'skills' => ['Python', 'Django', 'FastAPI', 'MongoDB', 'Redis', 'Docker', 'Kubernetes'],
                    'services' => ['Desarrollo Backend', 'APIs', 'Microservicios', 'DevOps'],
                    'is_available' => false
                ]
            ],
            [
                'name' => 'Sofia López',
                'email' => 'sofia@example.com',
                'password' => Hash::make('password'),
                'role' => 'freelancer',
                'profile' => [
                    'title' => 'Desarrolladora Mobile',
                    'bio' => 'Desarrolladora mobile con experiencia en React Native y Flutter. Me especializo en aplicaciones nativas y cross-platform.',
                    'phone' => '+1 555-0654',
                    'location' => 'Bilbao, España',
                    'website' => 'https://sofialopez.dev',
                    'linkedin' => 'https://linkedin.com/in/sofialopez',
                    'github' => 'https://github.com/sofialopez',
                    'hourly_rate' => 48.00,
                    'experience_years' => 4,
                    'skills' => ['React Native', 'Flutter', 'Swift', 'Kotlin', 'Firebase', 'App Store', 'Google Play'],
                    'services' => ['Desarrollo Mobile', 'Apps Nativas', 'Cross-Platform', 'Publicación en Stores'],
                    'is_available' => true
                ]
            ]
        ];

        foreach ($freelancers as $freelancerData) {
            $profileData = $freelancerData['profile'];
            unset($freelancerData['profile']);

            $user = User::create($freelancerData);
            
            FreelancerProfile::create([
                'user_id' => $user->id,
                'title' => $profileData['title'],
                'bio' => $profileData['bio'],
                'phone' => $profileData['phone'],
                'location' => $profileData['location'],
                'website' => $profileData['website'],
                'linkedin' => $profileData['linkedin'],
                'github' => $profileData['github'],
                'hourly_rate' => $profileData['hourly_rate'],
                'experience_years' => $profileData['experience_years'],
                'skills' => $profileData['skills'],
                'services' => $profileData['services'],
                'is_available' => $profileData['is_available']
            ]);
        }
    }
}
