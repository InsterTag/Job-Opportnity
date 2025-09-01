<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

        $users = User::all();
        $prepared = [];

        // Emparejar usuarios por índice para simular conversaciones
        $pairs = [
            [0,1], [1,0], [2,3], [3,2], [4,5], [5,4]
        ];

        foreach ($pairs as $i => $pair) {
            $sender = $users->get($pair[0]);
            $receiver = $users->get($pair[1]);
            if (!$sender || !$receiver) continue;

            $prepared[] = [
                'sender_id' => $sender->id,
                'receiver_id' => $receiver->id,
                'content' => $messages[$i]['content'] ?? 'Mensaje de prueba',
                'sent_at' => $messages[$i]['sent_at'] ?? Carbon::now()->subDays(1),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('messages')->insertOrIgnore($prepared);
    }
}