<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nasabah;
use App\Models\Riwayat;
use App\Http\Controllers\FrontendController;

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
                '<a href="/nasabah/delete/'.$item->id.'" class="btn btn-small waves-effect waves-light red"><i class="material-icons">delete</i></a>',
            ];
        }

        return [
            'data'  => $data
        ];
    }

    public function datatableRiwayat()
    {
        $nasabahs   = Nasabah::whereHas('riwayat')->get();
        $data       = array();
        $Controller = new FrontendController();

        foreach($nasabahs as $item) {
            $status = $item->status == 1 ? '<span class="new badge green" data-badge-caption="">Approved</span>' : '<span class="new badge red" data-badge-caption="">Rejected</span>';

            $data[] = [
                $item->name_by_identity,
                $item->nik,
                $item->riwayat ? \Carbon\Carbon::parse($item->riwayat->borrow_date)->format('d-m-Y') : 'Tidak ada',
                $status,
                '<span class="new badge blue" data-badge-caption="">'.floatval(number_format($item->fuzzy_result, 2)).'%</span>',
                $item->riwayat ? $Controller->formatRupiah($item->riwayat->loan_nominal) : 'Tidak ada',
                $item->riwayat ? $Controller->formatRupiah($item->riwayat->remaining_payment) : 'Tidak ada',
            ];
        }

        return [
            'data'  => $data
        ];
    }
}
