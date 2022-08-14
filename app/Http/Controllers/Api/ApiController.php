<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nasabah;
use App\Models\Riwayat;

class ApiController extends Controller
{
    public function datatableNasabah()
    {
        $nasabah    = Nasabah::get();
        $data       = array();

        foreach($nasabah as $item) {
            $status = $item->information->status == 1 ? 'Approved' : 'Rejected';

            $data[] = [
                $item->name,
                $item->nik,
                $item->information->status == 0 ? 'Not Action' : $status,
                ''
            ];
        }

        return [
            'data'  => $data
        ];
    }

    public function datatableRiwayat()
    {
        $riwayats   = Riwayat::get();
        $data       = array();

        foreach($riwayats as $item) {
            $status = $item->information->status == 1 ? 'Diterima' : 'Ditolak';

            $data[] = [
                $item->nasabah->name,
                $item->nasabah->nik,
                $item->borrow_date,
                $status,
            ];
        }

        return [
            'data'  => $data
        ];
    }
}
