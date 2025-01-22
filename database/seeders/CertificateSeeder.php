<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Certificate;
use App\Models\User;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate([
            'name' => 'Name',
            'email' => 'email@email.com',
            'password' => '12345678',
            'type' => 'Admin',
        ]);

        $records = [
            [
                'user_id' => $user->id, 
                'name' => 'TOP SONORA SELLER',
                'date' => '2020-12-10',
                'image' => 'no-image.jpg',
            ],
            [
                'user_id' => $user->id, 
                'name' => 'TOP SELLER',
                'date' => '2021-03-08',
                'image' => 'no-image.jpg',
            ],
            [
                'user_id' => $user->id, 
                'name' => 'TOP 1 PERFORMER OF TEAM IKIGAI',
                'date' => '2021-12-16',
                'image' => 'no-image.jpg',
            ],
            [
                'user_id' => $user->id,
                'name' => 'TOP PERFORMER FOR THE MONTH OF NOVEMBER 2023',
                'date' => '2023-12-02',
                'image' => 'no-image.jpg',
            ]
        ];

        foreach($records as $record){
            Certificate::create($record);
        }
    }
}
