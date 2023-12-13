<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payment';
    protected $primaryKey = 'paymentId';
    protected $allowedFields = ['paymentDate', 'email', 'totalPrice', 'paymentMethod'];

    public function getDataPayment()
    {
        return $this->findAll();
    }
}
