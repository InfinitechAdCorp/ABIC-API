<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [
            ['name' => 'SMDC', 'image' => 'no-image.jpg'],
            ['name' => 'ABIC Manpower', 'image' => 'no-image.jpg'],
            ['name' => 'INFINITECH', 'image' => 'no-image.jpg'],
            ['name' => 'PBCOM', 'image' => 'no-image.jpg'],
            ['name' => 'MEGAWORLD', 'image' => 'no-image.jpg'],
            ['name' => 'BDO', 'image' => 'no-image.jpg'],
            ['name' => 'BPI', 'image' => 'no-image.jpg'],
            ['name' => 'DMCI', 'image' => 'no-image.jpg'],
            ['name' => 'ALVEO', 'image' => 'no-image.jpg'],
        ];

        foreach($records as $record){
            Partner::create($record);
        }
    }
}
