<?php

namespace App\Exports;

use App\Models\HistoryPerangkat;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class HistoryPerangkatExport implements  FromView 
{
    protected $data;
    protected $periode;

    public function __construct(Collection $data , $periode)
    {
        $this->data = $data;
        $this->periode = $periode;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'Borders' => ['allBorders']
            ]
        ];
    }

    public function view(): View
    {
        return view('pages.laporans.export', [
            'perangkats' => $this->data,
            'default_periode' => $this->periode,
        ]);
    }
}
