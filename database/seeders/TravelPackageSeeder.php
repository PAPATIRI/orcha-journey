<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TravelPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Paket Hemat',
                'price' => 1500000,
                'original_price' => 2000000,
                'discount_percentage' => 25,
                'is_best_choice' => false,
                'destination_list' => json_encode([
                    'Candi Borobudur',
                    'Malioboro',
                    'Keraton Yogyakarta',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Paket Premium',
                'price' => 2500000,
                'original_price' => 3500000,
                'discount_percentage' => 29,
                'is_best_choice' => true,
                'destination_list' => json_encode([
                    'Candi Borobudur',
                    'Candi Prambanan',
                    'Malioboro',
                    'Pantai Parangtritis',
                    'Tebing Breksi',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Paket Ekslusif',
                'price' => 3800000,
                'original_price' => 5000000,
                'discount_percentage' => 24,
                'is_best_choice' => false,
                'destination_list' => json_encode([
                    'Borobudur Sunrise',
                    'Prambanan Sunset',
                    'Malioboro',
                    'Pantai Indrayanti',
                    'Goa Pindul',
                    'Kalibiru',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('tbl_travel_package')->insert($packages);
    }
}
