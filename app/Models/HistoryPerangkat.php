<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryPerangkat extends Model
{
    use HasFactory;

    protected $fillable = ['perangkat_id' , 'suhu'];
    
    public function perangkat()
    {
        return $this->belongsTo(Perangkat::class , 'perangkat_id');
    }
}
