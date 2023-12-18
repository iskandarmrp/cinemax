<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'email'    => 'budi@gmail.com',
                'password' => '5f4dcc3b5aa765d61d8327deb882cf99',
                'name' => 'Budi Hartono',
            ],
            [
                'email'    => 'james@gmail.com',
                'password' => '5f4dcc3b5aa765d61d8327deb882cf99',
                'name' => 'James Harden',
            ],
            [
                'email'    => 'tony@gmail.com',
                'password' => '5f4dcc3b5aa765d61d8327deb882cf99',
                'name' => 'Tony Montana',
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
