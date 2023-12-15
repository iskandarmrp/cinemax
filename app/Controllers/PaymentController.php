<?php

namespace App\Controllers;

use App\Models\PaymentModel;
use App\Models\TicketModel;

use CodeIgniter\Controller;

class PaymentController extends BaseController
{
    protected $paymentModel;
    protected $ticketModel;
    protected $movieInfo;
    protected $showTimeInfo;

    public function __construct()
    {
        $this->paymentModel = new PaymentModel();
        $this->ticketModel = new TicketModel();
        $url = 'http://localhost:8081/movieAPI';
        $jsonString = file_get_contents($url);
        $jsonData = json_decode($jsonString, true);
        $this->movieInfo = $jsonData['movies'];
        $url2 = 'http://localhost:8081/showTimeAPI';
        $jsonString2 = file_get_contents($url2);
        $jsonData2 = json_decode($jsonString2, true);
        $this->showTimeInfo = $jsonData2['showtime'];
    }

    public function index()
    {
        if ($this->request->getVar('email') == '') {
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
        $showTimeDetail = null;
        foreach ($this->showTimeInfo as $showTime) {
            if ($showTime['showTimeId'] == $this->request->getVar('showTime')) {
                $showTimeDetail = $showTime;
                break;
            }
        }
        $data = ['title' => 'payment', 'movie' => $movieDetail, 'showTime' => $showTimeDetail, 'seats' => $this->request->getVar('seats[]'), 'email' => $this->request->getVar('email')];
        return view('layout/header', $data) . view('payment', $data) . view('layout/footer');
    }

    public function purchase()
    {
        if ($this->request->getVar('email') == '') {
            return redirect()->to('/login');
        }
        $showTimeDetail = null;
        foreach ($this->showTimeInfo as $showTime) {
            if ($showTime['showTimeId'] == $this->request->getVar('showTime')) {
                $showTimeDetail = $showTime;
                break;
            }
        }

        $totalPrice = 0;
        foreach (explode(', ', $this->request->getVar('seats')) as $s) {
            $totalPrice = $totalPrice + $showTimeDetail['price'];
        }

        $this->paymentModel->insert([
            'paymentDate' => date('Y-m-d'),
            'email' => $this->request->getVar('email'),
            'totalPrice' => $totalPrice,
            'paymentMethod' => $this->request->getVar('paymentMethod')
        ]);

        return redirect()->to(base_url('/ticket/create'))->with('data', [
            'title' => $this->request->getVar('title'),
            'seats' => explode(', ', $this->request->getVar('seats')),
            'showTime' => $this->request->getVar('showTime'),
            'paymentId' => $this->paymentModel->insertID(),
            'email' => $this->request->getVar('email'),
        ]);
    }
}
