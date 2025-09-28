<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run()
    {
        Event::create([
            'title' => 'Nature Hike',
            'description' => 'Join us for a hike in the Margalla Hills and enjoy breathtaking scenery.',
            'date' => '2025-06-25',
            'image' => 'trip1.jpeg'
        ]);

        Event::create([
            'title' => 'Tree Plantation Drive',
            'description' => 'Help us plant 500 trees to make our campus greener and healthier.',
            'date' => '2025-07-02',
            'image' => 'trip2.jpg'
        ]);

        Event::create([
            'title' => 'Clean the River Day',
            'description' => 'Let’s gather to clean the local riverbank and raise awareness about pollution.',
            'date' => '2025-07-10',
            'image' => 'trip3.jpeg'
        ]);
    }
}
