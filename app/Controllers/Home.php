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

    public function home()
    {
        if (session()->get('email') == '') {
            return redirect()->to('/login');
        }
        $data = ['title' => 'Daftar Movie', 'movie' => $this->movieInfo, 'email' => session()->get('email'), 'flow' => 1];
        return view('layout/header', $data) . view('home', $data) . view('layout/footer');
    }

    public function detail($title)
    {
        if (session()->get('email') == '') {
            return redirect()->to('/login');
        }
        $movieDetail = $this->getMovieDetailByTitle($title);
        $scheduleDetail = $this->getScheduleByMovieID($movieDetail['movieID']);

        $data = ['title' => 'Detail Movie', 'movie' => $movieDetail, 'schedule' => $scheduleDetail, 'email' => session()->get('email'), 'flow' => 0];
        return view('layout/header', $data) . view('movie_detail', $data) . view('layout/footer');
    }

    public function showSeats($title)
    {
        if (session()->get('email') == '') {
            return redirect()->to('/login');
        }
        $movieDetail = $this->getMovieDetailByTitle($title);

        $showTimeDetail = $this->getScheduleByID($this->request->getVar('showTime'));

        $showTimeSeats = $this->getAvailableSeats($showTimeDetail);

        $data = ['title' => 'Detail Movie', 'movie' => $movieDetail, 'schedule' => $showTimeDetail, 'email' => session()->get('email'), 'flow' => 0, 'seats' => $showTimeSeats];
        return view('layout/header', $data) . view('choose_seats', $data) . view('layout/footer');
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

    public function getScheduleByMovieID($movieID)
    {
        $scheduleDetail = [];
        foreach ($this->scheduleInfo as $schedule) {
            if ($schedule['movieID'] == $movieID) {
                array_push($scheduleDetail, $schedule);
            }
        }
        return $scheduleDetail;
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

    public function getAvailableSeats($schedule)
    {
        $showTimeSeats = json_decode($schedule['generated_seats']);
        $showTimeSeats2 = json_decode($schedule['generated_seats']);
        foreach ($showTimeSeats2 as $s) {
            $existingTicket = $this->ticketModel->where('time', $schedule['showtime'])->where('movieName', $schedule['movieTitle'])->where('seats', $s)->first();
            if ($existingTicket) {
                $showTimeSeats = array_filter($showTimeSeats, function ($element) use ($s) {
                    return $element != $s;
                });
            }
        }
        return $showTimeSeats;
    }
}
