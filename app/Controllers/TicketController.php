<?php

namespace App\Controllers;

use App\Models\TicketModel;

use CodeIgniter\Controller;

class TicketController extends BaseController
{
    protected $ticketModel;
    protected $movieInfo;
    protected $scheduleInfo;

    public function __construct()
    {
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
        return view('layout/header') . view('ticket_create') . view('layout/footer');
    }

    public function create()
    {
        $data = session()->getFlashdata('data');

        $movieDetail = $this->getMovieByTitle($data['title']);

        $showTimeDetail = $this->getScheduleByID($data['showTime']);

        foreach ($data['seats'] as $seat) {
            $this->ticketModel->insert([
                'movieId' => $movieDetail['movieID'],
                'movieName' => $movieDetail['title'],
                'date' => date('Y-m-d'),
                'time' => $showTimeDetail['showtime'],
                'seats' => $seat,
                'price' => $showTimeDetail['price'],
                'paymentId' => $data['paymentId'],
            ]);
        }

        $data = ['title' => 'success', 'email' => $data['email'], 'flow' => 0];
        return view('layout/header', $data) . view('success', $data) . view('layout/footer');
    }

    public function getMovieByTitle($title)
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
        foreach ($this->scheduleInfo as $showTime) {
            if ($showTime['scheduleID'] == $ID) {
                $showTimeDetail = $showTime;
                break;
            }
        }
        return $showTimeDetail;
    }
}
