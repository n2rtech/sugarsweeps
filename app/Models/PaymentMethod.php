<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'payment_methods';

    protected $fillable = [
        'method',
        'status',
    ];

    public function creditRequest(){
        return $this->hasOne(CreditRequest::class, 'payment_method_id');
    }

    public function redeemRequest(){
        return $this->hasOne(RedeemRequest::class, 'payment_method_id');
    }
}
