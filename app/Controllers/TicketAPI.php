<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\TicketModel;
use App\Models\Auth;

class TicketAPI extends ResourceController
{
    // public function index($seg1 = null, $seg2 = null)
    // {
    //     $model = model(Auth::class);
    //     $email = $seg1;
    //     $password = md5($seg2);
    //     $cek = $model->getDataAuthentication($email, $password);
    //     if ($cek == 0) {
    //         return ("Wrong Authentication!");
    //     } else {
    //         $model1 = model(TicketModel::class);
    //         $data = [
    //             'message' => 'success',
    //             'ticket' => $model1->getDataTicket()
    //         ];
    //         return $this->respond($data, 200);
    //     }
    // }

    public function index($seg1 = null, $seg2 = null)
    {
        if (($seg1 == 'josua.sinabutar@gmail.com') & ($seg2 == md5('password'))) {
            $model1 = model(TicketModel::class);
            $data = [
                'message' => 'success',
                'payment' => $model1->getDataTicket()
            ];
            return $this->respond($data, 200);
        } else {
            return ("Wrong Authentication!");
        }
    }
}
