<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;
use Carbon\Carbon;

class MessagesTableSeeder extends Seeder
{
    public function run(): void
    {
        $messages = [
            [
                'sender_id' => 1,
                'receiver_id' => 2,
                'content' => 'Hemos recibido tu aplicación',
                'sent_at' => Carbon::now()->subDays(3)
            ],
            [
                'sender_id' => 2,
                'receiver_id' => 1,
                'content' => 'Gracias por la oportunidad',
                'sent_at' => Carbon::now()->subDays(2)
            ]
            ,
            [
                'sender_id' => 3,
                'receiver_id' => 4,
                'content' => 'Tu perfil ha sido seleccionado para una entrevista',
                'sent_at' => Carbon::now()->subDays(1)
            ],
            [
                'sender_id' => 4,
                'receiver_id' => 3,
                'content' => 'Estoy disponible para la entrevista',
                'sent_at' => Carbon::now()->subDays(1)
            ],
            [
                'sender_id' => 5,
                'receiver_id' => 6,
                'content' => 'Tu solicitud ha sido revisada',
                'sent_at' => Carbon::now()->subDays(4)
            ],
            [
                'sender_id' => 6,
                'receiver_id' => 5,
                'content' => 'Agradezco la revisión de mi solicitud',
                'sent_at' => Carbon::now()->subDays(3)
            ]


        ];

        foreach ($messages as $message) {
            Message::create($message);
        }
    }
}