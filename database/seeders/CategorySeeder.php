<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder {
    public function run(): void {
        $categories = [
            'Pakaian Pria',
            'Pakaian Wanita',
            'Aksesoris Pria',
            'Aksesoris Wanita',
            'Aksesoris Pria dan Wanita',
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => \Str::slug($name)
            ]);
        }
    }
}
