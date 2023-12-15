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
    protected $scheduleInfo;

    public function __construct()
    {
        $this->paymentModel = new PaymentModel();
        $this->ticketModel = new TicketModel();
        $url = 'http://localhost:8081/movieAPI';
        $jsonString = file_get_contents($url);
        $jsonData = json_decode($jsonString, true);
        $this->movieInfo = $jsonData['movie'];
        $url2 = 'http://localhost:8081/scheduleAPI';
        $jsonString2 = file_get_contents($url2);
        $jsonData2 = json_decode($jsonString2, true);
        $this->scheduleInfo = $jsonData2['schedule'];
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
        foreach ($this->scheduleInfo as $schedule) {
            if ($schedule['scheduleID'] == $this->request->getVar('showTime')) {
                $showTimeDetail = $schedule;
                break;
            }
        }
        $data = ['title' => 'payment', 'movie' => $movieDetail, 'showTime' => $showTimeDetail, 'seats' => $this->request->getVar('seats[]'), 'email' => $this->request->getVar('email'), 'count' => count($this->request->getVar('seats[]'))];
        return view('layout/header', $data) . view('payment', $data) . view('layout/footer');
    }

    public function purchase()
    {
        if ($this->request->getVar('email') == '') {
            return redirect()->to('/login');
        }
        $movieName = '';
        $showTimeDetail = null;
        foreach ($this->scheduleInfo as $showTime) {
            if ($showTime['scheduleID'] == $this->request->getVar('showTime')) {
                $showTimeDetail = $showTime;
                break;
            }
        }
        foreach ($this->movieInfo as $m) {
            if ($m['movieID'] == $showTimeDetail['movieID']) {
                $movieName = $m['title'];
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
            'paymentMethod' => $this->request->getVar('paymentMethod'),
            'movieName' => $movieName,
            'showtime' => $showTimeDetail['showtime'],
            'seats' => json_encode(explode(', ', $this->request->getVar('seats'))),
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
