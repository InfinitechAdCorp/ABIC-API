<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
   DB::table('partners')->insert([
            ['id' => (string) \Illuminate\Support\Str::ulid(), 'name' => 'SMDC', 'image' => '1734578001.png', 'created_at' => now(), 'updated_at' => now()],
            ['id' => (string) \Illuminate\Support\Str::ulid(), 'name' => 'ABIC Manpower', 'image' => '1734578020.png', 'created_at' => now(), 'updated_at' => now()],
            ['id' => (string) \Illuminate\Support\Str::ulid(), 'name' => 'INFINITECH', 'image' => '1734578029.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['id' => (string) \Illuminate\Support\Str::ulid(), 'name' => 'PBCOM', 'image' => '1734578037.png', 'created_at' => now(), 'updated_at' => now()],
            ['id' => (string) \Illuminate\Support\Str::ulid(), 'name' => 'MEGAWORLD', 'image' => '1734578064.png', 'created_at' => now(), 'updated_at' => now()],
            ['id' => (string) \Illuminate\Support\Str::ulid(), 'name' => 'BDO', 'image' => '1734578075.png', 'created_at' => now(), 'updated_at' => now()],
            ['id' => (string) \Illuminate\Support\Str::ulid(), 'name' => 'BPI', 'image' => '1734578097.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['id' => (string) \Illuminate\Support\Str::ulid(), 'name' => 'DMCI', 'image' => '1734578120.png', 'created_at' => now(), 'updated_at' => now()],
            ['id' => (string) \Illuminate\Support\Str::ulid(), 'name' => 'ALVEO', 'image' => '1734578210.png', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
