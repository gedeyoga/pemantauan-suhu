@extends('layouts.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Perangkat</h1>
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Perangkat</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-5 align-items-center">
                    <div class="col-lg-6">
                        <a href="{{ route('perangkats.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                    </div>
                    <div class="col-lg-3 offset-lg-3">
                        <form action="{{ route('perangkats.index') }}" method="get">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="cari..">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="70" scope="col">#</th>
                            <th width="25" scope="col"></th>
                            <th scope="col">Nama</th>
                            <th scope="col">Minimal Suhu</th>
                            <th scope="col">Maksimal Suhu</th>
                            <th width="150" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($perangkats as $key => $perangkat)
                        <tr>
                            <td>{{ ($perangkats->currentpage()-1) * $perangkats->perpage() + $key + 1 }}</td>
                            <td>
                                <div style="width: 15px; height: 15px; border-radius: 100px;" class="d-inline-block mr-2 {{ $perangkat->status == 'active' ? 'bg-success' : 'bg-danger' }}"></div>
                            </td>
                            <td>
                                <span>{{ $perangkat->name }}</span> <br>
                                <span><small>{{ $perangkat->kode_perangkat }}</small></span>
                            </td>
                            <td>{{ $perangkat->temperature_min }}'{{ $perangkat->satuan_suhu }}</td>
                            <td>{{ $perangkat->temperature_max }}'{{ $perangkat->satuan_suhu }}</td>
                            <td class="d-flex">
                                <a href="{{ route('perangkats.show' , ['perangkat' => $perangkat->id]) }}" class="btn btn-sm btn-primary mr-2" data-toggle="tooltip" data-placement="top" title="Detail">
                                    <i class="fa fa-podcast"></i>
                                </a>
                                <a href="{{ route('perangkats.edit' , ['perangkat' => $perangkat->id]) }}" class="btn btn-sm btn-info mr-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('perangkats.destroy' , ['perangkat' => $perangkat->id]) }}" method="post" id="form-delete" data-toggle="tooltip" data-placement="top" title="Hapus">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit" onclick="deleteUser(event , '#form-delete')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if($perangkats->count() == 0)
                        <tr>
                            <td colspan="5" class="text-center">Tidak Ada Data</td>
                        </tr>
                        @endif
                    </tbody>
                </table>

                <div class="d-flex align-items-center flex-column">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            @if($perangkats->previousPageUrl())
                            <li class="page-item"><a class="page-link" href="{{ $perangkats->previousPageUrl() }}">Previous</a></li>
                            @endif

                            @php
                            $start = $perangkats->currentPage() - 2;
                            $start = $start < 1 ? 1 : $start; $end=$perangkats->currentPage() + 2;
                                $end = $end > $perangkats->lastPage() ? $perangkats->lastPage() : $end;
                                @endphp

                                @for( $no = $start; $no <= $end; $no++) <li class="page-item  {{ $perangkats->currentPage() == $no ? 'active' : '' }}">
                                    <a class="page-link" href="{{ route('perangkats.index') . '?page=' . $no }}">{{ $no }}</a>
                                    </li>
                                    @endfor

                                    @if( $perangkats->nextPageUrl())
                                    <li class="page-item"><a class="page-link" href="{{ $perangkats->nextPageUrl() }}">Next</a></li>
                                    @endif
                        </ul>
                    </nav>
                    <small class="d-block text-center">Total data {{ $perangkats->total() }} </small>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection