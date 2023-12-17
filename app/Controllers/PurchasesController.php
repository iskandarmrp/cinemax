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

    public function showPurchases()
    {
        if (session()->get('email') == '') {
            return redirect()->to('/login');
        }
        $payment = $this->paymentModel->getWhere(['email' => session()->get('email')])->getResultArray();

        $data = ['title' => 'purchases', 'payment' => $payment, 'email' => session()->get('email'), 'flow' => 2];
        return view('layout/header', $data) . view('purchases', $data) . view('layout/footer');
    }

    public function detail($id)
    {
        $ticket = $this->ticketModel->getWhere(['paymentId' => $id])->getResultArray();
        $data = ['title' => 'Detail Movie', 'ticket' => $ticket, 'email' => session()->get('email'), 'flow' => 0];
        return view('layout/header', $data) . view('purchase_detail', $data) . view('layout/footer');
    }
}
