<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GamingAccount extends Model
{
    protected $table = 'gaming_accounts';

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
