<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\City;
use App\Models\Country;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Country::create(['name' => 'India']);
        Country::create(['name' => 'Greece']);
        
        City::create(['country_id' => 1, 'name' => 'Delhi']);
        City::create(['country_id' => 1, 'name' => 'Mumbai']);
        City::create(['country_id' => 1, 'name' => 'Bangalore']);
        City::create(['country_id' => 2, 'name' => 'Athens']);
        City::create(['country_id' => 2, 'name' => 'Patra']);
        City::create(['country_id' => 2, 'name' => 'Zakynthos']);

        Tag::create(['name' => 'Laravel', 'slug' => 'laravel']);
        Tag::create(['name' => 'Vue JS', 'slug' => 'vue-js']);
        Tag::create(['name' => 'Livewire', 'slug' => 'livewire']);
    }

    
}
