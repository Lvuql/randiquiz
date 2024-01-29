<?php

namespace App\Models;

use CodeIgniter\Model;

class Modeltransaksi extends Model
{
    // MODEL ANAK YATIM

    public function getTransaksi()
    {
        $builder = $this->db->table('tbl_transaksi')
            ->join('tbl_pelanggan', 'idpel=id')
            ->join('tbl_tarif', 'idharga=idtarif');
        return $builder->get();
    }

    public function getPelanggan()
    {
        $builder = $this->db->table('tbl_pelanggan');
        return $builder->get();
    }
    public function getTarif()
    {
        $builder = $this->db->table('tbl_tarif');
        return $builder->get();
    }

    public function insertData($data)
    {
        $this->db->table('tbl_transaksi')->insert($data);
    }

    public function getLaporanperperiode($tgla, $tglb)
    {
        $builder = $this->db->table('tbl_transaksi')
            ->join('tbl_pelanggan', 'idpel=id')
            ->join('tbl_tarif', 'idharga=idtarif')
            ->where('tglbayar >=', $tgla)
            ->where('tglbayar <=', $tglb);

        return $builder->get();
    }
}
