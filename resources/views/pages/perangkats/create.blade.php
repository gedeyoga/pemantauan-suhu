@extends('layouts.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Perangkat</h1>
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Perangkat</a></li>
            <li class="breadcrumb-item" aria-current="page">Tambah</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-12">
        <form id="form-create-product" method="post" action="{{ route('perangkats.store') }}">
            <div class="card">
                <div class="card-header">
                    <span class="">Tambah Perangkat</span>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama Perangkat</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="off" placeholder="Cth: Suhu Alat Lemari 1">
                            @error('name')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="temperature_min" class="col-sm-2 col-form-label">Rentang Suhu Aman</label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="number" name="temperature_min" class="form-control @error('temperature_min') is-invalid @enderror" value="{{ old('temperature_min') }}" autocomplete="off" placeholder="Cth: 2.5">
                                <div class="input-group-append">
                                    <span class="input-group-text">Minimal</span>
                                </div>
                            </div>
                            @error('temperature_min')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="number" name="temperature_max" class="form-control @error('temperature_max') is-invalid @enderror" value="{{ old('temperature_max') }}" autocomplete="off" placeholder="Cth: 10.5">
                                <div class="input-group-append">
                                    <span class="input-group-text">Maksimal</span>
                                </div>
                            </div>

                            @error('temperature_max')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="suhu" class="col-sm-2 col-form-label">Nama Suhu</label>
                        <div class="col-sm-10">
                            <input type="text" name="suhu" class="form-control @error('suhu') is-invalid @enderror" value="{{ old('suhu') }}" autocomplete="off" placeholder="Cth: Celcius, Farenheit">
                            @error('suhu')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="satuan_suhu" class="col-sm-2 col-form-label">Satuan Suhu</label>
                        <div class="col-sm-10">
                            <input type="text" name="satuan_suhu" class="form-control @error('satuan_suhu') is-invalid @enderror" value="{{ old('satuan_suhu') }}" autocomplete="off" placeholder="Cth: C,F">
                            @error('satuan_suhu')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label ">Status</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="status" class="custom-control-input ml-3" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1">Aktif</label>
                        </div>

                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between mt-5">
                        <a href="{{ route('perangkats.index') }}" class="btn btn-secondary">Kembali</a>
                        <button id="btn-tambah" type="submit" class="btn btn-primary">Tambah Perangkat</button>
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