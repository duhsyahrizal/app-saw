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
        $nasabah    = Nasabah::orderBy('id', 'ASC')->get();
        $data       = array();

        foreach($nasabah as $idx =>  $item) {
            $status = $item->status == 1 ? '<span class="new badge green" data-badge-caption="">Approved</span>' : '<span class="new badge red" data-badge-caption="">Rejected</span>';

            $data[] = [
                $idx + 1,
                $item->name_by_identity,
                $item->nik,
                $item->status == 0 ? '<span class="new badge orange" data-badge-caption="">Not Action</span>' : $status,
                '<a href="/nasabah/detail/'.$item->id.'" class="btn btn-small waves-effect waves-light blue"><i class="material-icons">assignment</i></a> <a href="/nasabah/delete/'.$item->id.'" class="btn btn-small waves-effect waves-light red"><i class="material-icons">delete</i></a>',
            ];
        }

        return [
            'data'  => $data
        ];
    }

    public function datatableResult()
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

    public function datatablePassResult()
    {
        $nasabahs   = Nasabah::whereHas('result')->get();
        $data       = array();

        foreach($nasabahs as $idx => $item) {
            $data[] = [
                $idx + 1,
                $item->name_by_identity,
                floatval(number_format($item->result->age_result, 2)) . '%',
                floatval(number_format($item->result->status_result, 2)) . '%',
                floatval(number_format($item->result->plafond_result, 2)) . '%',
                floatval(number_format($item->result->business_age_result, 2)) . '%',
                floatval(number_format($item->fuzzy_result, 2)) . '%',
            ];
        }

        return [
            'data'  => $data
        ];
    }

    public function datatableSawResult()
    {
        $nasabahs   = Nasabah::whereHas('result')->get();
        $data       = array();

        foreach($nasabahs as $idx => $item) {
            $data[] = [
                $idx + 1,
                $item->name_by_identity,
                floatval(number_format($item->result->age_saw_result, 2)),
                floatval(number_format($item->result->status_saw_result, 2)),
                floatval(number_format($item->result->plafond_saw_result, 2)),
                floatval(number_format($item->result->business_age_saw_result, 2)),
                floatval(number_format($item->fuzzy_result, 2)),
            ];
        }

        return [
            'data'  => $data
        ];
    }

    public function inputPembayaran(Request $request)
    {
        $trxNasabah = Riwayat::where('nasabah_id', $request->nasabah_id)->first();
        
        $substractPembayaran = (int)$trxNasabah->remaining_payment - (int)$request->nominal_bayar;

        $isUpdated  = Riwayat::where('nasabah_id', $trxNasabah->nasabah_id)->update([
            'remaining_payment' => $substractPembayaran < 0 || $substractPembayaran == 0 ? 0 : $substractPembayaran,
            'is_paid'           =>  $substractPembayaran < 0 || $substractPembayaran == 0 ? true : false
        ]);

        if($substractPembayaran < 0 && $trxNasabah->is_paid) {
            return response()->json([
                'success'   => false,
                'message'   => 'Nasabah dengan NIK '. $trxNasabah->nasabah->nik .' sudah melunasi pembayaran!'
            ]);
        }

        if($isUpdated) {
            return response()->json([
                'success'   => true,
                'message'   => 'Input Pembayaran Berhasil!'
            ]);
        }

        return response()->json([
            'success'   => false,
            'message'   => 'Input Pembayaran Gagal!'
        ]);
    }
}
