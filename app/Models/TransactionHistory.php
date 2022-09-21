<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;

    protected $table = 'transaction_history';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cashier(){
        return $this->belongsTo(Cashier::class);
    }
}
