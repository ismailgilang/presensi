@extends('layouts.user')
@section('title', 'Data Absen')
@section('css')
<style>
    thead>tr>th {
        color: black;
    }

    .row {
        margin-top: 40px;
        width: 100%;
        height: max-content;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 1px;
    }

    .card {
        background-color: #ffffff;
        color: #000;
    }

    .card-header {
        background-color: #007bff;
        border-bottom: none;
        color: white;
    }

    .form-check-label {
        color: #000;
    }

    .btn-primary {
        background-color: #007bff !important;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3 !important;
    }

    .imglong {
        max-width: 100px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
@endsection
@section('content')
<div class="row">
    <div class="col-md-11">
        <div class="card">
            <div class="card-header">
                Data Absen
            </div>
            <div class="card-body">
                <!-- Contoh hasil absen -->
                <p class="text-center">Anda dapat melihat hasil absensi anda setelah melakukan absensi</p>
                <div class="d-flex justify-content-center totals mt-3" style="gap:20px">
                    <p><strong>Total Masuk:</strong> {{ $totalMasuk }}</p>
                    <p><strong>Total Izin:</strong> {{ $totalIzin }}</p>
                    <p><strong>Total BKO:</strong> {{ $totalBKO }}</p>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        DataTable Presensi
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" style="color: black;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Photo</th>
                                    <th>Tanggal</th>
                                    <th>Absen Pulang</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Photo</th>
                                    <th>Tanggal</th>
                                    <th>Absen Pulang</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @php
                                $counter = 1;
                                @endphp
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $counter }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if(strpos($item->image, 'presensi') === 0)
                                        <a href="{{ asset('storage/'.$item->image) }}" data-lightbox="photos">
                                            <img src="{{ asset('storage/'.$item->image) }}" class="img-thumbnail" alt="Fotop" loading="lazy" style="max-width: 100px;">
                                        </a>
                                        @else
                                        <a href="{{ $item->image }}" data-lightbox="photos">
                                            <img src="{{ $item->image }}" alt="" class="img-thumbnail" style="max-width: 100px;">
                                        </a>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, MMMM Do YYYY') }}</td>

                                    <td>
                                        @if(isset($item->ket2))
                                        <p>{{$item->ket2}}</p>
                                        @else
                                        <a href="{{ route('absenp', ['id' => $item->id]) }}" class="btn btn-success">Absen Pulang</a>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                $counter++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
@endsection