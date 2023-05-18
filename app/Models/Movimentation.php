<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentation extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'origin',
        'qt_product',
        'dt_movimentation',
    ];
}
