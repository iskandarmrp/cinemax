<?php

namespace App\Controllers;

use App\Models\MovieModel;
use App\Models\PaymentModel;
use App\Models\TicketModel;

class Home extends BaseController
{
    protected $movieModel;
    protected $paymentModel;
    protected $ticketModel;
    protected $movieInfo;

    public function __construct()
    {
        $this->movieModel = new MovieModel();
        $this->paymentModel = new PaymentModel();
        $this->ticketModel = new TicketModel();
        $url = 'http://localhost:8081/movieAPI';
        $jsonString = file_get_contents($url);
        $jsonData = json_decode($jsonString, true);
        $this->movieInfo = $jsonData['movies'];
    }

    public function index()
    {
        if (session()->get('num_user') == '') {
            return redirect()->to('/login');
        }
        $data = ['title' => 'Daftar Movie', 'movie' => $this->movieInfo];
        return view('layout/header') . view('home', $data) . view('layout/footer');
    }

    public function detail($title)
    {
        $movieDetail = null;
        foreach ($this->movieInfo as $movie) {
            if ($movie['title'] == $title) {
                $movieDetail = $movie;
                break;
            }
        }
        $data = ['title' => 'Detail Movie', 'movie' => $movieDetail];
        return view('layout/header') . view('movie_detail', $data) . view('layout/footer');
    }
}
