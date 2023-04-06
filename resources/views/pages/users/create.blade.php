@extends('layouts.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">User</h1>
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item" aria-current="page">Tambah</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-12">
        <form id="form-create-user" method="post" action="{{ route('users.store') }}">
            <div class="card">
                <div class="card-header">
                    <span class="">Tambah User</span>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="off" placeholder="Cth: Eric Saputra">
                            @error('name')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="off" placeholder="cth: eric@gmail.com">
                            @error('email')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" value="" placeholder="Masukkan Password..">
                            @error('password')
                            <small class="form-text text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between mt-5">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
                        <button id="btn-tambah" type="submit" class="btn btn-primary">Tambah User</button>
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
                $('#form-create-user').submit();
            });
        })
    })
</script>
@endpush