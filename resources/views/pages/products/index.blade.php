@extends('layouts.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Barang</h1>
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Barang</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-5 align-items-center">
                    <div class="col-lg-6">
                        <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                    </div>
                    <div class="col-lg-3 offset-lg-3">
                        <form action="{{ route('products.index') }}" method="get">
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
                            <th scope="col">Nama</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Masa Berlaku</th>
                            <th width="150" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key => $product)
                        <tr>
                            <td>{{ ($products->currentpage()-1) * $products->perpage() + $key + 1 }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->unit }}</td>
                            <td>{{ date('Y-m-d H:s' , strtotime( $product->expired_date)) }}</td>
                            <td class="d-flex">
                                <a href="{{ route('products.edit' , ['product' => $product->id]) }}" class="btn btn-sm btn-info mr-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('products.destroy' , ['product' => $product->id]) }}" method="post" id="form-delete" data-toggle="tooltip" data-placement="top" title="Hapus">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit" onclick="deleteUser(event , '#form-delete')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if($products->count() == 0)
                        <tr>
                            <td colspan="3" class="text-center">Tidak Ada Data</td>
                        </tr>
                        @endif
                    </tbody>
                </table>

                <div class="d-flex align-items-center flex-column">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            @if($products->previousPageUrl())
                            <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}">Previous</a></li>
                            @endif

                            @php
                            $start = $products->currentPage() - 2;
                            $start = $start < 1 ? 1 : $start; $end=$products->currentPage() + 2;
                                $end = $end > $products->lastPage() ? $products->lastPage() : $end;
                                @endphp

                                @for( $no = $start; $no <= $end; $no++) <li class="page-item  {{ $products->currentPage() == $no ? 'active' : '' }}">
                                    <a class="page-link" href="{{ route('products.index') . '?page=' . $no }}">{{ $no }}</a>
                                    </li>
                                    @endfor

                                    @if( $products->nextPageUrl())
                                    <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}">Next</a></li>
                                    @endif
                        </ul>
                    </nav>
                    <small class="d-block text-center">Total data {{ $products->total() }} </small>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection