<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tool;
use App\Models\Category;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tool::factory()
            ->count(200)
            ->published()
            ->create();

        // attach some categories from database
        $categories = Category::all();
        Tool::all()->each(function ($tool) use ($categories) {
            $tool->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
