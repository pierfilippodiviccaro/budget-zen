<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   // BudgetSeeder.php
public function run(): void
{
    DB::table('budgets')->insert([
        // Maggio 2026
        ['user_id' => 1, 'category_id' => 1, 'amount_limit' => 300.00, 'month' => 5, 'year' => 2026, 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'category_id' => 2, 'amount_limit' => 150.00, 'month' => 5, 'year' => 2026, 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'category_id' => 3, 'amount_limit' => 100.00, 'month' => 5, 'year' => 2026, 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'category_id' => 4, 'amount_limit' => 80.00,  'month' => 5, 'year' => 2026, 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'category_id' => 5, 'amount_limit' => 120.00, 'month' => 5, 'year' => 2026, 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'category_id' => 6, 'amount_limit' => 600.00, 'month' => 5, 'year' => 2026, 'created_at' => now(), 'updated_at' => now()],
        // Aprile 2026
        ['user_id' => 1, 'category_id' => 1, 'amount_limit' => 300.00, 'month' => 4, 'year' => 2026, 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'category_id' => 2, 'amount_limit' => 150.00, 'month' => 4, 'year' => 2026, 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'category_id' => 3, 'amount_limit' => 100.00, 'month' => 4, 'year' => 2026, 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'category_id' => 5, 'amount_limit' => 120.00, 'month' => 4, 'year' => 2026, 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'category_id' => 6, 'amount_limit' => 600.00, 'month' => 4, 'year' => 2026, 'created_at' => now(), 'updated_at' => now()],
    ]);
}
}
