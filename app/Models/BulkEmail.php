<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulkEmail extends Model
{
    use HasFactory;
    protected $casts = [
        'value' => 'array',
    ];
}
