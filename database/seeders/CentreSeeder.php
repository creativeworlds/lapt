<?php

namespace Database\Seeders;

use App\Models\Centre;
use Illuminate\Database\Seeder;

class CentreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create a centre
        $centre = [
            'category' => '1',
            'type' => '1',
            'name' => 'Ingraham Institute',
            'code' => 'INGHZ221',
            'address' => 'Ghaziabad',
            'country' => '1',
            'state' => '1',
            'city' => 'Ghaziabad',
            'contact_person' => 'Pramod Singh',
            'mobile' => '9876543210',
            'phone' => '12023456',
            'fax' => '',
            'email' => 'centre@lapt.org',
            'description' => '',
            'website' => 'centre.lapt.org',
            'facebook' => 'facebook',
            'twitter' => '',
            'instagram' => '',
            'linkedin' => '',
            'password' => '',
            'chairman_signature' => '',
            'examiner_signature' => '',
            'center_logo' => ''
        ];

        // centre data seeding
        Centre::create($centre);
    }
}