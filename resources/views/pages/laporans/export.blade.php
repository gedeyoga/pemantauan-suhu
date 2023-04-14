<h2>LAPORAN RIWAYAT PERANGKAT</h2>
<h4 for="">Periode  : {{ date('Y-m' , strtotime($default_periode)) }}</h4>

<table border="1">
    <thead>
        <tr>
            <th rowspan="2" width="20" scope="col" style="vertical-align: middle;">Jadwal</th>
            @for($i = 0; $i < date('t' , strtotime($default_periode)); $i++) 
            <th colspan="3">{{ $i + 1 }}</th>
            @endfor
        </tr>
        <tr>
            @for($i = 0; $i< date('t' , strtotime($default_periode)); $i++) <th>Pagi</th>
                <th>Siang</th>
                <th>Sore</th>
                @endfor
        </tr>
    </thead>
    <tbody>
        @foreach($perangkats as $perangkat)
        <tr>
            <td>{{ $perangkat['perangkat']->name }}</td>
            @for($i = 0; $i < date('t' , strtotime($default_periode)); $i++) @if(isset($perangkat['history'][($i+1)])) @foreach( $perangkat['history'][$i+1] as $history) @if($history) 
                    @if( $history->suhu < $perangkat['perangkat']->temperature_min)
                    <td style="background-color: #4e73df; color: white;">{{ $history->suhu }}</td>
                    @elseif($history->suhu > $perangkat['perangkat']->temperature_max)
                    <td style="background-color: #e74a3b ; color: white;">{{ $history->suhu }}</td>
                    @else
                    <td style="background-color: #1cc88a; color: white;">{{ $history->suhu }}</td>
                    @endif
                    @else
                    <td>-</td>
                    @endif
                    @endforeach
                    @else
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    @endif
                    @endfor
        </tr>
        @endforeach

        @if(count($perangkats) == 0)
        <tr>
            <td colspan="{{ date('t' , strtotime($default_periode)) * 3 - 1 }}" style="text-align: center;">Tidak Ada Data</td>
        </tr>
        @endif
    </tbody>
</table>