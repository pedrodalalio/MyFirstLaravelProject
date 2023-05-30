<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
  use HasFactory;

  protected $fillable = [
    'id_product',
    'qt_stock',
    'min_stock',
    'max_stock',
  ];
}
