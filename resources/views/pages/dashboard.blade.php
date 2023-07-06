@extends('layouts.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light">
            <li class="breadcrumb-item" aria-current="page">Dashboard</li>
        </ol>
    </nav>
</div>

<div class="row">
    @foreach($perangkats as $perangkat)

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <label>{{ $perangkat->name }} :</label>
                    @php 
                        $history = $perangkat->latest_perangkat_history->first();
                        $suhu = !is_null($history) ? $history->suhu : 0;
                    @endphp
                    @if( $suhu < $perangkat->temperature_min)
                        <h2 id="suhu-perangkat-{{$perangkat->id}}" class="text-primary">{{ $suhu }}'{{ $perangkat->satuan_suhu }}</h2>
                    @elseif($suhu > $perangkat->temperature_min)
                        <h2 id="suhu-perangkat-{{$perangkat->id}}" class="text-success">{{ $suhu }}'{{ $perangkat->satuan_suhu }}</h2>
                    @else
                        <h2 id="suhu-perangkat-{{$perangkat->id}}" class="text-danger">{{ $suhu }}'{{ $perangkat->satuan_suhu }}</h2>
                    @endif
                   
                </div>

                <div style="overflow-y: scroll; min-height: 400px;">
                    <table class="table table-bordered w-100">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <!-- <th>Stok</th>
                                <th>Kadaluwarsa</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($perangkat->perangkat_items as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <!-- <td>{{ $item->product->stock }}</td>
                                <td> {{ date('Y-m-d' , strtotime($item->product->expired_date)) }}</td> -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @endforeach
</div>

@endsection

@push('javascript')

<script src="{{ asset('js/dashboard/dashboard.js') }}"></script>

@endpush