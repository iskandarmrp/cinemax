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
        $url = 'http://localhost:8081/movieAPI/josua.sinabutar@gmail.com/password';
        $jsonString = file_get_contents($url);
        $jsonData = json_decode($jsonString, true);
        $this->movieInfo = $jsonData['movie'];
        $url2 = 'http://localhost:8081/scheduleAPI/josua.sinabutar@gmail.com/password';
        $jsonString2 = file_get_contents($url2);
        $jsonData2 = json_decode($jsonString2, true);
        $this->scheduleInfo = $jsonData2['schedule'];
    }

    public function choosePaymentMethod()
    {
        if ($this->request->getVar('email') == '') {
            return redirect()->to('/login');
        }
        $movieDetail = $this->getMovieDetailByTitle($this->request->getVar('title'));

        $showTimeDetail = $this->getScheduleByID($this->request->getVar('showTime'));

        $data = ['title' => 'payment', 'movie' => $movieDetail, 'showTime' => $showTimeDetail, 'seats' => $this->request->getVar('seats[]'), 'email' => $this->request->getVar('email'), 'count' => count($this->request->getVar('seats[]')), 'flow' => 0];
        return view('layout/header', $data) . view('payment', $data) . view('layout/footer');
    }

    public function purchase()
    {
        if ($this->request->getVar('email') == '') {
            return redirect()->to('/login');
        }

        $showTimeDetail = $this->getScheduleByID($this->request->getVar('showTime'));

        $movieName = $this->getMovieNameByID($showTimeDetail['movieID']);

        $totalPrice = $this->calculateTotalPrice($this->request->getVar('seats'), $showTimeDetail['price']);

        return $this->createPaymentAndTicket(date('Y-m-d H:i:s'), $this->request->getVar('email'), $totalPrice, $this->request->getVar('paymentMethod'), $movieName, $showTimeDetail['showtime'], $this->request->getVar('seats'), $this->request->getVar('title'), $this->request->getVar('showTime'));
    }

    public function getMovieDetailByTitle($title)
    {
        $movieDetail = null;
        foreach ($this->movieInfo as $movie) {
            if ($movie['title'] == $title) {
                $movieDetail = $movie;
                break;
            }
        }
        return $movieDetail;
    }

    public function getScheduleByID($ID)
    {
        $showTimeDetail = null;
        foreach ($this->scheduleInfo as $schedule) {
            if ($schedule['scheduleID'] == $ID) {
                $showTimeDetail = $schedule;
                break;
            }
        }
        return $showTimeDetail;
    }

    public function getMovieNameByID($ID)
    {
        $movieName = '';
        foreach ($this->movieInfo as $m) {
            if ($m['movieID'] == $ID) {
                $movieName = $m['title'];
                break;
            }
        }
        return $movieName;
    }

    public function calculateTotalPrice($seats, $price)
    {
        $totalPrice = 0;
        foreach (explode(', ', $seats) as $s) {
            $totalPrice = $totalPrice + $price;
        }
        return $totalPrice;
    }

    public function createPaymentAndTicket($date, $email, $totalPrice, $paymentMethod, $movieName, $showTime, $seats, $title, $scheduleID)
    {
        $this->paymentModel->insert([
            'paymentDate' => $date,
            'email' => $email,
            'totalPrice' => $totalPrice,
            'paymentMethod' => $paymentMethod,
            'movieName' => $movieName,
            'showtime' => $showTime,
            'seats' => json_encode(explode(', ', $seats)),
        ]);

        return redirect()->to(base_url('/ticket/create'))->with('data', [
            'title' => $title,
            'seats' => explode(', ', $seats),
            'showTime' => $scheduleID,
            'paymentId' => $this->paymentModel->insertID(),
            'email' => $email,
        ]);
    }
}
