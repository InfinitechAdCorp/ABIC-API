<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 
class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
               DB::table('schedules')->insert([
            ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'John Doe', 'phone' => '123-456-7890', 'email' => 'johndoe@example.com', 'date' => '2024-12-25', 'time' => '14:00:00', 'type' => 'Property Viewing', 'properties' => 'Allegra Garden Place', 'message' => 'I would like to schedule a viewing for the property. Please confirm.', 'status' => 'Pending', 'created_at' => now(), 'updated_at' => now()],
            ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'Jane Smith', 'phone' => '987-654-3210', 'email' => 'janesmith@example.com', 'date' => '2024-12-26', 'time' => '10:00:00', 'type' => 'Consultation', 'properties' => 'Mulberry Place', 'message' => 'I need some assistance regarding the available properties in the area.', 'status' => 'Scheduled', 'created_at' => now(), 'updated_at' => now()],
            ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'Robert Brown', 'phone' => '555-123-4567', 'email' => 'robertb@example.com', 'date' => '2024-12-27', 'time' => '16:30:00', 'type' => 'Property Viewing', 'properties' => 'Fortis Residence', 'message' => 'Looking to schedule a viewing for the property. I\'m interested in the amenities as well.', 'status' => 'Confirmed', 'created_at' => now(), 'updated_at' => now()],
            ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'Emily White', 'phone' => '321-654-9870', 'email' => 'emilywhite@example.com', 'date' => '2024-12-28', 'time' => '11:00:00', 'type' => 'Consultation', 'properties' => 'The Oriana', 'message' => 'I\'d like to get more information about The Oriana, especially the pricing options.', 'status' => 'Pending', 'created_at' => now(), 'updated_at' => now()],
            ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'Michael Johnson', 'phone' => '654-321-9870', 'email' => 'michaelj@example.com', 'date' => '2024-12-30', 'time' => '09:00:00', 'type' => 'Property Viewing', 'properties' => 'Prisma Residence', 'message' => 'I\'m interested in viewing the property. Could you confirm the available times?', 'status' => 'Scheduled', 'created_at' => now(), 'updated_at' => now()],
            ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'Sophia Miller', 'phone' => '777-555-1234', 'email' => 'sophiam@example.com', 'date' => '2024-12-29', 'time' => '15:00:00', 'type' => 'Consultation', 'properties' => 'One Delta Terraces', 'message' => 'I\'d like to discuss potential investment opportunities in One Delta Terraces.', 'status' => 'Pending', 'created_at' => now(), 'updated_at' => now()],
            ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'David Lee', 'phone' => '222-333-4444', 'email' => 'davidlee@example.com', 'date' => '2025-01-02', 'time' => '13:00:00', 'type' => 'Property Viewing', 'properties' => 'Sage Residence', 'message' => 'I\'m interested in scheduling a viewing for Sage Residence. Please let me know the available time slots.', 'status' => 'Confirmed', 'created_at' => now(), 'updated_at' => now()],
            ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'Olivia Green', 'phone' => '444-555-6666', 'email' => 'oliviagreen@example.com', 'date' => '2025-01-03', 'time' => '14:30:00', 'type' => 'Consultation', 'properties' => 'Oak Harbor Residences', 'message' => 'I\'m interested in the amenities at Oak Harbor Residences and would like to schedule a consultation.', 'status' => 'Scheduled', 'created_at' => now(), 'updated_at' => now()],
            ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'Lucas Williams', 'phone' => '555-123-9999', 'email' => 'lucaswilliams@example.com', 'date' => '2025-01-04', 'time' => '12:00:00', 'type' => 'Property Viewing', 'properties' => 'Moncello Crest', 'message' => 'I\'m interested in viewing the Moncello Crest property. Please provide me with available times.', 'status' => 'Pending', 'created_at' => now(), 'updated_at' => now()],
            ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'Mia Brown', 'phone' => '666-777-8888', 'email' => 'miabrown@example.com', 'date' => '2025-01-05', 'time' => '16:00:00', 'type' => 'Consultation', 'properties' => 'The Valeron Tower', 'message' => 'I would like more details about The Valeron Tower and possibly schedule a viewing.', 'status' => 'Scheduled', 'created_at' => now(), 'updated_at' => now()],
            ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'Isabella Harris', 'phone' => '777-888-9999', 'email' => 'isabellaharris@example.com', 'date' => '2025-01-06', 'time' => '11:30:00', 'type' => 'Property Viewing', 'properties' => 'Fortis Residence', 'message' => 'I\'m looking to view a property and am interested in seeing Fortis Residence.', 'status' => 'Pending', 'created_at' => now(), 'updated_at' => now()],
            ['id' => (string) Str::ulid(), 'user_id' => (string) Str::ulid(), 'name' => 'Ethan Scott', 'phone' => '888-999-0000', 'email' => 'ethanscott@example.com', 'date' => '2025-01-07', 'time' => '10:30:00', 'type' => 'Consultation', 'properties' => 'Prisma Residence', 'message' => 'I\'d like to inquire about available units at Prisma Residence. Can we schedule a consultation?', 'status' => 'Scheduled', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
