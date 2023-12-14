<?php

namespace App\Controllers;

use App\Models\TicketModel;
use App\Models\MovieModel;

use CodeIgniter\Controller;

class TicketController extends BaseController
{
    protected $ticketModel;
    protected $movieModel;
    protected $movieInfo;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
        $this->movieModel = new MovieModel();
        $url = 'http://localhost:8081/movieAPI';
        $jsonString = file_get_contents($url);
        $jsonData = json_decode($jsonString, true);
        $this->movieInfo = $jsonData['movies'];
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

        foreach ($data['seats'] as $seat) {
            $this->ticketModel->insert([
                'movieId' => $movieDetail['movieId'],
                'movieName' => $movieDetail['title'],
                'date' => date('Y-m-d'),
                'time' => $data['showTime'],
                'seats' => $seat,
                'totalPrice' => 123000
            ]);
        }

        session()->setFlashdata('pesan', 'Ticket berhasil dipesan');

        return redirect()->to('/');
    }
}
