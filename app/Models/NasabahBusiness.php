<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NasabahBusiness extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nasabah_id',
        'business_name',
        'business_address',
        'operating_revenue',
        'net_income',
        'business_fund',
        'other_income',
        'business_expense',
        'non_business_expense',
        'total_installment',
        'recommendation_loan',
        'recommendation_installment',
        'business_photo'
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }
}
