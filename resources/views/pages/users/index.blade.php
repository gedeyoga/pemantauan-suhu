@extends('layouts.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">User</h1>
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">User</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-5 align-items-center">
                    <div class="col-lg-6">
                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                    </div>
                    <div class="col-lg-3 offset-lg-3">
                        <form action="{{ route('users.index') }}" method="get">
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
                            <th scope="col">Email</th>
                            <th width="150" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $key => $user)
                        <tr>
                            <td>{{ ($users->currentpage()-1) * $users->perpage() + $key + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="d-flex">
                                <a href="{{ route('users.edit' , ['user' => $user->id]) }}" class="btn btn-sm btn-info mr-2">Edit</a>

                                @if(Auth::user()->id != $user->id)
                                <form action="{{ route('users.destroy' , ['user' => $user->id]) }}" method="post" id="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit" onclick="deleteUser(event , '#form-delete')">Hapus</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                        @if($users->count() == 0)
                        <tr>
                            <td colspan="3" class="text-center">Tidak Ada Data</td>
                        </tr>
                        @endif
                    </tbody>
                </table>

                <div class="d-flex align-items-center flex-column">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            @if($users->previousPageUrl())
                            <li class="page-item"><a class="page-link" href="{{ $users->previousPageUrl() }}">Previous</a></li>
                            @endif

                            @php
                            $start = $users->currentPage() - 2;
                            $start = $start < 1 ? 1 : $start; $end=$users->currentPage() + 2;
                                $end = $end > $users->lastPage() ? $users->lastPage() : $end;
                                @endphp

                                @for( $no = $start; $no <= $end; $no++) <li class="page-item  {{ $users->currentPage() == $no ? 'active' : '' }}">
                                    <a class="page-link" href="{{ route('users.index') . '?page=' . $no }}">{{ $no }}</a>
                                    </li>
                                    @endfor

                                    @if( $users->nextPageUrl())
                                    <li class="page-item"><a class="page-link" href="{{ $users->nextPageUrl() }}">Next</a></li>
                                    @endif
                        </ul>
                    </nav>
                    <small class="d-block text-center">Total data {{ $users->total() }} </small>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection