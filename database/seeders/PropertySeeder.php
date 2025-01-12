<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
              $user = User::first();

        DB::table('properties')->insert([
            [
                'id' => Str::ulid(),
                'user_id' => Str::ulid(),
                'name' => 'Alea Residences',
                'type' => 'Condominium',
                'location' => 'Las Pinas',
                'price' => 25000,
                'area' =>73,
                'parking' => true,
                'vacant' => true,
                'nearby' => 'N/A',
                'description' => '115 Surya, Alea Residences is a fully furnished 2BR unit for lease in Las Pinas, offering 73 sqm of living space with amenities like a swimming pool, gym, and parking.',
                'sale' => 'Pre-selling',
                'badge' => 'Price Drop',
                'status' => 'For Lease',
                'unit_number' => '115 Surya',
                'unit_type' => '2BR',
                'unit_furnish' => 'Fully Furnished',
                'unit_floor' => 'N/A',
                'images' => json_encode(['image1.jpg', 'image2.jpg']),
                'amenities' => json_encode(['Swimming Pool', 'Gym', 'Club House', 'Spa', 'Jogging Track', 'Tennis Court', 'Children\'s Play Area', 'Lounge', 'Barbecue Area', 'Rooftop Garden', 'Business Center', 'Party Hall', 'Indoor Games Room', 'Security System', '24/7 Water Supply', 'Wi-Fi Connectivity', 'Shuttle Service', 'Electric Vehicle Charging', 'Parking Lot', 'Café', 'Convenience Store', 'Health Clinic', 'Pet Area', 'Library', 'Billiards Room']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
                [
                'id' => Str::ulid(),
                'user_id' => Str::ulid(),
                'name' => 'Alea Residences',
                'type' => 'Condominium',
                'location' => 'Las Pinas',
                'price' => 20000.00,
                'area'=> 53,
                'parking' => true,
                'vacant' => true,
                'nearby' => 'N/A',
                'description' => '',
                'sale' => 'Pre-selling',
                'badge' => 'Price Drop',
                'status' => 'For Lease',
                'unit_number' => '707 budi',
                'unit_type' => '2BR',
                'unit_furnish' => 'Fully Furnished',
                'unit_floor' => 'N/A',
                'images' => json_encode(['image1.jpg', 'image2.jpg']),
                'amenities' => json_encode(['Swimming Pool', 'Gym', 'Club House', 'Spa', 'Jogging Track', 'Tennis Court', 'Children\'s Play Area', 'Lounge', 'Barbecue Area', 'Rooftop Garden', 'Business Center', 'Party Hall', 'Indoor Games Room', 'Security System', '24/7 Water Supply', 'Wi-Fi Connectivity', 'Shuttle Service', 'Electric Vehicle Charging', 'Parking Lot', 'Café', 'Convenience Store', 'Health Clinic', 'Pet Area', 'Library', 'Billiards Room']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
                [
                'id' => Str::ulid(),
                'user_id' => Str::ulid(),
                'name' => 'Alea Residences',
                'type' => 'Condominium',
                'location' => 'Las Pinas',
                'price' => 20000.00,
                'area' => 53,
                'parking' => true,
                'vacant' => true,
                'nearby' => 'N/A',
                'description' => '409 budi,Alea Residences offers a fully furnished 2BR unit for lease in Las Pinas, featuring 53 sqm of space with amenities such as a swimming pool, gym, and parking.',
                'sale' => 'Pre-selling',
                'badge' => 'Price Drop',
                'status' => 'For Lease',
                'unit_number' => '409 budi',
                'unit_type' => '2BR',
                'unit_furnish' => 'Fully Furnished',
                'unit_floor' => 'N/A',
                'images' => json_encode(['image1.jpg', 'image2.jpg']),
                'amenities' => json_encode(['Swimming Pool', 'Gym', 'Club House', 'Spa', 'Jogging Track', 'Tennis Court', 'Children\'s Play Area', 'Lounge', 'Barbecue Area', 'Rooftop Garden', 'Business Center', 'Party Hall', 'Indoor Games Room', 'Security System', '24/7 Water Supply', 'Wi-Fi Connectivity', 'Shuttle Service', 'Electric Vehicle Charging', 'Parking Lot', 'Café', 'Convenience Store', 'Health Clinic', 'Pet Area', 'Library', 'Billiards Room']),

                'created_at' => now(),
                'updated_at' => now(),
            ],
                [
                'id' => Str::ulid(),
                'user_id' => Str::ulid(),
                'name' => 'Alea Residences',
                'type' => 'Condominium',
                'location' => 'Las Pinas',
                'price' => 20000.00,
                'area' => 53,
                'parking' => true,
                'vacant' => true,
                'nearby' => 'N/A',
                'description' => '515 Raja, Alea Residences offers a fully furnished 2BR unit for lease in Las Pinas, featuring 53 sqm of space with amenities like a swimming pool, gym, and parking.',
                'sale' => 'Pre-selling',
                'badge' => 'Price Drop',
                'status' => 'For Lease',
                'unit_number' => '515 Raja',
                'unit_type' => '2BR',
                'unit_furnish' => 'Fully Furnished',
                'unit_floor' => 'N/A',
                'images' => json_encode(['image1.jpg', 'image2.jpg']),
                'amenities' => json_encode(['Swimming Pool', 'Gym', 'Club House', 'Spa', 'Jogging Track', 'Tennis Court', 'Children\'s Play Area', 'Lounge', 'Barbecue Area', 'Rooftop Garden', 'Business Center', 'Party Hall', 'Indoor Games Room', 'Security System', '24/7 Water Supply', 'Wi-Fi Connectivity', 'Shuttle Service', 'Electric Vehicle Charging', 'Parking Lot', 'Café', 'Convenience Store', 'Health Clinic', 'Pet Area', 'Library', 'Billiards Room']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
              
          
        ]);
    }
}
