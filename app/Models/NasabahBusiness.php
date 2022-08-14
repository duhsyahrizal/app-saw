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
        'average_price',
        'average_sale',
        'frequency_of_sales_days',
        'operating_revenue',
        'operating_margin',
        'turnover_income',
        'business_fund',
        'other_income',
        'non_business_expense',
        'total_installment'
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }
}
