<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 
class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    DB::table('testimonials')->insert([
    ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'John Doe', 'message' => 'The team helped me find my dream home in no time! The process was smooth, and they made everything so easy.', 'created_at' => now(), 'updated_at' => now()],
    ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'Jane Smith', 'message' => 'I had a fantastic experience buying my first property with this agency. They guided me every step of the way and made the process stress-free.', 'created_at' => now(), 'updated_at' => now()],
    ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'Robert Brown', 'message' => 'Great service! The property I was looking for was within my budget, and the team negotiated an excellent price.', 'created_at' => now(), 'updated_at' => now()],
    ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'Emily White', 'message' => 'I rented my apartment through this company, and I couldn\'t be happier with the space and the process. Highly recommend!', 'created_at' => now(), 'updated_at' => now()],
    ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'Michael Johnson', 'message' => 'I recently sold my house with the help of this team. They got me a great deal, and the sale process was efficient and transparent.', 'created_at' => now(), 'updated_at' => now()],
    ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'Sophia Miller', 'message' => 'The agents were very knowledgeable about the local market. They provided great advice that helped me find the perfect investment property.', 'created_at' => now(), 'updated_at' => now()],
    ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'James Wilson', 'message' => 'I had the best experience selling my commercial property. The team was professional, and they secured a buyer quickly at a great price.', 'created_at' => now(), 'updated_at' => now()],
    ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'Olivia Brown', 'message' => 'The customer service was excellent. They provided a detailed consultation on the best investment properties available, which helped me make an informed decision.', 'created_at' => now(), 'updated_at' => now()],
    ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'Liam Davis', 'message' => 'I\'m extremely happy with my new home! The team took care of everything from finding the right property to negotiating the best deal.', 'created_at' => now(), 'updated_at' => now()],
    ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'Isabella Martinez', 'message' => 'I was looking for a vacation home, and they found the perfect location for me. I highly recommend their services for anyone searching for a second property.', 'created_at' => now(), 'updated_at' => now()],
]);
    }
    
}
