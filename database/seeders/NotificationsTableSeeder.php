<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notifications = [
            [
                'user_id' => 2, // Asegúrate de que el usuario con ID 1 exista
                'job_offer_id' => 1, // Asegúrate de que la oferta de trabajo con ID 1 exista
                'message' => 'Tienes una nueva oferta de trabajo disponible.',
                'read'    => false,
            ],
            [
                'user_id' => 4,
                'job_offer_id' => 2, // Asegúrate de que la oferta de trabajo con ID 2 exista
                'message' => 'Tu solicitud de empleo fue recibida exitosamente.',
                'read'    => true,
            ]
            ,
            [
                'user_id' => 6,
                'job_offer_id' => 3, // Asegúrate de que la oferta de trabajo con ID 3 exista
                'message' => 'Tu perfil ha sido actualizado correctamente.',
                'read'    => false,
            ],
            [
                'user_id' => 8,
                'job_offer_id' => 4, // Asegúrate de que la oferta de trabajo con ID 4 exista
                'message' => 'Tienes un nuevo mensaje en tu bandeja de entrada.',
                'read'    => true,
            ],
            [
                'user_id' => 1,
                'job_offer_id' => 1, // Asegúrate de que la oferta de trabajo con ID 5 exista
                'message' => 'Tu empresa ha sido verificada.',
                'read'    => false,
            ]


        ];

        foreach ($notifications as $notification) {
            Notification::create($notification);
        }
    }
}
//NOTIFICATIONS, 