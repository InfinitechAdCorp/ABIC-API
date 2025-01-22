<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Testimonial;
use App\Models\User;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate([
            'name' => 'Name',
            'email' => 'email@email.com',
            'password' => '12345678',
            'type' => 'Admin',
        ]);

        $records = [
            ['user_id' => $user->id, 'first_name' => 'John', 'last_name' => 'Doe', 'message' => 'The team helped me find my dream home in no time! The process was smooth, and they made everything so easy.'],
            ['user_id' => $user->id, 'first_name' => 'Jane', 'last_name' => 'Smith', 'message' => 'I had a fantastic experience buying my first property with this agency. They guided me every step of the way and made the process stress-free.'],
            ['user_id' => $user->id, 'first_name' => 'Robert', 'last_name' => 'Brown', 'message' => 'Great service! The property I was looking for was within my budget, and the team negotiated an excellent price.'],
            ['user_id' => $user->id, 'first_name' => 'Emily', 'last_name' => 'White', 'message' => 'I rented my apartment through this company, and I couldn\'t be happier with the space and the process. Highly recommend!'],
            ['user_id' => $user->id, 'first_name' => 'Michael', 'last_name' => 'Johnson', 'message' => 'I recently sold my house with the help of this team. They got me a great deal, and the sale process was efficient and transparent.'],
            ['user_id' => $user->id, 'first_name' => 'Sophia', 'last_name' => 'Miller', 'message' => 'The agents were very knowledgeable about the local market. They provided great advice that helped me find the perfect investment property.'],
            ['user_id' => $user->id, 'first_name' => 'James', 'last_name' => 'Wilson', 'message' => 'I had the best experience selling my commercial property. The team was professional, and they secured a buyer quickly at a great price.'],
            ['user_id' => $user->id, 'first_name' => 'Olivia', 'last_name' => 'Brown', 'message' => 'The customer service was excellent. They provided a detailed consultation on the best investment properties available, which helped me make an informed decision.'],
            ['user_id' => $user->id, 'first_name' => 'Liam', 'last_name' => 'Davis', 'message' => 'I\'m extremely happy with my new home! The team took care of everything from finding the right property to negotiating the best deal.'],
            ['user_id' => $user->id, 'first_name' => 'Isabella', 'last_name' => 'Martinez', 'message' => 'I was looking for a vacation home, and they found the perfect location for me. I highly recommend their services for anyone searching for a second property.'],
        ];

        foreach ($records as $record) {
            Testimonial::create($record);
        }
    }
}
