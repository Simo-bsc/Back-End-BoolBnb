<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages = config('bnb.messages');


        Message::truncate();

        foreach ($messages as  $message) {


            $newMessage = new Message();
            $newMessage->apartment_id = $message['apartment_id'];
            $newMessage->sender_name = $message['sender_name'];
            $newMessage->sender_email = $message['sender_email'];
            $newMessage->object = $message['object'];
            $newMessage->content = $message['content'];
            $newMessage -> day = fake() -> dateTimeThisYear();
            
            $newMessage->save();
        };

        $apartments = Apartment::all();

        foreach ($apartments as $apartment) {
            for ($i = 0; $i < 12; $i++) { // Genera dati per ogni mese
                $messages = rand(10, 300); // Genera un numero casuale tra 1 e 1000
                for ($j = 0; $j < $messages; $j++) { // Genera un numero casuale di visualizzazioni per mese
                    $newMessage = new Message();
                    $newMessage->apartment_id = $apartment->id;
                    $newMessage->day = now()->startOfMonth()->subMonths(12 - $i)->toDateString();
                    $newMessage->sender_name = fake()-> firstName();
                    $newMessage->sender_email = fake()-> email();
                    $newMessage->object = fake()-> word(3);
                    $newMessage->content = fake()-> paragraph(5);
                    $newMessage->save();
                }
            }
        }
    }

    
}
