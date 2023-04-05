<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductExpired extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'stock' , 'expired_date'];
}
