<?php

namespace App\Controllers;

use App\Models\PaymentModel;
use App\Models\TicketModel;

class Home extends BaseController
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

    public function index($email)
    {
        if ($email == '') {
            return redirect()->to('/login');
        }
        $data = ['title' => 'Daftar Movie', 'movie' => $this->movieInfo, 'email' => $email];
        return view('layout/header', $data) . view('home', $data) . view('layout/footer');
    }

    public function detail($title, $email)
    {
        if ($email == '') {
            return redirect()->to('/login');
        }
        $movieDetail = null;
        foreach ($this->movieInfo as $movie) {
            if ($movie['title'] == $title) {
                $movieDetail = $movie;
                break;
            }
        }
        $showTimeDetail = [];
        foreach ($this->showTimeInfo as $showTime) {
            if ($showTime['movieId'] == $movieDetail['movieId']) {
                array_push($showTimeDetail, $showTime);
            }
        }
        $data = ['title' => 'Detail Movie', 'movie' => $movieDetail, 'showtime' => $showTimeDetail, 'email' => $email];
        return view('layout/header', $data) . view('movie_detail', $data) . view('layout/footer');
    }
}
