<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_by_identity',
        'nik'
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
}
