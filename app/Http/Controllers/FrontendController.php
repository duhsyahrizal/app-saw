<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Nasabah;
use App\Models\Riwayat;
use App\Models\Result;

class FrontendController extends Controller
{
    public function index()
    {
        $data['menu']   = 'Dashboard';
        $data['totalNasabah']   = Nasabah::count();
        $data['totalTransaksi'] = Riwayat::count();
        $data['totalPengajuan'] = Result::where('is_approved', true)->count();
        $data['totalBayar']     = Riwayat::where('is_paid', true)->count();
        $data['riwayats']       = Riwayat::get();
        
        return view('web.dashboard', $data);
    }

    public function nasabah()
    {
        $data['menu']   = 'Nasabah';

        return view('web.nasabah', $data);
    }

    public function riwayat()
    {
        $data['menu']   = 'Riwayat';

        return view('web.riwayat', $data);
    }

    public function inputDataAnggota()
    {
        $data['menu']   = 'Input Data Nasabah';

        return view('web.input-data.anggota', $data);
    }

    public function postDataNasabah(Request $request)
    {
        $rules      = [
            'name'  => 'required|max:100|min:10',
            'nik'   => 'required|max:16'
        ];

        // Validasi nama & nik
        $isValidate = $request->validate($rules);

        $isExist    = Nasabah::where([
            'name_by_identity'  => $request->name,
            'nik'               => $request->nik
        ])->first();

        // check nama & nik apakah sudah ada, apabila sudah ada maka dikembalikan ke menu input
        if($isExist) {
            return redirect()->back()
                ->withErrors('Nasabah dengan NIK '. $isExist->nik .' sudah ada!');
        }

        $isCreated  = Nasabah::create([
            'name_by_identity'  => $request->name,
            'nik'               => $request->nik
        ]);

        // apabila nasabah tidak berhasil dibuat, maka dikembalikan juga ke menu input
        if(!$isCreated) {
            return redirect()->back()
                ->withErrors('Failed when created nasabah!');
        }

        // nasabah berhasil dibuat
        return redirect('/nasabah')
            ->withSuccess('Success created data nasabah!');
    }

    public function inputDataInformasi(Request $request)
    {
        $data['menu']       = 'Input Persyaratan Nasabah - Data Calon Anggota';
        $data['nasabah']    = Nasabah::get();

        return view('web.input-data.informasi', $data);
    }

    public function postDataInformasi(Request $request)
    {
        $request->session()->put(['information' => $request->all()]);
        
        return redirect('/input/data/foto');
    }

    public function inputDataFoto()
    {
        $data['menu']   = 'Input Persyaratan Nasabah - Ambil Foto';

        return view('web.input-data.foto', $data);
    }

    public function postDataFoto(Request $request)
    {
        $photos = array();

        foreach($request->file() as $file) {
            $file->move(public_path('/temp/photos/'), $file->getClientOriginalName());
            $photos['path'][] = '/temp/photos/' . $file->getClientOriginalName();
        }
        
        $request->session()->put([
            'photos'    => $photos
        ]);

        return redirect('/input/data/usaha');
    }

    public function inputDataUsaha(Request $request)
    {
        $data['menu']   = 'Input Persyaratan - Isi Informasi Tambahan & Data Usaha';

        return view('web.input-data.usaha', $data);
    }

    public function konfirmasiData(Request $request)
    {
        $data['menu']   = 'Konfirmasi Data';

        return view('web.input-data.konfirmasi', $data);
    }

    public function confirmation(Request $request)
    {
        dd($request->all());
    }

}
