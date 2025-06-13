<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('products')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Ambil ID kategori fashion yang baru
        $categories = Category::whereIn('name', [
            'Pakaian Pria', 
            'Pakaian Wanita', 
            'Aksesoris Pria', 
            'Aksesoris Wanita', 
            'Aksesoris Pria dan Wanita'
        ])->pluck('id', 'name');

        Product::insert([
            // Pakaian Pria
            [
                'name' => 'Kemeja Flanel Pria',
                'description' => 'Kemeja flanel lengan panjang yang cocok untuk tampilan kasual.',
                'price' => 150000,
                'stock' => 50,
                'category_id' => $categories['Pakaian Pria'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Jaket Denim Pria',
                'description' => 'Jaket denim berkualitas tinggi dengan desain modern.',
                'price' => 250000,
                'stock' => 20,
                'category_id' => $categories['Pakaian Pria'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Sweater Rajut Pria',
                'description' => 'Sweater hangat cocok untuk musim dingin.',
                'price' => 180000,
                'stock' => 30,
                'category_id' => $categories['Pakaian Pria'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Kaos Polo Pria',
                'description' => 'Kaos polo elegan dan nyaman dipakai.',
                'price' => 120000,
                'stock' => 60,
                'category_id' => $categories['Pakaian Pria'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Celana Chino Pria',
                'description' => 'Celana chino stylish dengan potongan slim fit.',
                'price' => 200000,
                'stock' => 40,
                'category_id' => $categories['Pakaian Pria'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Pakaian Pria
            [
                'name' => 'Kemeja Flanel Pria',
                'description' => 'Kemeja flanel lengan panjang yang cocok untuk tampilan kasual.',
                'price' => 150000,
                'stock' => 50,
                'category_id' => $categories['Pakaian Pria'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Jaket Denim Pria',
                'description' => 'Jaket denim berkualitas tinggi dengan desain modern.',
                'price' => 250000,
                'stock' => 20,
                'category_id' => $categories['Pakaian Pria'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Sweater Rajut Pria',
                'description' => 'Sweater hangat cocok untuk musim dingin.',
                'price' => 180000,
                'stock' => 30,
                'category_id' => $categories['Pakaian Pria'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Kaos Polo Pria',
                'description' => 'Kaos polo elegan dan nyaman dipakai.',
                'price' => 120000,
                'stock' => 60,
                'category_id' => $categories['Pakaian Pria'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Celana Chino Pria',
                'description' => 'Celana chino stylish dengan potongan slim fit.',
                'price' => 200000,
                'stock' => 40,
                'category_id' => $categories['Pakaian Pria'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Pakaian Wanita
            [
                'name' => 'Blouse Elegan Wanita',
                'description' => 'Blouse modern dengan desain elegan dan nyaman dipakai.',
                'price' => 180000,
                'stock' => 40,
                'category_id' => $categories['Pakaian Wanita'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cardigan Hangat Wanita',
                'description' => 'Cardigan hangat dan stylish, cocok untuk musim dingin.',
                'price' => 220000,
                'stock' => 35,
                'category_id' => $categories['Pakaian Wanita'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Dress Floral Wanita',
                'description' => 'Dress cantik dengan motif floral.',
                'price' => 300000,
                'stock' => 25,
                'category_id' => $categories['Pakaian Wanita'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Outer Kimono Wanita',
                'description' => 'Outer kimono nyaman dan stylish.',
                'price' => 175000,
                'stock' => 50,
                'category_id' => $categories['Pakaian Wanita'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Setelan Rok dan Blouse',
                'description' => 'Setelan modis dan nyaman dipakai.',
                'price' => 240000,
                'stock' => 30,
                'category_id' => $categories['Pakaian Wanita'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Aksesoris Pria
            [
                'name' => 'Dompet Kulit Pria',
                'description' => 'Dompet kulit asli dengan banyak slot kartu.',
                'price' => 200000,
                'stock' => 50,
                'category_id' => $categories['Aksesoris Pria'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Jam Tangan Pria',
                'description' => 'Jam tangan analog stylish untuk tampilan elegan.',
                'price' => 350000,
                'stock' => 40,
                'category_id' => $categories['Aksesoris Pria'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ikat Pinggang Kulit Pria',
                'description' => 'Ikat pinggang kulit premium dengan desain klasik.',
                'price' => 180000,
                'stock' => 60,
                'category_id' => $categories['Aksesoris Pria'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Kacamata Hitam Pria',
                'description' => 'Kacamata hitam stylish untuk melindungi dari sinar UV.',
                'price' => 120000,
                'stock' => 45,
                'category_id' => $categories['Aksesoris Pria'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Topi Baseball Pria',
                'description' => 'Topi stylish untuk tampilan kasual.',
                'price' => 85000,
                'stock' => 75,
                'category_id' => $categories['Aksesoris Pria'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Aksesoris Wanita
            [
                'name' => 'Tas Tangan Elegan',
                'description' => 'Tas tangan cantik dengan desain elegan.',
                'price' => 300000,
                'stock' => 25,
                'category_id' => $categories['Aksesoris Wanita'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Anting Berlian Wanita',
                'description' => 'Anting berlian mewah untuk tampilan elegan.',
                'price' => 500000,
                'stock' => 15,
                'category_id' => $categories['Aksesoris Wanita'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Kacamata Fashion Wanita',
                'description' => 'Kacamata fashion trendi dan stylish.',
                'price' => 120000,
                'stock' => 50,
                'category_id' => $categories['Aksesoris Wanita'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Aksesoris Pria dan Wanita
            [
                'name' => 'Syal Rajut Unisex',
                'description' => 'Syal rajut hangat cocok untuk pria dan wanita.',
                'price' => 95000,
                'stock' => 40,
                'category_id' => $categories['Aksesoris Pria dan Wanita'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Topi Beanie Unisex',
                'description' => 'Topi beanie hangat dan nyaman, cocok untuk musim dingin.',
                'price' => 60000,
                'stock' => 50,
                'category_id' => $categories['Aksesoris Pria dan Wanita'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Kacamata Hitam Unisex',
                'description' => 'Kacamata hitam trendi untuk pria dan wanita.',
                'price' => 120000,
                'stock' => 75,
                'category_id' => $categories['Aksesoris Pria dan Wanita'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Sarung Tangan Kulit Unisex',
                'description' => 'Sarung tangan kulit elegan dan nyaman digunakan.',
                'price' => 180000,
                'stock' => 30,
                'category_id' => $categories['Aksesoris Pria dan Wanita'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ransel Kasual Unisex',
                'description' => 'Ransel kasual yang stylish dan praktis.',
                'price' => 220000,
                'stock' => 25,
                'category_id' => $categories['Aksesoris Pria dan Wanita'] ?? null,
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
