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
                'message' => 'Tienes una nueva oferta de trabajo disponible.',
                'read'    => false,
            ],
            [
                'user_id' => 4,
                'message' => 'Tu solicitud de empleo fue recibida exitosamente.',
                'read'    => true,
            ]
            ,
            [
                'user_id' => 6,
                'message' => 'Tu perfil ha sido actualizado correctamente.',
                'read'    => false,
            ],
            [
                'user_id' => 8,
                'message' => 'Tienes un nuevo mensaje en tu bandeja de entrada.',
                'read'    => true,
            ],
            [
                'user_id' => 1,
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