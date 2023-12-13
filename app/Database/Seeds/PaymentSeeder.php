<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'paymentDate' => date('Y-m-d'),
                'email'    => 'darth@theempire.com',
                'totalPrice' => 120000,
                'paymentMethod' => 'ovo'
            ],
            [
                'paymentDate' => date('Y-m-d'),
                'email'    => 'oke@gmail.com',
                'totalPrice' => 17000,
                'paymentMethod' => 'gopay'
            ],
            [
                'paymentDate' => date('Y-m-d'),
                'email'    => 'jamesanderson@gmail.com',
                'totalPrice' => 90000,
                'paymentMethod' => 'DANA'
            ],

        ];

        // Simple Queries
        // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

        // Using Query Builder
        $this->db->table('payment')->insertBatch($data);
    }
}
