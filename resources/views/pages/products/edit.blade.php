@extends('layouts.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Barang</h1>
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Barang</a></li>
            <li class="breadcrumb-item" aria-current="page">Edit</li>
            <li class="breadcrumb-item" aria-current="page">{{ $product->id }}</li>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-lg-12">
        <form method="post" action="{{ route('products.update' , ['product' => $product->id]) }}" id="form-edit-product">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-header">
                    <span class="">Edit Barang</span>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" autocomplete="off" placeholder="Cth: Obat Batuk" value="{{ $product->name }}">
                            @error('name')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="unit" class="col-sm-2 col-form-label">Satuan</label>
                        <div class="col-sm-10">
                            <input type="text" name="unit" class="form-control @error('unit') is-invalid @enderror" autocomplete="off" placeholder="Cth: pcs, pack, box" value="{{ $product->unit }}">
                            @error('unit')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stock" class="col-sm-2 col-form-label">Stok</label>
                        <div class="col-sm-10">
                            <input type="text" name="stock" class="form-control @error('stock') is-invalid @enderror" autocomplete="off" placeholder="Cth: 120" value="{{ $product->stock }}">
                            @error('stock')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="expired_date" class="col-sm-2 col-form-label">Masa Berlaku</label>
                        <div class="col-md-3">
                            <input type="date" name="expired_date" class="form-control @error('expired_date') is-invalid @enderror" autocomplete="off" placeholder="Cth: Stok" value="{{ datE('Y-m-d' , strtotime($product->expired_date)) }}">
                            @error('expired_date')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between mt-5">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
                        <button id="btn-edit" type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('javascript')
<script>
    $(document).ready(function() {
        $('#btn-edit').on('click', function(e) {
            e.preventDefault();

            confirmation('Apakah anda yakin?', function() {
                $('#form-edit-product').submit();
            });
        })
    })
</script>
@endpush