<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $this->call(UserSeeder::class);

        $userId = DB::table('users')->insertGetId(
            [
                'name' => 'Test User',
                'email' => 'user@example.com', 
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
            ]
        );
        
        // $messageStatus=DB::select("SHOW TABLE STATUS LIKE 'messages'");
        // $nextMessageId=$messageStatus[0]->Auto_increment;

        $secret = strtotime('now') . Str::random(10);
        $messageId = DB::table('messages')->insertGetId(
            [
                'user_id' => $userId,
                'secret' => md5($secret),
                'content' => Str::random(200),
                'phone_number' => '206-548-2136',
            ]
        );

        // $fileStatus=DB::select("SHOW TABLE STATUS LIKE 'files'");
        // $nextFileId=$fileStatus[0]->Auto_increment;

        $secret = strtotime('now') . Str::random(10);
        DB::table('files')->insert(
            [
                'message_id' => $messageId,
                'secret' => md5($secret),
                'filename' => 'test_1_pdf.pdf',
                'path' => "files/".Str::random(15).".pdf",
                'mime' => 'application/pdf',
                'extension' => 'PDF',
                'expires_at' => strtotime('+20 minutes')
            ]
        );
        
        $secret = strtotime('now') . Str::random(10);
        DB::table('files')->insert(
            [
                'message_id' => $messageId,
                'secret' => md5($secret),
                'filename' => 'test_1_jpeg.jpg',
                'path' => "files/".Str::random(15).".jpg",
                'mime' => 'image/jpeg', // 'image/png'
                'extension' => 'jpg',
                'expires_at' => strtotime('+20 minutes')
            ]
        );
    }
}
