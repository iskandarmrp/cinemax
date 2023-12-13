<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Payment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'paymentId' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'paymentDate' => [
                'type'       => 'DATETIME',
                null => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'totalPrice' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'paymentMethod' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addKey('paymentId', true);
        $this->forge->createTable('payment');
    }

    public function down()
    {
        $this->forge->dropTable('payment');
    }
}
