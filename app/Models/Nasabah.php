<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Result;

class Nasabah extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_by_identity',
        'nik',
        'fuzzy_result'
    ];

    public function information()
    {
        return $this->hasOne(NasabahInformation::class);
    }

    public function businessInformation()
    {
        return $this->hasOne(NasabahBusiness::class);
    }

    public function riwayat()
    {
        return $this->hasOne(Riwayat::class);
    }

    public function result()
    {
        return $this->hasOne(Result::class);
    }

    // fungsi mengambil point bobot
    public function scopeGetPointBobot($query, $pointName = null, $value = null)
    {
        $data   = array();
        // inisiasi bobot plafond 40%
        $data['plafond']['bobot'] = 40/100;
        // inisiasi bobot usia 20%
        $data['usia']['bobot']  = 20/100;
        // inisiasi bobot status 20%
        $data['status']['bobot']  = 10/100;
        // inisiasi bobot lama usaha 20%
        $data['lama_usaha']['bobot']  = 30/100;

        // menentukan point untuk tiap bobot (usia, plafond, status & lama usaha)
        if($pointName == 'usia') {
            $data[$pointName]['point'] = 1;

            if($value > 30 && $value < 40) {
                $data[$pointName]['point'] = 2;
            } else if($value > 20 && $value < 30) {
                $data[$pointName]['point'] = 3;
            }
        } else if($pointName == 'plafond') {
            $data[$pointName]['point'] = 1;

            if($value > 2000000 && $value < 3000000) {
                $data[$pointName]['point'] = 2;
            } else if($value > 3000000) {
                $data[$pointName]['point'] = 3;
            }
        } else if($pointName == 'status') {
            $data[$pointName]['point'] = 1;

            if($value == 'bercerai') {
                $data[$pointName]['point'] = 2;
            } else if($value == 'belum menikah') {
                $data[$pointName]['point'] = 3;
            }
        } else if($pointName == 'lama_usaha') {
            $data[$pointName]['point'] = 1;

            if($value == 2) {
                $data[$pointName]['point'] = 2;
            } else if($value == 3) {
                $data[$pointName]['point'] = 3;
            }
        }

        return $data;
    }

    public function scopeCalculateSaw($query, $nasabah, $points)
    {
        // rumus normalisasi saw, disini point pembagi = 3 dikarenakan semua hasil dari maksimal point tiap kriteria = 3 poin
        $plafondSaw     = $points['plafond']['point'] / 3;
        $statusSaw      = $points['status']['point'] / 3;
        $lamaUsahaSaw   = $points['lama_usaha']['point'] / 3;

        // rumus normalisasi untuk point terendah => nilai normalisasi paling tinggi. Disini point paling rendah = 1, maka 1 : 1 = 1 dan point lebih dari 1 maka 1 : point usia
        $usiaSaw        = $points['usia']['point'] / 1;
        if($points['usia']['point'] > 1) $usiaSaw = 1 / $points['usia']['point'];

        $isExist        = Result::where('nasabah_id', $nasabah->id)->first();

        // perhitungan normalisasi dan perangkingan
        $result         = (($plafondSaw * $points['plafond']['bobot'])*100) + (($usiaSaw * $points['usia']['bobot'])*100) + (($statusSaw * $points['status']['bobot'])*100) + (($lamaUsahaSaw * $points['lama_usaha']['bobot'])*100);

        if(!$isExist) {
            Result::create([
                'nasabah_id'                => $nasabah->id,
                'age_result'                => ($usiaSaw * $points['usia']['bobot']) * 100,
                'status_result'             => ($statusSaw * $points['status']['bobot']) * 100 ,
                'plafond_result'            => ($plafondSaw * $points['plafond']['bobot']) * 100,
                'business_age_result'       => ($lamaUsahaSaw * $points['lama_usaha']['bobot']) * 100,
                'age_saw_result'            => $usiaSaw,
                'status_saw_result'         => $statusSaw,
                'plafond_saw_result'        => $plafondSaw,
                'business_age_saw_result'   => $lamaUsahaSaw,
            ]);
        } else {
            Result::where('nasabah_id', $nasabah->id)->update([
                'nasabah_id'                => $nasabah->id,
                'age_result'                => ($usiaSaw * $points['usia']['bobot']) * 100,
                'status_result'             => ($statusSaw * $points['status']['bobot']) * 100 ,
                'plafond_result'            => ($plafondSaw * $points['plafond']['bobot']) * 100,
                'business_age_result'       => ($lamaUsahaSaw * $points['lama_usaha']['bobot']) * 100,
                'age_saw_result'            => $usiaSaw,
                'status_saw_result'         => $statusSaw,
                'plafond_saw_result'        => $plafondSaw,
                'business_age_saw_result'   => $lamaUsahaSaw,
            ]);
        }

        return $result;
    }
}
