<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // TransactionSeeder.php
public function run(): void
{
    DB::table('transactions')->insert([
        // Maggio 2026 - expense
        ['user_id' => 1, 'category_id' => 1, 'amount' => 85.50,  'type' => 'expense', 'description' => 'Supermercato Esselunga',   'date' => '2026-05-01', 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'category_id' => 1, 'amount' => 42.00,  'type' => 'expense', 'description' => 'Supermercato Conad',       'date' => '2026-05-05', 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'category_id' => 2, 'amount' => 29.99,  'type' => 'expense', 'description' => 'Steam — gioco nuovo',      'date' => '2026-05-02', 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'category_id' => 2, 'amount' => 15.00,  'type' => 'expense', 'description' => 'Netflix abbonamento',      'date' => '2026-05-03', 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'category_id' => 3, 'amount' => 38.00,  'type' => 'expense', 'description' => 'Abbonamento mensile ATM',  'date' => '2026-05-01', 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'category_id' => 4, 'amount' => 25.00,  'type' => 'expense', 'description' => 'Farmacia',                 'date' => '2026-05-04', 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'category_id' => 6, 'amount' => 600.00, 'type' => 'expense', 'description' => 'Affitto maggio',          'date' => '2026-05-01', 'created_at' => now(), 'updated_at' => now()],
        // Maggio 2026 - income
        ['user_id' => 1, 'category_id' => 7, 'amount' => 1400.00,'type' => 'income',  'description' => 'Stipendio maggio',        'date' => '2026-05-01', 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'category_id' => 8, 'amount' => 250.00, 'type' => 'income',  'description' => 'Progetto freelance',      'date' => '2026-05-03', 'created_at' => now(), 'updated_at' => now()],
        // Aprile 2026 - expense
        ['user_id' => 1, 'category_id' => 1, 'amount' => 90.00,  'type' => 'expense', 'description' => 'Supermercato Esselunga',  'date' => '2026-04-03', 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'category_id' => 2, 'amount' => 59.99,  'type' => 'expense', 'description' => 'Concerto',                'date' => '2026-04-10', 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'category_id' => 3, 'amount' => 38.00,  'type' => 'expense', 'description' => 'Abbonamento mensile ATM', 'date' => '2026-04-01', 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'category_id' => 5, 'amount' => 89.90,  'type' => 'expense', 'description' => 'Scarpe nuove',            'date' => '2026-04-15', 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'category_id' => 6, 'amount' => 600.00, 'type' => 'expense', 'description' => 'Affitto aprile',         'date' => '2026-04-01', 'created_at' => now(), 'updated_at' => now()],
        // Aprile 2026 - income
        ['user_id' => 1, 'category_id' => 7, 'amount' => 1400.00,'type' => 'income',  'description' => 'Stipendio aprile',       'date' => '2026-04-01', 'created_at' => now(), 'updated_at' => now()],
        ['user_id' => 1, 'category_id' => 9, 'amount' => 100.00, 'type' => 'income',  'description' => 'Regalo compleanno',      'date' => '2026-04-20', 'created_at' => now(), 'updated_at' => now()],
    ]);
}
}
