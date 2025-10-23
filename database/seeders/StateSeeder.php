<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // multiple row create
        $states = collect([
            ['name' => 'Andaman and Nicobar Islands', 'code' => 'AN', 'status' => 1, 'country_id' => 98],
            ['name' => 'Andhra Pradesh', 'code' => 'AP', 'status' => 1, 'country_id' => 98],
            ['name' => 'Arunachal Pradesh', 'code' => 'AR', 'status' => 1, 'country_id' => 98],
            ['name' => 'Assam', 'code' => 'AS', 'status' => 1, 'country_id' => 98],
            ['name' => 'Bihar', 'code' => 'BR', 'status' => 1, 'country_id' => 98],
            ['name' => 'Chandigarh', 'code' => 'CH', 'status' => 1, 'country_id' => 98],
            ['name' => 'Chhattisgarh', 'code' => 'CT', 'status' => 1, 'country_id' => 98],
            ['name' => 'Dadra and Nagar Haveli and Daman and Diu', 'code' => 'DN', 'status' => 1, 'country_id' => 98],
            ['name' => 'Delhi', 'code' => 'DL', 'status' => 1, 'country_id' => 98],
            ['name' => 'Goa', 'code' => 'GA', 'status' => 1, 'country_id' => 98],
            ['name' => 'Gujarat', 'code' => 'GJ', 'status' => 1, 'country_id' => 98],
            ['name' => 'Haryana', 'code' => 'HR', 'status' => 1, 'country_id' => 98],
            ['name' => 'Himachal Pradesh', 'code' => 'HP', 'status' => 1, 'country_id' => 98],
            ['name' => 'Jammu and Kashmir', 'code' => 'JK', 'status' => 1, 'country_id' => 98],
            ['name' => 'Jharkhand', 'code' => 'JH', 'status' => 1, 'country_id' => 98],
            ['name' => 'Karnataka', 'code' => 'KA', 'status' => 1, 'country_id' => 98],
            ['name' => 'Kerala', 'code' => 'KL', 'status' => 1, 'country_id' => 98],
            ['name' => 'Ladakh', 'code' => 'LA', 'status' => 1, 'country_id' => 98],
            ['name' => 'Lakshadweep', 'code' => 'LD', 'status' => 1, 'country_id' => 98],
            ['name' => 'Madhya Pradesh', 'code' => 'MP', 'status' => 1, 'country_id' => 98],
            ['name' => 'Maharashtra', 'code' => 'MH', 'status' => 1, 'country_id' => 98],
            ['name' => 'Manipur', 'code' => 'MN', 'status' => 1, 'country_id' => 98],
            ['name' => 'Meghalaya', 'code' => 'ML', 'status' => 1, 'country_id' => 98],
            ['name' => 'Mizoram', 'code' => 'MZ', 'status' => 1, 'country_id' => 98],
            ['name' => 'Nagaland', 'code' => 'NL', 'status' => 1, 'country_id' => 98],
            ['name' => 'Odisha', 'code' => 'OR', 'status' => 1, 'country_id' => 98],
            ['name' => 'Puducherry', 'code' => 'PY', 'status' => 1, 'country_id' => 98],
            ['name' => 'Punjab', 'code' => 'PB', 'status' => 1, 'country_id' => 98],
            ['name' => 'Rajasthan', 'code' => 'RJ', 'status' => 1, 'country_id' => 98],
            ['name' => 'Sikkim', 'code' => 'SK', 'status' => 1, 'country_id' => 98],
            ['name' => 'Tamil Nadu', 'code' => 'TN', 'status' => 1, 'country_id' => 98],
            ['name' => 'Telangana', 'code' => 'TG', 'status' => 1, 'country_id' => 98],
            ['name' => 'Tripura', 'code' => 'TR', 'status' => 1, 'country_id' => 98],
            ['name' => 'Uttarakhand', 'code' => 'UT', 'status' => 1, 'country_id' => 98],
            ['name' => 'Uttar Pradesh', 'code' => 'UP', 'status' => 1, 'country_id' => 98],
            ['name' => 'West Bengal', 'code' => 'WB', 'status' => 1, 'country_id' => 98],
        ]);

        // Multiple data seeding
        $states->map(fn($item) => State::create($item));
    }
}