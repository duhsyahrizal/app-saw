<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasabah_id',
        'borrow_date',
        'is_approved'
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }

    // fungsi mengambil point bobot
    public function scopeGetPointBobot($query, $pointName = null, $value = null)
    {
        $data   = array();
        $data['plafond']['bobot'] = 40/100;

        if($pointName == 'usia') {
            $data[$pointName]['point'] = 1;

            if($value > 35 && $value < 40) {
                $data[$pointName]['point'] = 2;
            } else if($value > 30 && $value < 35) {
                $data[$pointName]['point'] = 3;
            } else if($value < 30) {
                $data[$pointName]['point'] = 4;
            }
        } else if($pointName == 'status') {
            $data[$pointName]['point'] = 1;

            if($value == 'bercerai') {
                $data[$pointName]['point'] = 2;
            } else if($value == 'belum menikah') {
                $data[$pointName]['point'] = 3;
            }
        } else if($pointName == 'status') {
            $data[$pointName]['point'] = 1;

            if($value == 'bercerai') {
                $data[$pointName]['point'] = 2;
            } else if($value == 'belum menikah') {
                $data[$pointName]['point'] = 3;
            }
        } else if($pointName == 'lama usaha') {
            $data[$pointName]['point'] = 1;

            if($value == 2) {
                $data[$pointName]['point'] = 2;
            } else if($value == 3) {
                $data[$pointName]['point'] = 3;
            }
        }

        return $data;
    }
}
