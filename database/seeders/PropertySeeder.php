<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Property::create([
            'ptype_id' => '1',
            'amenities_id' => '1,2,3',
            'property_name' => 'Test Property',
            'property_slug' => 'test-property',
            'property_code' => 'PC001',
            'property_status' => 1,
            'lowest_price' => 100000,
            'max_price' => 200000,
            'short_descp' => 'Short description',
            'long_descp' => 'Long description',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'garage' => 1,
            'garage_size' => '2 cars',
            'property_size' => '1500 sqft',
            'property_video' => '',
            'address' => '123 Test St',
            'city' => 'Test City',
            'state' => 'Test State',
            'postal_code' => '12345',
            'neighborhood' => 'Test Neighborhood',
            'latitude' => '40.712776',
            'longitude' => '-74.005974',
            'featured' => 1,
            'hot' => 0,
            'agent_id' => 1,
            'status' => 1,
            'property_thambnail' => 'upload/property/thambnail/test.jpg',
        ]);
}
}