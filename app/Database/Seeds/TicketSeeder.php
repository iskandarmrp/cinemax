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
                'movieName'    => 'Hamilton',
                'date' => date('Y-m-d H:i:s'),
                'time' => date('Y-m-d H:i:s', strtotime("2024-06-01 10:00:00")),
                'seats' => 'A1',
                'price' => 100,
                'paymentId' => 1,
            ],
            [
                'movieId' => 1,
                'movieName'    => 'Hamilton',
                'date' => date('Y-m-d H:i:s'),
                'time' => date('Y-m-d H:i:s', strtotime("2024-06-01 10:00:00")),
                'seats' => 'B1',
                'price' => 100,
                'paymentId' => 1,
            ],
            [
                'movieId' => 1,
                'movieName'    => 'Hamilton',
                'date' => date('Y-m-d H:i:s'),
                'time' => date('Y-m-d H:i:s', strtotime("2024-06-01 10:00:00")),
                'seats' => 'C1',
                'price' => 100,
                'paymentId' => 1,
            ],
        ];

        $this->db->table('ticket')->insertBatch($data);
    }
}
