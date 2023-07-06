<div class="card">
    <div class="card-body">
        <div class="row mb-3 align-items-end">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="exampleInputEmail1">Pilih Periode</label>
                    <input type="month" class="form-control" id="filter-periode-harian" value="{{ date('Y-m' , strtotime(request()->get('periode' , date('Y-m')))) }}">
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('laporans.export' , ['periode' => $default_periode]) }}" class="btn btn-success">
                    Download Excel
                </a>
            </div>
        </div>

        <div class="overflow-auto">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="120px" rowspan="2" width="70" scope="col" style="vertical-align: middle;">Tanggal</th>
                        @for($i = 0; $i < date('t' , strtotime($default_periode)); $i++) <th>{{ $i + 1 }}</th>
                            @endfor
                    </tr>
                    <tr>
                        <th width="120px" class="text-center" colspan="{{ date('t' , strtotime($default_periode)) }}">Rata - Rata Suhu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($perangkat_harian as $perangkat)
                    <tr>
                        <td>{{ $perangkat->name }}</td>
                        @for($i = 1; $i <= date('t' , strtotime($default_periode)); $i++) @php $suhu=null; foreach($perangkat->history as $history){
                            if(date('j' , strtotime($history->created_at) ) == $i) {
                            $suhu = $history;
                            }
                            }
                            @endphp

                            @if($suhu)
                            @if( $suhu->rata_suhu < $perangkat->temperature_min)
                                <td class="bg-primary text-white" style="cursor:pointer;" data-toggle="modal" data-target="#{{ 'modalDaily-' . $perangkat->id . '-' . $i   }}">
                                    {{ $suhu->rata_suhu }}

                                    <x-modal-suhu-daily :perangkat="$perangkat" :day="$i" :historyHours="$suhu->history_days->toArray()" :date="date('Y-m' , strtotime($default_periode)) . '-'.$i" />
                                </td>
                                @elseif($suhu->rata_suhu > $perangkat->temperature_max)
                                <td class="bg-danger text-white" style="cursor:pointer;" data-toggle="modal" data-target="#{{ 'modalDaily-' . $perangkat->id . '-' . $i   }}">
                                    {{ $suhu->rata_suhu }}

                                    <x-modal-suhu-daily :perangkat="$perangkat" :day="$i" :historyHours="$suhu->history_days->toArray()" :date="date('Y-m' , strtotime($default_periode)) . '-'.$i" />
                                </td>
                                @else
                                <td class="bg-success text-white" style="cursor:pointer;" data-toggle="modal" data-target="#{{ 'modalDaily-' . $perangkat->id . '-' . $i   }}">
                                    {{ $suhu->rata_suhu }}

                                    <x-modal-suhu-daily :perangkat="$perangkat" :day="$i" :historyHours="$suhu->history_days->toArray()" :date="date('Y-m' , strtotime($default_periode)) . '-'.$i" />
                                </td>
                                @endif
                                @else
                                <td>-</td>
                                @endif


                                @endfor
                    </tr>
                    @endforeach

                    @if(count($perangkats) == 0)
                    <tr>
                        <td colspan="{{ date('t' , strtotime($default_periode)) * 3 - 1 }}" class="text-center">Tidak Ada Data</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>