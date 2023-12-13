<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\MovieModel;
use App\Models\MovieAuth;

class MovieAPI extends ResourceController
{
    public function index($seg1 = null, $seg2 = null)
    {
        $model = model(MovieAuth::class);
        $email = $seg1;
        $password = md5($seg2);
        $cek = $model->getDataAuthentication($email, $password);
        if ($cek == 0) {
            return ("Wrong Authentication!");
        } else {
            $model1 = model(MovieModel::class);
            $data = [
                'message' => 'success',
                'movies' => $model1->getDataMovie()
            ];
            return $this->respond($data, 200);
        }
    }
}
