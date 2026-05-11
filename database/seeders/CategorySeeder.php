<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // CategorySeeder.php
public function run(): void
{
    DB::table('categories')->insert([
        ['user_id' => 1, 'name' => 'Spesa',        'color' => '#ff4d6d', 'icon' => '🛒', 'type' => 'expense', 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'name' => 'Svago',         'color' => '#845ef7', 'icon' => '🎮', 'type' => 'expense', 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'name' => 'Trasporti',     'color' => '#339af0', 'icon' => '🚗', 'type' => 'expense', 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'name' => 'Salute',        'color' => '#51cf66', 'icon' => '💊', 'type' => 'expense', 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'name' => 'Abbigliamento', 'color' => '#f783ac', 'icon' => '👕', 'type' => 'expense', 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'name' => 'Casa',          'color' => '#ffa94d', 'icon' => '🏠', 'type' => 'expense', 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'name' => 'Stipendio',     'color' => '#00f5a0', 'icon' => '💰', 'type' => 'income',  'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'name' => 'Freelance',     'color' => '#74c0fc', 'icon' => '💻', 'type' => 'income',  'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'name' => 'Regalo',        'color' => '#ffd43b', 'icon' => '🎁', 'type' => 'income',  'created_at' => now(), 'updated_at' => now()],
    ]);
}
}
