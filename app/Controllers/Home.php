<?php

namespace App\Controllers;

use App\Models\PaymentModel;
use App\Models\TicketModel;

class Home extends BaseController
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
        $scheduleDetail = [];
        foreach ($this->scheduleInfo as $schedule) {
            if ($schedule['movieID'] == $movieDetail['movieID']) {
                array_push($scheduleDetail, $schedule);
            }
        }
        $data = ['title' => 'Detail Movie', 'movie' => $movieDetail, 'schedule' => $scheduleDetail, 'email' => $email];
        return view('layout/header', $data) . view('movie_detail', $data) . view('layout/footer');
    }
}
