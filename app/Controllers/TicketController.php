<?php

namespace App\Controllers;

use App\Models\TicketModel;
use App\Models\MovieModel;

use CodeIgniter\Controller;

class TicketController extends BaseController
{
    protected $ticketModel;
    protected $movieModel;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
        $this->movieModel = new MovieModel();
    }

    public function index()
    {
        return view('layout/header') . view('ticket_create') . view('layout/footer');
    }

    public function create()
    {
        $data = session()->getFlashdata('data');
        $movie = $this->movieModel->where(['title' => $data['title']])->first();
        foreach ($data['seats'] as $seat) {
            $this->ticketModel->insert([
                'movieId' => $movie['movieId'],
                'movieName' => $movie['title'],
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
