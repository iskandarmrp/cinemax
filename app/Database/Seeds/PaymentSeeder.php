<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'paymentDate' => date('Y-m-d H:i:s'),
                'email'    => 'budi@gmail.com',
                'totalPrice' => 300,
                'paymentMethod' => 'ovo',
                'movieName' => 'Hamilton',
                'showtime' => date('Y-m-d H:i:s', strtotime("2024-06-01 10:00:00")),
                'seats' => json_encode(['A1', 'B1', 'C1']),
            ],
        ];

        $this->db->table('payment')->insertBatch($data);
    }
}
