<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Schedule;
use App\Models\User;

class ScheduleSeeder extends Seeder
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
            ['user_id' => $user->id,  'first_name' => 'John', 'last_name' => 'Doe', 'email' => 'johndoe@example.com', 'phone' => '123-456-7890', 'date' => '2024-12-25', 'time' => '14:00:00', 'type' => 'Property Viewing', 'properties' => 'Allegra Garden Place', 'message' => 'I would like to schedule a viewing for the property. Please confirm.', 'status' => 'Pending'],
            ['user_id' => $user->id,  'first_name' => 'Jane', 'last_name' => 'Smith', 'email' => 'janesmith@example.com', 'phone' => '987-654-3210', 'date' => '2024-12-26', 'time' => '10:00:00', 'type' => 'Consultation', 'properties' => 'Mulberry Place', 'message' => 'I need some assistance regarding the available properties in the area.', 'status' => 'Scheduled'],
            ['user_id' => $user->id,  'first_name' => 'Robert', 'last_name' => 'Brown', 'email' => 'robertb@example.com', 'phone' => '555-123-4567', 'date' => '2024-12-27', 'time' => '16:30:00', 'type' => 'Property Viewing', 'properties' => 'Fortis Residence', 'message' => 'Looking to schedule a viewing for the property. I\'m interested in the amenities as well.', 'status' => 'Confirmed'],
            ['user_id' => $user->id,  'first_name' => 'Emily', 'last_name' => 'White', 'email' => 'emilywhite@example.com', 'phone' => '321-654-9870', 'date' => '2024-12-28', 'time' => '11:00:00', 'type' => 'Consultation', 'properties' => 'The Oriana', 'message' => 'I\'d like to get more information about The Oriana, especially the pricing options.', 'status' => 'Pending'],
            ['user_id' => $user->id,  'first_name' => 'Michael', 'last_name' => 'Johnson', 'email' => 'michaelj@example.com', 'phone' => '654-321-9870', 'date' => '2024-12-30', 'time' => '09:00:00', 'type' => 'Property Viewing', 'properties' => 'Prisma Residence', 'message' => 'I\'m interested in viewing the property. Could you confirm the available times?', 'status' => 'Scheduled'],
            ['user_id' => $user->id,  'first_name' => 'Sophia', 'last_name' => 'Miller', 'email' => 'sophiam@example.com', 'phone' => '777-555-1234', 'date' => '2024-12-29', 'time' => '15:00:00', 'type' => 'Consultation', 'properties' => 'One Delta Terraces', 'message' => 'I\'d like to discuss potential investment opportunities in One Delta Terraces.', 'status' => 'Pending'],
            ['user_id' => $user->id,  'first_name' => 'David', 'last_name' => 'Lee', 'email' => 'davidlee@example.com', 'phone' => '222-333-4444', 'date' => '2025-01-02', 'time' => '13:00:00', 'type' => 'Property Viewing', 'properties' => 'Sage Residence', 'message' => 'I\'m interested in scheduling a viewing for Sage Residence. Please let me know the available time slots.', 'status' => 'Confirmed'],
            ['user_id' => $user->id,  'first_name' => 'Olivia', 'last_name' => 'Green', 'email' => 'oliviagreen@example.com', 'phone' => '444-555-6666', 'date' => '2025-01-03', 'time' => '14:30:00', 'type' => 'Consultation', 'properties' => 'Oak Harbor Residences', 'message' => 'I\'m interested in the amenities at Oak Harbor Residences and would like to schedule a consultation.', 'status' => 'Scheduled'],
            ['user_id' => $user->id,  'first_name' => 'Lucas', 'last_name' => 'Williams', 'email' => 'lucaswilliams@example.com', 'phone' => '555-123-9999', 'date' => '2025-01-04', 'time' => '12:00:00', 'type' => 'Property Viewing', 'properties' => 'Moncello Crest', 'message' => 'I\'m interested in viewing the Moncello Crest property. Please provide me with available times.', 'status' => 'Pending'],
            ['user_id' => $user->id,  'first_name' => 'Mia', 'last_name' => 'Brown', 'email' => 'miabrown@example.com', 'phone' => '666-777-8888', 'date' => '2025-01-05', 'time' => '16:00:00', 'type' => 'Consultation', 'properties' => 'The Valeron Tower', 'message' => 'I would like more details about The Valeron Tower and possibly schedule a viewing.', 'status' => 'Scheduled'],
            ['user_id' => $user->id,  'first_name' => 'Isabella', 'last_name' => 'Harris', 'email' => 'isabellaharris@example.com', 'phone' => '777-888-9999', 'date' => '2025-01-06', 'time' => '11:30:00', 'type' => 'Property Viewing', 'properties' => 'Fortis Residence', 'message' => 'I\'m looking to view a property and am interested in seeing Fortis Residence.', 'status' => 'Pending'],
            ['user_id' => $user->id,  'first_name' => 'Ethan', 'last_name' => 'Scott', 'email' => 'ethanscott@example.com', 'phone' => '888-999-0000', 'date' => '2025-01-07', 'time' => '10:30:00', 'type' => 'Consultation', 'properties' => 'Prisma Residence', 'message' => 'I\'d like to inquire about available units at Prisma Residence. Can we schedule a consultation?', 'status' => 'Scheduled'],
        ];

        foreach($records as $record){
            Schedule::create($record);
        }
    }
}
