<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'movieId' => 1,
                'movieName'    => 'The Nun',
                'date' => date('Y-m-d'),
                'time' => '17.20',
                'seats' => 'A1',
                'price' => 12000,
                'paymentId' => 1,
            ],
            [
                'movieId' => 2,
                'movieName'    => 'The Amazing Spiderman',
                'date' => date('Y-m-d'),
                'time' => '17.20',
                'seats' => 'A2',
                'price' => 145000,
                'paymentId' => 2,
            ],
            [
                'movieId' => 1,
                'movieName'    => 'The Nun',
                'date' => date('Y-m-d'),
                'time' => '17.20',
                'seats' => 'A3',
                'price' => 15000,
                'paymentId' => 3,
            ],
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

        // Using Query Builder
        $this->db->table('ticket')->insertBatch($data);
    }
}
