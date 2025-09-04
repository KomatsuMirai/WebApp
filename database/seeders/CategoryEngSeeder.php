<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryEngSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['eng_name' => 'food']);
        Category::create(['eng_name' => 'daily']);
        Category::create(['eng_name' => 'sundry']);
        Category::create(['eng_name' => 'housing']);
        Category::create(['eng_name' => 'utility']);
        Category::create(['eng_name' => 'phone']);
        Category::create(['eng_name' => 'medical']);
        Category::create(['eng_name' => 'entertainment']);
        Category::create(['eng_name' => 'special']);
        Category::create(['eng_name' => 'etc']);
    }
}
