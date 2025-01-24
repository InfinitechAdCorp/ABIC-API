<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Property;
use App\Models\Owner;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owner = Owner::firstOrCreate([
            'first_name' => 'Weiwei',
            'last_name' => 'Chen',
            'email' => 'weiwei@gmail.com',
            'phone' => '09346178296',
            'type' => 'Owner',
        ]);

        $records = [
            [
                'owner_id' => $owner->id,

                'name' => 'Alea Residences',
                'location' => 'Las Pinas',
                'price' => 25000,
                'area' => 73,
                'parking' => 1,
                'description' => '115 Surya, Alea Residences is a fully furnished 2BR unit for lease in Las Pinas, offering 73 sqm of living space with amenities like a swimming pool, gym, and parking.',

                'unit_number' => '115 Surya',
                'unit_type' => '2BR',
                'unit_status' => 'Fully Furnished',

                'title' => "N/A",
                'payment' => "N/A",
                'turnover' => "N/A",
                'terms' => "N/A",

                'category' => 'Residential',
                'badge' => 'Price Drop',
                'published' => 1,

                'amenities' => json_encode(['Swimming Pool', 'Gym', 'Club House', 'Spa', 'Jogging Track', 'Tennis Court', 'Children\'s Play Area', 'Lounge', 'Barbecue Area', 'Rooftop Garden', 'Business Center', 'Party Hall', 'Indoor Games Room', 'Security System', '24/7 Water Supply', 'Wi-Fi Connectivity', 'Shuttle Service', 'Electric Vehicle Charging', 'Parking Lot', 'Café', 'Convenience Store', 'Health Clinic', 'Pet Area', 'Library', 'Billiards Room']),
                'images' => json_encode(['no-image.jpg', 'no-image.jpg']),
            ],
            [
                'owner_id' => $owner->id,

                'name' => 'Alea Residences',
                'location' => 'Las Pinas',
                'price' => 20000.00,
                'area' => 53,
                'parking' => 1,
                'description' => 'N/A',

                'unit_number' => '707 budi',
                'unit_type' => '2BR',
                'unit_status' => 'Fully Furnished',

                'title' => "N/A",
                'payment' => "N/A",
                'turnover' => "N/A",
                'terms' => "N/A",

                'category' => 'Pre-Selling',
                'badge' => 'Price Drop',
                'published' => 1,

                'amenities' => json_encode(['Swimming Pool', 'Gym', 'Club House', 'Spa', 'Jogging Track', 'Tennis Court', 'Children\'s Play Area', 'Lounge', 'Barbecue Area', 'Rooftop Garden', 'Business Center', 'Party Hall', 'Indoor Games Room', 'Security System', '24/7 Water Supply', 'Wi-Fi Connectivity', 'Shuttle Service', 'Electric Vehicle Charging', 'Parking Lot', 'Café', 'Convenience Store', 'Health Clinic', 'Pet Area', 'Library', 'Billiards Room']),
                'images' => json_encode(['no-image.jpg', 'no-image.jpg']),
            ],
            [
                'owner_id' => $owner->id,

                'name' => 'Alea Residences',
                'location' => 'Las Pinas',
                'price' => 20000.00,
                'area' => 53,
                'parking' => true,
                'description' => '409 budi,Alea Residences offers a fully furnished 2BR unit for lease in Las Pinas, featuring 53 sqm of space with amenities such as a swimming pool, gym, and parking.',

                'unit_number' => '409 budi',
                'unit_type' => '2BR',
                'unit_status' => 'Fully Furnished',

                'title' => "N/A",
                'payment' => "N/A",
                'turnover' => "N/A",
                'terms' => "N/A",

                'category' => 'Pre-Selling',
                'badge' => 'New',
                'published' => 1,

                'amenities' => json_encode(['Swimming Pool', 'Gym', 'Club House', 'Spa', 'Jogging Track', 'Tennis Court', 'Children\'s Play Area', 'Lounge', 'Barbecue Area', 'Rooftop Garden', 'Business Center', 'Party Hall', 'Indoor Games Room', 'Security System', '24/7 Water Supply', 'Wi-Fi Connectivity', 'Shuttle Service', 'Electric Vehicle Charging', 'Parking Lot', 'Café', 'Convenience Store', 'Health Clinic', 'Pet Area', 'Library', 'Billiards Room']),
                'images' => json_encode(['no-image.jpg', 'no-image.jpg']),
            ],
            [
                'owner_id' => $owner->id,

                'name' => 'Alea Residences',
                'location' => 'Las Pinas',
                'price' => 20000.00,
                'area' => 53,
                'parking' => true,
                'description' => '515 Raja, Alea Residences offers a fully furnished 2BR unit for lease in Las Pinas, featuring 53 sqm of space with amenities like a swimming pool, gym, and parking.',
                
                'unit_number' => '515 Raja',
                'unit_type' => '2BR',
                'unit_status' => 'Fully Furnished',

                'title' => "N/A",
                'payment' => "N/A",
                'turnover' => "N/A",
                'terms' => "N/A",
                
                'category' => 'Pre-Selling',
                'badge' => 'New',
                'published' => 1,
                
                'amenities' => json_encode(['Swimming Pool', 'Gym', 'Club House', 'Spa', 'Jogging Track', 'Tennis Court', 'Children\'s Play Area', 'Lounge', 'Barbecue Area', 'Rooftop Garden', 'Business Center', 'Party Hall', 'Indoor Games Room', 'Security System', '24/7 Water Supply', 'Wi-Fi Connectivity', 'Shuttle Service', 'Electric Vehicle Charging', 'Parking Lot', 'Café', 'Convenience Store', 'Health Clinic', 'Pet Area', 'Library', 'Billiards Room']),
                'images' => json_encode(['no-image.jpg', 'no-image.jpg']),
            ],
        ];

        foreach ($records as $record) {
            Property::create($record);
        }
    }
}
