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
        // $movie = $this->movieModel->where(['title' => $data['title']])->first();
        $movieDetail = null;
        foreach ($this->movieInfo as $movie) {
            if ($movie['title'] == $data['title']) {
                $movieDetail = $movie;
                break;
            }
        }

        $showTimeDetail = null;
        foreach ($this->scheduleInfo as $showTime) {
            if ($showTime['scheduleID'] == $data['showTime']) {
                $showTimeDetail = $showTime;
                break;
            }
        }

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

        session()->setFlashdata('pesan', 'Ticket berhasil dipesan');
        $email = '/' . $data['email'];
        $data = ['title' => 'success', 'email' => $data['email']];
        return view('layout/header', $data) . view('success', $data) . view('layout/footer');
    }
}
