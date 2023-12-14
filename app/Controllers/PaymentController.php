<?php

namespace App\Controllers;

use App\Models\PaymentModel;
use App\Models\MovieModel;
use App\Models\TicketModel;

use CodeIgniter\Controller;

class PaymentController extends BaseController
{
    protected $paymentModel;
    protected $movieModel;
    protected $ticketModel;
    protected $movieInfo;

    public function __construct()
    {
        $this->paymentModel = new PaymentModel();
        $this->movieModel = new MovieModel();
        $this->ticketModel = new TicketModel();
        $url = 'http://localhost:8081/movieAPI';
        $jsonString = file_get_contents($url);
        $jsonData = json_decode($jsonString, true);
        $this->movieInfo = $jsonData['movies'];
    }

    public function index()
    {
        if (session()->get('num_user') == '') {
            return redirect()->to('/login');
        }
        // $movie = $this->movieModel->where(['title' => $this->request->getVar('title')])->first();
        $movieDetail = null;
        foreach ($this->movieInfo as $movie) {
            if ($movie['title'] == $this->request->getVar('title')) {
                $movieDetail = $movie;
                break;
            }
        }
        $data = ['title' => 'payment', 'movie' => $movieDetail, 'showTime' => $this->request->getVar('showTime'), 'seats' => $this->request->getVar('seats[]')];
        return view('layout/header') . view('payment', $data) . view('layout/footer');
    }

    public function purchase()
    {
        $this->paymentModel->insert([
            'paymentDate' => date('Y-m-d'),
            'email' => 'emails',
            'totalPrice' => 130000,
            'paymentMethod' => $this->request->getVar('paymentMethod')
        ]);

        return redirect()->to(base_url('/ticket/create'))->with('data', [
            'title' => $this->request->getVar('title'),
            'seats' => explode(', ', $this->request->getVar('seats')),
            'showTime' => $this->request->getVar('showTime'),
        ]);
    }
}
