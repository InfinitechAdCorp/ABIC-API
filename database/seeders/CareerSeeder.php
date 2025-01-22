<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Career;

class CareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [
            [
                'position' => 'Real Estate Agent',
                'slots' => 50,
                'image' => 'no-image.jpg',
            ],
            [
                'position' => 'Property Manager',
                'slots' => 30,
                'image' => 'no-image.jpg',
            ],
            [
                'position' => 'Marketing Specialist',
                'slots' => 15,
                'image' => 'no-image.jpg',
            ],
            [
                'position' => 'Sales Consultant',
                'slots' => 10,
                'image' => 'no-image.jpg',
            ],
            [
                'position' => 'Leasing Officer',
                'slots' => 25,
                'image' => 'no-image.jpg',
            ],
            [
                'position' => 'Administrative Officer',
                'slots' => 30,
                'image' => 'no-image.jpg',
            ],
        ];

        foreach($records as $record){
            Career::create($record);
        }
    }
}
