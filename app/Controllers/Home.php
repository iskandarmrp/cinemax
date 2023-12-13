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

    public function __construct()
    {
        $this->movieModel = new MovieModel();
        $this->paymentModel = new PaymentModel();
        $this->ticketModel = new TicketModel();
    }

    public function index()
    {
        if (session()->get('num_user') == '') {
            return redirect()->to('/login');
        }
        $movie = $this->movieModel->findAll();
        $data = ['title' => 'Daftar Movie', 'movie' => $movie];
        return view('layout/header') . view('home', $data) . view('layout/footer');
    }

    public function detail($title)
    {
        $movie = $this->movieModel->where(['title' => $title])->first();
        $data = ['title' => 'Detail Movie', 'movie' => $movie];
        return view('layout/header') . view('movie_detail', $data) . view('layout/footer');
    }

    // public function payment()
    // {
    //     $movie = $this->movieModel->where(['title' => $this->request->getVar('title')])->first();
    //     $data = ['title' => 'payment', 'movie' => $movie, 'showTime' => $this->request->getVar('showTime'), 'numberOfSeats' => $this->request->getVar('numberOfSeats')];
    //     return view('layout/header') . view('payment', $data) . view('layout/footer');
    // }

    public function purchase()
    {
        $movie = $this->movieModel->where(['title' => $this->request->getVar('title')])->first();

        $this->paymentModel->insert([
            'paymentDate' => date('Y-m-d'),
            'email' => 'emails',
            'totalPrice' => 130000,
            'paymentMethod' => $this->request->getVar('paymentMethod')
        ]);
        $this->ticketModel->insert([
            'movieId' => $movie['movieId'],
            'movieName' => $movie['title'],
            'numberOfSeats' => $this->request->getVar('numberOfSeats'),
            'totalPrice' => 130000
        ]);
        session()->setFlashdata('pesan', 'Ticket berhasil dipesan');

        return redirect()->to('/');
    }
}
