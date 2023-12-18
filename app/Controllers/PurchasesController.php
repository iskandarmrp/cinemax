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
    protected $studioInfo;

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
        $url3 = 'http://localhost:8081/studioAPI';
        $jsonString3 = file_get_contents($url3);
        $jsonData3 = json_decode($jsonString3, true);
        $this->studioInfo = $jsonData3['studio'];
    }

    public function showPurchases()
    {
        if (session()->get('email') == '') {
            return redirect()->to('/login');
        }
        $payment = $this->paymentModel->getWhere(['email' => session()->get('email')])->getResultArray();
        $payment = $this->getAllPaymentWithStudioName($payment);

        $data = ['title' => 'purchases', 'payment' => $payment, 'email' => session()->get('email'), 'flow' => 2];
        return view('layout/header', $data) . view('purchases', $data) . view('layout/footer');
    }

    public function detail($id)
    {
        $studioName = $this->getStudioNameByPaymentID($id);
        $ticket = $this->ticketModel->getWhere(['paymentId' => $id])->getResultArray();
        $data = ['title' => 'Detail Movie', 'ticket' => $ticket, 'email' => session()->get('email'), 'flow' => 0, 'studioName' => $studioName];
        return view('layout/header', $data) . view('purchase_detail', $data) . view('layout/footer');
    }

    public function getAllPaymentWithStudioName($payment)
    {
        $paymentWithStudioNames = [];
        foreach ($payment as $p) {
            $studioName = $this->getStudioNameByPaymentID($p['paymentId']);
            $paymentWithStudioNames[] = array_merge($p, ['studioName' => $studioName]);
        }
        return $paymentWithStudioNames;
    }

    public function getStudioNameByPaymentID($ID)
    {
        $payment = $this->paymentModel->where('paymentId', $ID)->first();
        $studioName = '';
        foreach ($this->scheduleInfo as $s) {
            if ($s['showtime'] == $payment['showtime']) {
                foreach ($this->movieInfo as $m) {
                    if (($m['title'] == $payment['movieName']) && ($m['movieID'] == $s['movieID'])) {
                        foreach ($this->studioInfo as $st) {
                            if ($st['studioID'] == $s['studioID']) {
                                $studioName = $st['studioName'];
                                break;
                            }
                        }
                    }
                }
            }
        }
        return $studioName;
    }
}
