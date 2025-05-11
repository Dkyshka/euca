<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Перевозчик
        $carrier = User::find(3);
        // Грузоотправитель
        $consignor = User::find(4);

        if (!$carrier || !$consignor) {
            $this->command->error('Пользователи с ID 3 и 4 не найдены.');
            return;
        }

        $chat = Chat::create(['title' => 'Тестовая переписка пользователей']);

        $chat->users()->attach([$carrier->id, $consignor->id]);

        foreach ([$carrier, $consignor] as $user) {
            for ($i = 1; $i <= 3; $i++) {
                $message = Message::create([
                    'chat_id' => $chat->id,
                    'user_id' => $user->id,
                    'message' => "Сообщение #$i от пользователя {$user->name}",
                ]);

                // Прикрепим 1–2 файла
                $filesCount = rand(1, 2);
                for ($f = 1; $f <= $filesCount; $f++) {
                    $fakeFile = tmpfile();
                    $filePath = stream_get_meta_data($fakeFile)['uri'];
                    file_put_contents($filePath, 'Содержимое тестового файла');

                    $storedPath = Storage::disk('public')->putFile('chat_files', new File($filePath));

                    $message->attachments()->create([
                        'path' => $storedPath,
                        'original_name' => "file_{$user->id}_{$i}_{$f}.txt",
                        'mime_type' => 'text/plain',
                        'size' => filesize($filePath),
                    ]);
                }
            }
        }

        $this->command->info('Чат между пользователями создан с сообщениями и файлами.');
    }
}
