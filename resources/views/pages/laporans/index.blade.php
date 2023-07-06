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

        <ul class="nav nav-pills" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button style="border:none;" class="nav-link active" id="bulanan-tab" data-toggle="tab" data-target="#bulanan" type="button" role="tab" aria-controls="bulanan" aria-selected="true">Bulanan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button style="border:none;" class="nav-link" id="harian-tab" data-toggle="tab" data-target="#harian" type="button" role="tab" aria-controls="harian" aria-selected="false">Harian</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="bulanan" role="tabpanel" aria-labelledby="bulanan-tab">
                @include('pages.laporans.partials.laporan-bulanan')
            </div>
            <div class="tab-pane fade" id="harian" role="tabpanel" aria-labelledby="harian-tab">
                @include('pages.laporans.partials.laporan-harian')
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
        </div>

    </div>
</div>

@endsection

@push('javascript')

<script>
    $(document).ready(function() {

        $('#filter-periode-bulanan').on('change', function(val) {

            window.location.href = window.base_url + '/laporans?periode=' + $(this).val();

        })
        $('#filter-periode-harian').on('change', function(val) {

            window.location.href = window.base_url + '/laporans?periode=' + $(this).val();

        })

    })
</script>
@endpush