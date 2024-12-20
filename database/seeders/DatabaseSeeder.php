<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PartnerSeeder; // Import the PartnerSeeder
use Database\Seeders\ItemSeeder; // Import the PartnerSeeder
use Database\Seeders\TestimonialSeeder; // Import the PartnerSeeder
use Database\Seeders\ScheduleSeeder; // Import the PartnerSeeder
use Database\Seeders\CertificateSeeder;
use Database\Seeders\SubmissionSeeder;
use Database\Seeders\PropertySeeder;


class DatabaseSeeder extends Seeder
{
   
    public function run(): void
    {
        $this->call(PartnerSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(TestimonialSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(CertificateSeeder::class);
        $this->call(SubmissionSeeder::class);
        $this->call(PropertySeeder::class);
    }
}
