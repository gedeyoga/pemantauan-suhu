@extends('layouts.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Perangkat</h1>
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Perangkat</a></li>
            <li class="breadcrumb-item" aria-current="page">{{ $perangkat->name }}</li>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-lg-12">





        <!-- Detail Perangkat -->
        <div class="card">
            <div class="card-header ">
                <span class="">Detail Perangkat</span>
                <a href="{{ route('perangkats.edit' , $perangkat->id) }}" class="btn btn-primary btn-sm float-right">
                    <i class="fa fa-edit"></i> Edit
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <th width="150">Kode Perangkat</th>
                                    <td width="25">:</td>
                                    <td>{{ $perangkat->kode_perangkat }}</td>
                                </tr>

                                <tr>
                                    <th>Nama</th>
                                    <td>:</td>
                                    <td>{{ $perangkat->name }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>:</td>
                                    <td>
                                        @if($perangkat->status == 'active')
                                        <span class="badge badge-success">{{ $perangkat->status }}</span>
                                        @else
                                        <span class="badge badge-danegr">{{ $perangkat->status }}</span>
                                        @endif
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <th width="150">Satuan</th>
                                    <td width="25">:</td>
                                    <td>{{ $perangkat->suhu }}</td>
                                </tr>

                                <tr>
                                    <th>Suhu Minimal</th>
                                    <td>:</td>
                                    <td>{{ $perangkat->temperature_min }}'{{ $perangkat->satuan_suhu }}</td>
                                </tr>
                                <tr>
                                    <th>Suhu Maksimal</th>
                                    <td>:</td>
                                    <td>{{ $perangkat->temperature_max }}'{{ $perangkat->satuan_suhu }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center">
                    <a href="{{ route('perangkats.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
        <!-- Detail Perangkat -->




        <!-- List Barang -->
        <div class="card mt-5">
            <div class="card-header ">
                <span class="">List Barang Pada Perangkat</span>
                <button href="{{ route('perangkats.edit' , $perangkat->id) }}" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#addBarang">
                    <i class="fa fa-plus"></i> Tambah
                </button>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="70" scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Masa Berlaku</th>
                            <th width="150" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($perangkatitems as $key => $perangkatitem)
                        <tr>
                            <td>{{ ($perangkatitems->currentpage()-1) * $perangkatitems->perpage() + $key + 1 }}</td>
                            <td>{{ $perangkatitem->product->name }}</td>
                            <td>{{ date('Y-m-d H:s' , strtotime( $perangkatitem->product->expired_date)) }}</td>
                            <td class="d-flex">
                                <form action="{{ route('perangkatitems.destroy' , ['perangkatitem'=> $perangkatitem->id] ) }}" method="post" id="form-delete" data-toggle="tooltip" data-placement="top" title="Hapus">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit" onclick="deleteUser(event , '#form-delete')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if($perangkatitems->count() == 0)
                        <tr>
                            <td colspan="4" class="text-center">Tidak Ada Data</td>
                        </tr>
                        @endif
                    </tbody>
                </table>

                <div class="d-flex align-items-center flex-column">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            @if($perangkatitems->previousPageUrl())
                            <li class="page-item"><a class="page-link" href="{{ $perangkatitems->previousPageUrl() }}">Previous</a></li>
                            @endif

                            @php
                            $start = $perangkatitems->currentPage() - 2;
                            $start = $start < 1 ? 1 : $start; $end=$perangkatitems->currentPage() + 2;
                                $end = $end > $perangkatitems->lastPage() ? $perangkatitems->lastPage() : $end;
                                @endphp

                                @for( $no = $start; $no <= $end; $no++) <li class="page-item  {{ $perangkatitems->currentPage() == $no ? 'active' : '' }}">
                                    <a class="page-link" href="{{ route('perangkats.show' , $perangkat->id) . '?page=' . $no }}">{{ $no }}</a>
                                    </li>
                                    @endfor

                                    @if( $perangkatitems->nextPageUrl())
                                    <li class="page-item"><a class="page-link" href="{{ $perangkatitems->nextPageUrl() }}">Next</a></li>
                                    @endif
                        </ul>
                    </nav>
                    <small class="d-block text-center">Total data {{ $perangkatitems->total() }} </small>
                </div>
            </div>
        </div>
        <!-- List Barang -->



        <!-- Modal Tambah Barang -->
        <div class="modal fade" id="addBarang" tabindex="-1" aria-labelledby="addBarangLabel" aria-hidden="true">
            <form action="{{ route('perangkatitems.store') }}" method="post">
                @csrf
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <input id="perangkat_id" type="hidden" name="perangkat_id" value="{{ $perangkat->id }}">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addBarangLabel">Pilih Barang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pb-3">
                            <div class="input-group mb-3">
                                <input id="search-product" type="text" name="search" class="form-control" placeholder="cari..">
                                <div class="input-group-append">
                                    <a href="#" onclick="searchProduct(event)" class="btn btn-secondary"><i class="fas fa-search"></i></a>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="70" scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Masa Berlaku</th>
                                    </tr>
                                </thead>
                                <tbody id="modal-list-products">

                                    @if($perangkatitems->count() == 0)
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak Ada Data</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
        </div>
        </form>
        <!-- Modal Tambah Barang -->
    </div>
</div>

@endsection

@push('javascript')
<script src="{{ asset('js/perangkats/perangkatItem.js') }}"></script>
<script src="{{ asset('js/perangkats/history-perangkat.js') }}"></script>
@endpush