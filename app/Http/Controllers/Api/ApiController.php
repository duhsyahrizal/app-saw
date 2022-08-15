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
            $status = $item->status == 1 ? '<span class="new badge green" data-badge-caption="">Approved</span>' : '<span class="new badge red" data-badge-caption="">Rejected</span>';

            $data[] = [
                $item->name_by_identity,
                $item->nik,
                $item->status == 0 ? '<span class="new badge orange" data-badge-caption="">Not Action</span>' : $status,
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
