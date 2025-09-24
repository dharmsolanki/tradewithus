<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestmentDetail extends Model
{

    // Fields that are mass assignable
    protected $fillable = [
        'user_id',
        'amount',
        'transaction_id',
        'type_of_payment', // corresponds to investment_type field in form
        'investment_date',
        'payment_proof',
    ];

    protected $casts = [
        'investment_date' => 'date', // automatically converted to Carbon
    ];
}
