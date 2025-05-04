<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\RequisitionItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequisitionItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     
        $event = Event::inRandomOrder()->first();

        if (!$event) {
            $this->command->warn('No events found. Please seed events first.');
            return;
        }

        RequisitionItem::factory()->count(20)->create([
            'event_id' => $event->id
        ]);
    }
}
