<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            [
                'name' => 'All New Avanza',
                'brand' => 'Toyota',
                'price_per_day' => 350000,
                'transmission' => 'Manual',
                'capacity' => 7,
                'is_available' => true,
            ],
            [
                'name' => 'Brio Satya E',
                'brand' => 'Honda',
                'price_per_day' => 300000,
                'transmission' => 'Matic',
                'capacity' => 5,
                'is_available' => true,
            ],
            [
                'name' => 'Xpander Ultimate',
                'brand' => 'Mitsubishi',
                'price_per_day' => 450000,
                'transmission' => 'Matic',
                'capacity' => 7,
                'is_available' => false, // Ceritanya sedang disewa
            ],
            [
                'name' => 'Innova Reborn Diesel',
                'brand' => 'Toyota',
                'price_per_day' => 600000,
                'transmission' => 'Manual',
                'capacity' => 7,
                'is_available' => true,
            ],
            [
                'name' => 'Sigra R Deluxe',
                'brand' => 'Daihatsu',
                'price_per_day' => 250000,
                'transmission' => 'Manual',
                'capacity' => 7,
                'is_available' => true,
            ],
            [
                'name' => 'Pajero Sport Dakar',
                'brand' => 'Mitsubishi',
                'price_per_day' => 1200000,
                'transmission' => 'Matic',
                'capacity' => 7,
                'is_available' => true,
            ],
            [
                'name' => 'Hiace Commuter',
                'brand' => 'Toyota',
                'price_per_day' => 1000000,
                'transmission' => 'Manual',
                'capacity' => 15,
                'is_available' => true,
            ],
            [
                'name' => 'Agya GR Sport',
                'brand' => 'Toyota',
                'price_per_day' => 300000,
                'transmission' => 'Matic',
                'capacity' => 5,
                'is_available' => false,
            ],
        ];

        foreach ($cars as $car) {
            Car::create([
                'name' => $car['name'],
                'brand' => $car['brand'],
                // Membuat Plat Nomor acak, contoh: KB 1234 XY
                'nopol' => 'KB '.rand(1000, 9999).' '.chr(rand(65, 90)).chr(rand(65, 90)),
                'price_per_day' => $car['price_per_day'],
                'transmission' => $car['transmission'],
                'capacity' => $car['capacity'],
                'image' => null, // Sesuai permintaan
                'is_available' => $car['is_available'],
            ]);
        }
    }
}
