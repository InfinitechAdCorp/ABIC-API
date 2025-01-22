<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [
            ['name' => 'Loveseats', 'width' => 167.64, 'height' => 96.52, 'type' => 'Living Room', 'image' => 'no-image.jpg'],
            ['name' => 'Reclining Sofas', 'width' => 241.30, 'height' => 101.60, 'type' => 'Living Room', 'image' => 'no-image.jpg'],
            ['name' => 'Rocker Recliner', 'width' => 99.06, 'height' => 99.06, 'type' => 'Living Room', 'image' => 'no-image.jpg'],
            ['name' => 'Sofas', 'width' => 228.60, 'height' => 99.06, 'type' => 'Living Room', 'image' => 'no-image.jpg'],
            ['name' => 'Wing Chairs', 'width' => 81.28, 'height' => 88.90, 'type' => 'Living Room', 'image' => 'no-image.jpg'],


            ['name' => 'Bunk Beds', 'width' => 193.04, 'height' => 142.24, 'type' => 'Bedroom', 'image' => 'no-image.jpg'],
            ['name' => 'Nightstands', 'width' => 66.04, 'height' => 45.72, 'type' => 'Bedroom', 'image' => 'no-image.jpg'],
            ['name' => 'Panel Beds', 'width' => 160.02, 'height' => 210.82, 'type' => 'Bedroom', 'image' => 'no-image.jpg'],
            ['name' => 'Poster Beds', 'width' => 182.88, 'height' => 218.44, 'type' => 'Bedroom', 'image' => 'no-image.jpg'],
            ['name' => 'Sleigh Beds', 'width' => 170.18, 'height' => 228.60, 'type' => 'Bedroom', 'image' => 'no-image.jpg'],

            ['name' => 'Dining Arm Chairs', 'width' => 63.50, 'height' => 60.96, 'type' => 'Dining Room', 'image' => 'no-image.jpg'],
            ['name' => 'Dining Side Chairs', 'width' => 50.80, 'height' => 55.80, 'type' => 'Dining Room', 'image' => 'no-image.jpg'],
            ['name' => 'Dining Tables', 'width' => 134.62, 'height' => 147.32, 'type' => 'Dining Room', 'image' => 'no-image.jpg'],
            ['name' => 'Pub Tables', 'width' => 114.30, 'height' => 119.38, 'type' => 'Dining Room', 'image' => 'no-image.jpg'],
            ['name' => 'Servers', 'width' => 307.34, 'height' => 50.80, 'type' => 'Dining Room', 'image' => 'no-image.jpg'],

            ['name' => 'Closed Bookcases', 'width' => 101.60, 'height' => 40.64, 'type' => 'Home Office', 'image' => 'no-image.jpg'],
            ['name' => 'Desk Hutch Sets', 'width' => 139.70, 'height' => 63.50, 'type' => 'Home Office', 'image' => 'no-image.jpg'],
            ['name' => 'Open Bookcases', 'width' => 86.36, 'height' => 35.56, 'type' => 'Home Office', 'image' => 'no-image.jpg'],
            ['name' => 'Single Pedestal Desks', 'width' => 124.46, 'height' => 55.88, 'type' => 'Home Office', 'image' => 'no-image.jpg'],
            ['name' => 'Table Desks', 'width' => 127.00, 'height' => 66.04, 'type' => 'Home Office', 'image' => 'no-image.jpg'],

            ['name' => 'Rugs', 'width' => 228.60, 'height' => 154.94, 'type' => 'Miscellaneous', 'image' => 'no-image.jpg'],
            ['name' => 'Door Opens Left', 'width' => 91.44, 'height' => 70.00, 'type' => 'Structural', 'image' => 'no-image.jpg'],
            ['name' => 'Door Opens Right', 'width' => 91.44, 'height' => 70.00, 'type' => 'Structural', 'image' => 'no-image.jpg'],
            ['name' => 'French Doors', 'width' => 203.20, 'height' => 91.44, 'type' => 'Structural', 'image' => 'no-image.jpg'],
            ['name' => 'Fireplace', 'width' => 132.08, 'height' => 22.86, 'type' => 'Structural', 'image' => 'no-image.jpg'],

            ['name' => 'Sliding Doors', 'width' => 203.20, 'height' => 12.70, 'type' => 'Structural', 'image' => 'no-image.jpg'],
            ['name' => 'Window', 'width' => 139.70, 'height' => 7.62, 'type' => 'Structural', 'image' => 'no-image.jpg'],
            ['name' => 'Toilets', 'width' => 30.50, 'height' => 73.50, 'type' => 'Bathroom', 'image' => 'no-image.jpg'],
            ['name' => 'Pedestal Sinks', 'width' => 55.80, 'height' => 87.00, 'type' => 'Bathroom', 'image' => 'no-image.jpg'],
            ['name' => 'Bathtubs', 'width' => 170.00, 'height' => 75.00, 'type' => 'Bathroom', 'image' => 'no-image.jpg'],

            ['name' => 'Ovens', 'width' => 91.40, 'height' => 95.30, 'type' => 'Kitchen', 'image' => 'no-image.jpg'],
            ['name' => 'Sinks', 'width' => 106.30, 'height' => 50.80, 'type' => 'Kitchen', 'image' => 'no-image.jpg'],
            ['name' => 'Refrigerators', 'width' => 60.96, 'height' => 152.40, 'type' => 'Kitchen', 'image' => 'no-image.jpg'],
            ['name' => 'Partitions', 'width' => 100.00, 'height' => 7.62, 'type' => 'Structural', 'image' => 'no-image.jpg'],
            ['name' => 'Queen Beds', 'width' => 152.00, 'height' => 190.00, 'type' => 'Bedroom', 'image' => 'no-image.jpg'],
            ['name' => 'King Beds', 'width' => 182.00, 'height' => 198.00, 'type' => 'Bedroom', 'image' => 'no-image.jpg'],
            ['name' => 'Double Beds', 'width' => 120.00, 'height' => 190.00, 'type' => 'Bedroom', 'image' => 'no-image.jpg'],
            ['name' => 'Single Beds', 'width' => 91.00, 'height' => 190.00, 'type' => 'Bedroom', 'image' => 'no-image.jpg'],
            ['name' => 'Twin Beds', 'width' => 96.52, 'height' => 190.00, 'type' => 'Bedroom', 'image' => 'no-image.jpg'],
        ];

        foreach($records as $record){
            Item::create($record);
        }
    }
}
