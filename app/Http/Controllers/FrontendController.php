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
        $data['nasabahs']       = Nasabah::whereHas('riwayat')->orderBy('created_at', 'DESC')->get();
        
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

    public function inputDataAnggota(Request $request)
    {
        $data['menu']       = 'Input Data Nasabah';
        $data['nasabah']    = Nasabah::find($request->nasabah_id);

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

        if(strlen((int)$request->nik) != strlen($request->nik)) {
            return redirect()->back()
                ->withErrors('Maaf, NIK anda tidak boleh mengandung huruf!');
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

    public function deleteNasabah($id)
    {
        $isDeleted  = Nasabah::where('id', $id)->delete();

        return redirect()->back()->withSuccess('Success delete data nasabah!');
    }

    public function inputDataInformasi(Request $request)
    {
        $data['menu']       = 'Input Persyaratan Nasabah - Data Calon Anggota';
        $data['nasabah']    = Nasabah::where('status', 0)->orWhere('status', 2)->get();

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

        $totalPendapatan    = $this->getValueRupiah(session('business_information')['operating_revenue']);
        $modalUsaha         = $this->getValueRupiah(session('business_information')['business_fund']);
        $pengeluaranUsaha   = $this->getValueRupiah(session('business_information')['business_expense']);
        $pengeluaranLainnya = $this->getValueRupiah(session('business_information')['non_business_expense']);
        $pendapatanLainnya  = $this->getValueRupiah(session('business_information')['other_income']);
        $totalAngsuran      = $this->getValueRupiah(session('business_information')['total_installment']);

        
        // get point bobot 40%
        $plafondBobot   = Result::getPointBobot()['plafond']['bobot'];

        $plafondC       = $totalPendapatan - $modalUsaha;
        $plafondE       = $plafondC - $pengeluaranUsaha;
        $plafondSisa    = (($plafondE + $pendapatanLainnya) - $pengeluaranLainnya) - $totalAngsuran;
        $plafondI       = (int)($plafondSisa/2.5);

        $request->session()->put([
            'remaining_treasure' => $plafondSisa,
        ]);

        $informations   = session()->get('information');
        $businesses     = session()->get('business_information');
        $businessExist  = NasabahBusiness::where('nasabah_id', $informations['nasabah_id'])->first();

        if(!$businessExist) {
            // membuat nasabah informasi bersama dengan foto
            NasabahBusiness::create([
                'nasabah_id'                    => $informations['nasabah_id'],
                'business_name'                 => $businesses['business_name'],
                'business_address'              => $businesses['business_address'],
                'operating_revenue'             => $totalPendapatan,
                'business_fund'                 => $modalUsaha,
                'net_income'                    => $plafondE,
                'other_income'                  => $pendapatanLainnya,
                'business_expense'              => $pengeluaranUsaha,
                'non_business_expense'          => $pengeluaranLainnya,
                'total_installment'             => $totalAngsuran,
                'recommendation_loan'           => $plafondI*4,
                'recommendation_installment'    => $plafondI,
                'business_photo'                => session()->get('business_photo'),
            ]);
        } else {
            // update nasabah informasi apabila data sudah ada
            NasabahBusiness::where('nasabah_id', $informations['nasabah_id'])
                ->update([
                    'business_name'                 => $businesses['business_name'],
                'business_address'              => $businesses['business_address'],
                'operating_revenue'             => $totalPendapatan,
                'business_fund'                 => $modalUsaha,
                'net_income'                    => $plafondE,
                'other_income'                  => $pendapatanLainnya,
                'business_expense'              => $pengeluaranUsaha,
                'non_business_expense'          => $pengeluaranLainnya,
                'total_installment'             => $totalAngsuran,
                'recommendation_loan'           => $plafondI*4,
                'recommendation_installment'    => $plafondI,
                'business_photo'                => session()->get('business_photo'),
                ]);
        }

        return redirect('/konfirmasi/data');
    }

    public function konfirmasiData(Request $request)
    {
        $data['menu']       = 'Konfirmasi Data';
        $data['plafond']    = NasabahBusiness::where('nasabah_id', session('information')['nasabah_id'])->first();

        // get point bobot 40%
        $plafondBobot   = Result::getPointBobot()['plafond']['bobot'];

        $plafondSisa            = (($data['plafond']['net_income'] + $data['plafond']['other_income']) - $data['plafond']['non_business_expense']) - $data['plafond']['total_installment'];
        $data['nilaiAngsuran']  = $this->formatRupiah($data['plafond']['recommendation_installment']);
        $data['nilaiPengajuan'] = $this->formatRupiah($data['plafond']['recommendation_loan']);
        $data['plafondSisa']    = $this->formatRupiah($plafondSisa);

        return view('web.konfirmasi', $data);
    }

    public function confirmation(Request $request)
    {
        $data           = array();
        $informations   = session()->get('information');
        $photos         = session()->get('photos');

        $nasabah        = Nasabah::find($informations['nasabah_id']);
        $businessExist  = NasabahBusiness::where('nasabah_id', $informations['nasabah_id'])->first();
        $infoExist      = NasabahInformation::where('nasabah_id', $informations['nasabah_id'])->first();
        $historyExist   = Riwayat::where('nasabah_id', $informations['nasabah_id'])->first();

        // apabila nasabah sudah pinjam, maka tidak dapat meminjam lagi
        if($infoExist && $businessExist && $historyExist) {
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
                'nasabah_id'            => $nasabah->id,
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
            NasabahInformation::where('nasabah_id', $nasabah->id)
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
        
        $usia           = (int)(\Carbon\Carbon::now()->format('Y')) - (int)(\Carbon\Carbon::parse(session('information')['birth_date'])->format('Y'));

        $bobotPlafond   = Result::getPointBobot('plafond', session('remaining_treasure'));
        $bobotUsia      = Result::getPointBobot('usia', $usia);
        $bobotStatus    = Result::getPointBobot('status', session('information')['status']);
        $bobotLamaUsaha = Result::getPointBobot('lama_usaha', session('business_information')['business_age']);

        $data   = [
            'plafond'       => [
                'bobot' => $bobotPlafond['plafond']['bobot'],
                'point' => $bobotPlafond['plafond']['point'],
            ],
            'usia'          => [
                'bobot' => $bobotUsia['usia']['bobot'],
                'point' => $bobotUsia['usia']['point'],
            ],
            'status'        => [
                'bobot' => $bobotStatus['status']['bobot'],
                'point' => $bobotStatus['status']['point'],
            ],
            'lama_usaha'    => [
                'bobot' => $bobotLamaUsaha['lama_usaha']['bobot'],
                'point' => $bobotLamaUsaha['lama_usaha']['point'],
            ],
        ];

        $result = Result::calculateSaw($data);

        if($result < 80) {
            Result::create([
                'nasabah_id'    => $nasabah->id,
                'borrow_date'   => \Carbon\Carbon::now()->format('Y-m-d'),
                'is_approved'   => false,
                'fuzzy_result'  => $result
            ]);

            return redirect('/nasabah')->with([
                'success'   => false,
                'message'   => 'Maaf, hasil perhitungan nasabah kurang dari kriteria kami. Nasabah bersangkutan tidak bisa melakukan pinjaman'
            ]);
        }

        // update status nasabah ketika sudah approve
        Nasabah::where('id', $nasabah->id)->update([
            'status' => true
        ]);

        // buat hasil fuzzy untuk nasabah yang baru dibuat
        Result::create([
            'nasabah_id'    => $nasabah->id,
            'borrow_date'   => \Carbon\Carbon::now()->format('Y-m-d'),
            'is_approved'   => true,
            'fuzzy_result'  => $result
        ]);

        // buat data riwayat nasabah untuk yang baru dibuat
        Riwayat::create([
            'nasabah_id'        => $nasabah->id,
            'borrow_date'       => \Carbon\Carbon::now()->format('Y-m-d'),
            'is_paid'           => false,
            'remaining_payment' => $businessExist->recommendation_loan,
            'loan_nominal'      => $businessExist->recommendation_loan
        ]);

        return redirect('/nasabah')->with([
            'success'   => true,
            'message'   => 'Selamat! Nasabah sudah dapat melakukan pinjaman di Amaan Indonesia System'
        ]);
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
