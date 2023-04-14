@extends('layouts.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Laporan</h1>
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Laporan</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3 align-items-end">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Pilih Periode</label>
                            <input type="month" class="form-control" id="filter-periode" value="{{ date('Y-m' , strtotime(request()->get('periode' , date('Y-m')))) }}">
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
                                <th width="120px" rowspan="2" width="70" scope="col" style="vertical-align: middle;">Jadwal</th>
                                @for($i = 0; $i < date('t' , strtotime($default_periode)); $i++) <th colspan="3">{{ $i + 1 }}</th>
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
                                        <td class="bg-primary text-white">{{ $history->suhu }}</td>
                                        @elseif($history->suhu > $perangkat['perangkat']->temperature_max)
                                        <td class="bg-danger text-white">{{ $history->suhu }}</td>
                                        @else
                                        <td class="bg-success text-white">{{ $history->suhu }}</td>
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
                                <td colspan="{{ date('t' , strtotime($default_periode)) * 3 - 1 }}" class="text-center">Tidak Ada Data</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('javascript')

<script>
    $(document).ready(function() {

        $('#filter-periode').on('change', function(val) {

            window.location.href = window.base_url + '/laporans?periode=' + $(this).val();

        })

    })
</script>
@endpush