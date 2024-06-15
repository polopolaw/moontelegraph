<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneConfirmation extends Model
{
    protected $fillable = [
        'phone',
        'code',
    ];
}
