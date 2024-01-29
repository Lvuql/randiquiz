<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modeltransaksi;

class Transaksi extends BaseController
{
    public function index()
    {
        if (session()->get('masuk') == true) {
            $userLevel = session()->get('level');

            // Izinkan akses untuk pengguna dengan level 1 atau level 3
            if ($userLevel == 1 || $userLevel == 3) {
                $model = new Modeltransaksi();
                $data['transaksi'] = $model->getTransaksi()->getResultArray();
                $data['data_pelanggan'] = $model->getPelanggan()->getResult();
                $data['data_tarif'] = $model->getTarif()->getResult();
                echo view('transaksi/v_transaksi', $data);
            } else {
                echo "<script>alert('Akses Anda Dibatasi'); window.location.href='/layout';</script>";
            }
        } else {
            echo "<script>alert('Anda Belum Login'); window.location.href='/login';</script>";
        }
    }
    public function save()
    {
        $model = new Modeltransaksi();
        $data = array(
                
            'idpel' => $this->request->getPost('idpelanggan'),
            'idharga' => $this->request->getPost('idagenda'),
            'meterblnini' => $this->request->getPost('meterbulanini'),
            'meterblnlalu' => $this->request->getPost('meterbulanlalu'),
            'tglbayar' => $this->request->getPost('tanggal'),
        );
        $model->insertData($data);
        return redirect()->to('/transaksi');
    }

    public function laporanperperiode()
    {
        if (session()->get('masuk') == true) {
            $userLevel = session()->get('level');

            // Izinkan akses untuk pengguna dengan level 1 atau level 3
            if ($userLevel == 1 || $userLevel == 3 || $userLevel == 2) {
                echo view('transaksi/vlaporantransaksi');
            } else {
                echo "<script>alert('Akses Anda Dibatasi'); window.location.href='/layout';</script>";
            }
        } else {
            echo "<script>alert('Anda Belum Login'); window.location.href='/login';</script>";
        }
    } 

    public function cetaklaporanperperiode()
    {
        $model = new Modeltransaksi();
        $tgla = $this->request->getPost('tanggal_awal');
        $tglb = $this->request->getPost('tanggal_akhir');
        $query = $model->getLaporanperperiode($tgla, $tglb)->getResultArray();
        $data = [
            'tgla' => $tgla,
            'tglb' => $tglb,
            'data' => $query
        ];
        echo view('transaksi/vcetaklaporanperperiode', $data);
    }
}
