<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GamingPackage extends Model
{
    use HasFactory;

    protected $fillable = [
		'package',
		'gemini',
        'orionstars',
        'riversweeps',
        'vpower',
        'ultramonster',
        'firekirin',
        'bluedragons',
        'pandamaster',
        'password',
        'user_id',
        'status'
	];

    protected $hidden = ['id', 'user_id', 'created_at', 'updated_at', 'status'];

    public $timestamps = true;
}
