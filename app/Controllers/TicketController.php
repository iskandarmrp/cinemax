<?php

namespace App\Controllers;

use App\Models\TicketModel;

use CodeIgniter\Controller;

class TicketController extends BaseController
{
    protected $ticketModel;
    protected $movieInfo;
    protected $showTimeInfo;

    public function __construct()
    {
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
        foreach ($this->showTimeInfo as $showTime) {
            if ($showTime['showTimeId'] == $data['showTime']) {
                $showTimeDetail = $showTime;
                break;
            }
        }

        foreach ($data['seats'] as $seat) {
            $this->ticketModel->insert([
                'movieId' => $movieDetail['movieId'],
                'movieName' => $movieDetail['title'],
                'date' => date('Y-m-d'),
                'time' => $showTimeDetail['time'],
                'seats' => $seat,
                'price' => $showTimeDetail['price']
            ]);
        }

        session()->setFlashdata('pesan', 'Ticket berhasil dipesan');

        return redirect()->to('/');
    }
}
