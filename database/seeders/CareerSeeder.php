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
                'image' => 'uploads/careers/images/agent1.jpg',
            ],
            [
                'position' => 'Property Manager',
                'slots' => 30,
                'image' => 'uploads/careers/images/manager1.jpg',
            ],
            [
                'position' => 'Marketing Specialist',
                'slots' => 15,
                'image' => 'uploads/careers/images/marketing1.jpg',
            ],
            [
                'position' => 'Sales Consultant',
                'slots' => 10,
                'image' => 'uploads/careers/images/sales1.jpg',
            ],
            [
                'position' => 'Leasing Officer',
                'slots' => 25,
                'image' => 'uploads/careers/images/leasing1.jpg',
            ],
            [
                'position' => 'Administrative Officer',
                'slots' => 30,
                'image' => 'uploads/careers/images/admin1.jpg',
            ],
        ];

        foreach($records as $record){
            Career::create($record);
        }
    }
}
