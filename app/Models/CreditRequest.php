<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditRequest extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function platform(){
        return $this->belongsTo(GamingPlatform::class);
    }

    public function cashier(){
        return $this->belongsTo(Cashier::class);
    }
}
