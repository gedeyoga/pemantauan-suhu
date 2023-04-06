@extends('layouts.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Barang</h1>
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Barang</a></li>
            <li class="breadcrumb-item" aria-current="page">Tambah</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-12">
        <form id="form-create-product" method="post" action="{{ route('products.store') }}">
            <div class="card">
                <div class="card-header">
                    <span class="">Tambah Barang</span>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="off" placeholder="Cth: Obat Batuk">
                            @error('name')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="unit" class="col-sm-2 col-form-label">Satuan</label>
                        <div class="col-sm-10">
                            <input type="text" name="unit" class="form-control @error('unit') is-invalid @enderror" value="{{ old('unit') }}" autocomplete="off" placeholder="Cth: pcs, pack, box">
                            @error('unit')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stock" class="col-sm-2 col-form-label">Stok</label>
                        <div class="col-sm-10">
                            <input type="text" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}" autocomplete="off" placeholder="Cth: 120">
                            @error('stock')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="expired_date" class="col-sm-2 col-form-label">Masa Berlaku</label>
                        <div class="col-md-3">
                            <input type="date" name="expired_date" class="form-control @error('expired_date') is-invalid @enderror" value="{{ old('expired_date') }}" autocomplete="off" placeholder="Cth: Stok">
                            @error('expired_date')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between mt-5">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
                        <button id="btn-tambah" type="submit" class="btn btn-primary">Tambah Barang</button>
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
        $('#btn-tambah').on('click', function(e) {
            e.preventDefault();

            confirmation('Apakah anda yakin?', function() {
                $('#form-create-product').submit();
            });
        })
    })
</script>
@endpush