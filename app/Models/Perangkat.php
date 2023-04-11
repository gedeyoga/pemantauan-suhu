<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Perangkat extends Model
{
    use HasFactory , AutoNumberTrait;

    protected $fillable = ['kode_perangkat', 'name' , 'temperature_min', 'temperature_max' , 'status' , 'suhu' , 'satuan_suhu'];

    /**
     * Return the autonumber configuration array for this model.
     *
     * @return array
     */
    public function getAutoNumberOptions()
    {
        return [
            'kode_perangkat' => [
                'format' => function () {
                    return 'P?';
                },
                'length' => 5
            ]
        ];
    }

    public function perangkat_items()
    {
        return $this->hasMany(PerangkatItem::class , 'perangkat_id');
    }

    public function history_perangkat()
    {
        return $this->hasMany(HistoryPerangkat::class , 'perangkat_id');
    }

    public function latest_perangkat_history()
    {
        return $this->history_perangkat()->orderBy('created_at','desc');
    }
}
