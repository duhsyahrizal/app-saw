<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function result()
    {
        return $this->hasOne(Result::class);
    }

    public function riwayat()
    {
        return $this->hasOne(Riwayat::class);
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
        $data['status']['bobot']  = 20/100;
        // inisiasi bobot lama usaha 20%
        $data['lama_usaha']['bobot']  = 20/100;

        // menentukan point untuk tiap bobot (usia, plafond, status & lama usaha)
        if($pointName == 'usia') {
            $data[$pointName]['point'] = 1;

            if($value > 30 && $value < 40) {
                $data[$pointName]['point'] = 2;
            } else if($value < 30 && $value > 20) {
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

    public function scopeCalculateSaw($query, $points)
    {
        // rumus normalisasi saw, disini point pembagi = 3 dikarenakan semua hasil dari maksimal point tiap kriteria = 3 poin
        $plafondSaw     = $points['plafond']['point'] / 3;
        $usiaSaw        = $points['usia']['point'] / 3;
        $statusSaw      = $points['status']['point'] / 3;
        $lamaUsahaSaw   = $points['lama_usaha']['point'] / 3;

        $result         = (($plafondSaw * $points['plafond']['bobot']) + ($usiaSaw * $points['usia']['bobot']) + ($statusSaw * $points['status']['bobot']) + ($lamaUsahaSaw * $points['lama_usaha']['bobot'])) * 100;

        return $result;
    }
}
