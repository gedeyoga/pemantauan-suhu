<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateHistoryPerangkatRequest;
use App\Http\Resources\HistoryPerangkatResource;
use App\Http\Services\HistoryPerangkatService;
use App\Models\Perangkat;
use Illuminate\Http\Request;

class HistoryPerangkatController extends Controller
{
    protected $history_service;

    public function __construct()
    {
        $this->history_service = new HistoryPerangkatService;
    }

    public function store(CreateHistoryPerangkatRequest $request)
    {
        $data = $request->except(['kode_perangkat']);

        $perangkat = Perangkat::where('kode_perangkat' , $request->get('kode_perangkat'))->first();

        if(is_null($perangkat)) return response()->json([
            'message' => 'Kode perangkat tidak ditemukan!'
        ] , 404);

        $data['perangkat_id'] = $perangkat->id;

        $hisotry = $this->history_service->create($data);

        return response()->json([
            'message' => 'Suhu berhasil disimpan',
            'data' => new HistoryPerangkatResource($hisotry->load('perangkat')),
        ]);
    }
}
