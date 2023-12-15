<?php

namespace App\Controllers;

use App\Models\PaymentModel;
use App\Models\TicketModel;

use CodeIgniter\Controller;

class PurchasesController extends BaseController
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

    public function index()
    {
        if (session()->get('num_user') == '') {
            return redirect()->to('/login');
        }
        $payment = $this->paymentModel->getWhere(['email' => 'jamesanderson@gmail.com'])->getResultArray();

        $data = ['title' => 'purchases', 'payment' => $payment];
        return view('layout/header') . view('purchases', $data) . view('layout/footer');
    }

    public function detail($id)
    {
        $ticket = $this->ticketModel->getWhere(['paymentId' => $id])->getResultArray();
        $data = ['title' => 'Detail Movie', 'ticket' => $ticket];
        return view('layout/header') . view('purchase_detail', $data) . view('layout/footer');
    }
}
