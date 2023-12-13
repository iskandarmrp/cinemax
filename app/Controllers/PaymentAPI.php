<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PaymentModel;
use App\Models\Auth;

class PaymentAPI extends ResourceController
{
    public function index($seg1 = null, $seg2 = null)
    {
        $model = model(Auth::class);
        $email = $seg1;
        $password = md5($seg2);
        $cek = $model->getDataAuthentication($email, $password);
        if ($cek == 0) {
            return ("Wrong Authentication!");
        } else {
            $model1 = model(PaymentModel::class);
            $data = [
                'message' => 'success',
                'payment' => $model1->getDataPayment()
            ];
            return $this->respond($data, 200);
        }
    }
}
