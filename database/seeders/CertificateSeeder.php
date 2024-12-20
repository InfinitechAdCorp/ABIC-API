<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        // Get the first user (since only one user is created in UserSeeder)
        $user = User::first();

        DB::table('certificates')->insert([
            [
                'id' => Str::ulid(),
                'user_id' => $user->id, // Assigning the user_id based on the single user
                'name' => 'TOP SONORA SELLER',
                'date' => '2020-12-10',
                'image' => 'credentials1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::ulid(),
                'user_id' => $user->id, // Using the same user_id
                'name' => 'TOP SELLER',
                'date' => '2021-03-08',
                'image' => 'credentials2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::ulid(),
                'user_id' => $user->id, // Reusing the user_id
                'name' => 'TOP 1 PERFORMER OF TEAM IKIGAI',
                'date' => '2021-12-16',
                'image' => 'credentials3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::ulid(),
                'user_id' => $user->id, // Reusing the user_id again
                'name' => 'TOP PERFORMER FOR THE MONTH OF NOVEMBER 2023',
                'date' => '2023-12-02',
                'image' => 'credentials4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
