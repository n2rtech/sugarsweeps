<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GamingPlatform extends Model
{

    protected $table = 'gaming_platforms';

    protected $fillable = [
        'platform',
        'download_link',
    ];

    public function gamingAccount(){
        return $this->hasOne(GamingAccount::class, 'platform_id');
    }

    public function creditRequest(){
        return $this->hasOne(CreditRequest::class, 'platform_id');
    }

    public function redeemRequest(){
        return $this->hasOne(RedeemRequest::class, 'platform_id');
    }

    // public function transferRequest(){
    //     return $this->hasOne(TransferRequest::class, 'platform_id');
    // }

}
