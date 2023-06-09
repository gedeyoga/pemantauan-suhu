<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerangkatItem extends Model
{
    use HasFactory;

    protected $fillable = ['product_id' , 'perangkat_id'];

    public function product() 
    {
        return $this->belongsTo(Product::class , 'product_id');
    }

}
