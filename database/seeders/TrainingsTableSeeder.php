<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Training;

class TrainingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trainings = [
            [
                'title'       => 'Curso de Desarrollo Web',
                'description' => 'Aprende HTML, CSS, JavaScript y frameworks modernos.',
                'link'        => 'https://example.com/web-development',
                'provider'    => 'Platzi',
                'start_date'  => '2025-06-01',
                'end_date'    => '2025-07-15',
            ],
            [
                'title'       => 'Formación en Ciberseguridad',
                'description' => 'Curso básico de ciberseguridad para proteger redes y datos.',
                'link'        => 'https://example.com/cybersecurity',
                'provider'    => 'SENA',
                'start_date'  => '2025-05-10',
                'end_date'    => '2025-06-30',
            ],
            [
                'title'       => 'Capacitación en Inteligencia Artificial',
                'description' => 'Introducción a la IA y aprendizaje automático.',
                'link'        => 'https://example.com/ai-training',
                'provider'    => 'Coursera',
                'start_date'  => '2025-04-01',
                'end_date'    => '2025-06-01',
            ],

            [
                'title'       => 'Curso de Marketing Digital',
                'description' => 'Estrategias de marketing digital y SEO.',
                'link'        => 'https://example.com/digital-marketing',
                'provider'    => 'Udemy',
                'start_date'  => '2025-07-01',
                'end_date'    => '2025-08-15',
            ],
            [
                'title'       => 'Taller de Fotografía Profesional',
                'description' => 'Técnicas avanzadas de fotografía y edición.',
                'link'        => 'https://example.com/professional-photography',
                'provider'    => 'Skillshare',
                'start_date'  => '2025-08-01',
                'end_date'    => '2025-09-01',
            ],
            [
                'title'       => 'Curso de Gestión de Proyectos',
                'description' => 'Fundamentos de la gestión de proyectos y metodologías ágiles.',
                'link'        => 'https://example.com/project-management',
                'provider'    => 'LinkedIn Learning',
                'start_date'  => '2025-09-01',
                'end_date'    => '2025-10-15',
            ],
            [
                'title'       => 'Capacitación en Ventas y Negociación',
                'description' => 'Técnicas efectivas de ventas y negociación.',
                'link'        => 'https://example.com/sales-training',
                'provider'    => 'Harvard Business School Online',
                'start_date'  => '2025-10-01',
                'end_date'    => '2025-11-15',
            ],
            [
                'title'       => 'Curso de Desarrollo Personal',
                'description' => 'Mejora tus habilidades de comunicación y liderazgo.',
                'link'        => 'https://example.com/personal-development',
                'provider'    => 'Mindvalley',
                'start_date'  => '2025-11-01',
                'end_date'    => '2025-12-15',
            ],
            [
                'title'       => 'Formación en Finanzas Personales',
                'description' => 'Aprende a gestionar tus finanzas y ahorrar efectivamente.',
                'link'        => 'https://example.com/personal-finance',
                'provider'    => 'Khan Academy',
                'start_date'  => '2025-12-01',
                'end_date'    => '2026-01-15',
            ]


        ];

        foreach ($trainings as $training) {
            Training::create($training);
        }
    }
}
