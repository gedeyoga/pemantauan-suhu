<?php

namespace App\Http\Controllers;

use App\Exports\HistoryPerangkatExport;
use App\Models\HistoryPerangkat;
use App\Models\Perangkat;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $default_periode = date('Y-m');
        $periode = [
            date('Y-m-01 00:00:00'),
            date('Y-m-t 23:59:59')
        ];

        if($request->get('periode')) {
            $periode = [
                date('Y-m-01 00:00:00', strtotime($request->get('periode'))),
                date('Y-m-t 23:59:59', strtotime($request->get('periode'))),
            ];
            $default_periode = date('Y-m' , strtotime($request->get('periode')));
        }

        $perangkats = $this->getHistoryPerangkat($periode);

        return view('pages.laporans.index' , compact( 'perangkats' , 'default_periode'));
    }
    public function exportExcel(Request $request)
    {
        $periode = [
            date('Y-m-01 00:00:00'),
            date('Y-m-t 23:59:59')
        ];

        if ($request->get('periode')) {
            $periode = [
                date('Y-m-01 00:00:00', strtotime($request->get('periode'))),
                date('Y-m-t 23:59:59', strtotime($request->get('periode'))),
            ];
        }

        $perangkats = $this->getHistoryPerangkat($periode);
        return Excel::download(new HistoryPerangkatExport($perangkats , $periode[0]), 'history-perangkat-'.date('Y-M' , strtotime($request->periode)).'.xlsx');
    }

    protected function getHistoryPerangkat($periode)
    {
        $history = HistoryPerangkat::whereBetween('created_at', $periode)->get();
        $perangkats = $history->groupBy('perangkat_id');

        $perangkats = $perangkats->map(function ($history, $key) use ($periode) {
            $group_by_day = $history->groupBy(function ($val) use ($periode) {
                return Carbon::parse($val->created_at)->format('Y-m-d');
            });

            $group_by_hour = $group_by_day->map(function ($riwayat, $day) use ($periode) {

                $hours = [
                    '08:00',
                    '12:00',
                    '17:00'
                ];

                $list = collect();
                foreach ($hours as $hour) {
                    $list->push(
                        $riwayat->filter(function ($item) use ($periode, $day, $hour) {
                            $day = explode('-', $day);
                            return strtotime(date('Y-m-d H:i', strtotime($item->created_at))) <= strtotime(date('Y-m-' . $day[2] . ' ' . $hour, strtotime($periode[0])));
                        })->last()
                    );
                }

                return $list;
            });

            $datas = [];
            foreach ($group_by_hour as $day => $item) {
                $datas[(int) date('j', strtotime($day))] = $item;
            }
            return [
                'perangkat' => $history->first()->perangkat,
                'history' => $datas,
            ];
        });
        
        return $perangkats;
        
    }
}
