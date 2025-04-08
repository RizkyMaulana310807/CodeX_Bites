<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageName = 'produk-' . fake()->unique()->uuid() . '.jpg';

        return [
            'nama' => fake()->sentence(3), // Nama produk berupa 3 kata acak
            'harga' => fake()->numberBetween(10000, 1000000), // Harga antara 10rb sampai 1jt
            'rating' => fake()->randomFloat(1, 1, 5), // Rating 1.0 sampai 5.0 (1 desimal)
            'stock' => fake()->numberBetween(0, 1000), // Stok antara 0-1000
            'jumlah_terjual' => fake()->numberBetween(0, 5000), // Jumlah terjual 0-5000        
            'gambar' => $imageName,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($produk) {
            // Generate gambar palsu dan simpan ke storage
            $image = fake()->image(
                dir: storage_path('app/public/produk'), // direktori penyimpanan
                width: 800,
                height: 600,
                category: 'technics', // kategori gambar (food, nature, technics, etc)
                fullPath: false
            );

            // Pindahkan gambar ke folder yang benar
            Storage::disk('public')->put(
                'produk/' . $produk->gambar,
                file_get_contents(storage_path('app/public/produk/' . $image))
            );

            // Hapus file temporary
            unlink(storage_path('app/public/produk/' . $image));
        });
    }
}
