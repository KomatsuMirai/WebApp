<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => '食費']);
        Category::create(['name' => '日用品']);
        Category::create(['name' => '雑貨']);
        Category::create(['name' => '住宅費']);
        Category::create(['name' => '水道光熱費']);
        Category::create(['name' => '通信費']);
        Category::create(['name' => '医療費']);
        Category::create(['name' => '交際費']);
        Category::create(['name' => '特別費']);
        Category::create(['name' => '雑費']);
    }
}
