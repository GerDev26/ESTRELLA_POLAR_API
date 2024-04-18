<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('products')->insert([
            'name' => 'Monitor',
            'details' => 'esta re piola el monitor',
            'price' => 2500
        ]);
        DB::table('products')->insert([
            'name' => 'Pelota',
            'details' => 'esta re piola el pelota',
            'price' => 2500
        ]);
        DB::table('products')->insert([
            'name' => 'Caballete',
            'details' => 'esta re piola el Caballete',
            'price' => 2500
        ]);
    }
}
