<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Nasabah;
use App\Models\Riwayat;
use App\Models\Result;
use App\Models\NasabahInformation;
use App\Models\NasabahBusiness;

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
        $request->session()->put([
            'information' => $request->except('_token')
        ]);
        
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

        // menyimpan bukti foto nasabah
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

    public function postDataUsaha(Request $request)
    {
        $file   = $request->file('business_photo');
        $file->move(public_path('/temp/business/photos/'), $file->getClientOriginalName());

        $request->session()->put([
            'business_information' => $request->except('_token', 'business_photo')
        ]);

        $request->session()->put([
            'business_photo'    => '/temp/business/photos/' . $file->getClientOriginalName()
        ]);

        return redirect('/konfirmasi/data');
    }

    public function konfirmasiData(Request $request)
    {
        $data['menu']   = 'Konfirmasi Data';
        $data['totalPendapatan']    = $this->getValueRupiah(session('business_information')['operating_revenue']);
        $data['modalUsaha']         = $this->getValueRupiah(session('business_information')['business_fund']);
        $data['pengeluaranUsaha']   = $this->getValueRupiah(session('business_information')['business_expense']);
        $data['pengeluaranLainnya'] = $this->getValueRupiah(session('business_information')['non_business_expense']);
        $data['pendapatanLainnya']  = $this->getValueRupiah(session('business_information')['other_income']);
        $data['totalAngsuran']      = $this->getValueRupiah(session('business_information')['total_installment']);

        // get point bobot 40%
        $plafondBobot   = Result::getPointBobot()['plafond']['bobot'];

        $plafondC       = $data['totalPendapatan'] - $data['modalUsaha'];
        $plafondE       = $plafondC - $data['pengeluaranUsaha'];
        $plafondSisa    = (($plafondE + $data['pendapatanLainnya']) - $data['pengeluaranLainnya']) - $data['totalAngsuran'];
        $calculate      = ($plafondSisa * $plafondBobot);
        $plafondI       = $calculate/108.34;

        $data['plafondC']       = $this->formatRupiah($plafondC);
        $data['plafondE']       = $this->formatRupiah($plafondE);
        $data['plafondSisa']    = $this->formatRupiah($plafondSisa);
        
        // pembulatan apabila kurang 0.5 akan jadi 0 dan lebih dari 0.5 akan jadi 1
        $roundingResult         = substr($plafondI, 1, 2);
        $firstDigit             = substr($plafondI, 0, 1);
        $resultPengajuan        = $roundingResult > 50 ? $firstDigit + 1 : $firstDigit - 1;
        $data['nilaiPengajuan'] = 'Rp. ' . $resultPengajuan . '.000.000';

        return view('web.konfirmasi', $data);
    }

    public function confirmation(Request $request)
    {
        $informations   = session()->get('information');
        $photos         = session()->get('photos');

        $businessExist  = NasabahBusiness::where('nasabah_id', $informations['nasabah_id'])->first();
        $infoExist      = NasabahInformation::where('nasabah_id', $informations['nasabah_id'])->first();

        // apabila nasabah sudah pinjam, maka tidak dapat meminjam lagi
        if($infoExist && $businessExist) {
            return redirect('/nasabah')->with([
                'success'   => false,
                'message'   => 'Data Informasi Nasabah sudah pernah pinjam!'
            ]);
        }

        $status = 0;

        if($informations['status'] == 'menikah') $status = 1;
        else if($informations['status'] == 'bercerai') $status = 2;

        if(!$infoExist) {
            // membuat nasabah informasi bersama dengan foto
            NasabahInformation::create([
                'nasabah_id'            => $informations['nasabah_id'],
                'birth_date'            => $informations['birth_date'],
                'birth_location'        => $informations['birth_location'],
                'address_by_identity'   => $informations['address'],
                'gender'                => $informations['gender'],
                'rt'                    => $informations['rt'],
                'rw'                    => $informations['rw'],
                'province'              => $informations['province'],
                'district'              => $informations['city'],
                'sub_district'          => $informations['district'],
                'ward'                  => $informations['ward'],
                'postal_code'           => $informations['postal_code'],
                'ktp_status'            => $informations['ktp_status'],
                'religion'              => $informations['religion'],
                'profession'            => $informations['profession'],
                'citizenship'           => $informations['citizenship'],
                'status'                => $status,
                'selfi_photo'           => $photos['path'][0],
                'ktp_photo'             => $photos['path'][1],
                'savings_photo'         => $photos['path'][2],
                'face_with_ktp_photo'   => $photos['path'][3],
            ]);
        } else {
            // update nasabah informasi apabila data sudah ada
            NasabahInformation::where('nasabah_id', $informations['nasabah_id'])
                ->update([
                    'birth_date'            => $informations['birth_date'],
                    'birth_location'        => $informations['birth_location'],
                    'gender'                => $informations['gender'],
                    'address_by_identity'   => $informations['address'],
                    'rt'                    => $informations['rt'],
                    'rw'                    => $informations['rw'],
                    'province'              => $informations['province'],
                    'district'              => $informations['city'],
                    'sub_district'          => $informations['district'],
                    'ward'                  => $informations['ward'],
                    'postal_code'           => $informations['postal_code'],
                    'ktp_status'            => $informations['ktp_status'],
                    'religion'              => $informations['religion'],
                    'profession'            => $informations['profession'],
                    'citizenship'           => $informations['citizenship'],
                    'status'                => $status,
                    'selfi_photo'           => $photos['path'][0],
                    'ktp_photo'             => $photos['path'][1],
                    'savings_photo'         => $photos['path'][2],
                    'face_with_ktp_photo'   => $photos['path'][3],
                ]);
        }


    }

    public function getValueRupiah($value)
    {
        $operating_revenue = explode('Rp. ', $value)[1];

        $result = str_replace(".", "", $operating_revenue);
        
        return (int)$result;
    }

    public function formatRupiah($value)
    {
        return 'Rp. ' . number_format($value,0,'','.');
    }

}
