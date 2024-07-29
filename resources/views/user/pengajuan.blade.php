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
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Data Pengajuan</h5>
                        <a href="{{ route('pengajuan.create') }}" class="btn btn-light">Buat Pengajuan</a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Contoh hasil absen -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Tabel Pengajuan
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple" style="color: black;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nik</th>
                                            <th>Jenis</th>
                                            <th>Tanggal</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Berakhir</th>
                                            <th>Diajukan</th>
                                            <th>Status</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nik</th>
                                            <th>Jenis</th>
                                            <th>Tanggal</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Berakhir</th>
                                            <th>Diajukan</th>
                                            <th>Status</th>
                                            <th>Option</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($data as $item)
                                            @php
                                                $i = 1;
                                            @endphp
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->nik }}</td>
                                                <td>{{ $item->jenis }}</td>
                                                <td>{{ $item->tanggal }}</td>
                                                <td>{{ $item->jam_mulai }}</td>
                                                <td>{{ $item->jam_berakhir }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    @if (isset($item->status))
                                                        <span class="badge badge-success">{{ $item->status }}</span>
                                                    @else
                                                        <span class="badge badge-warning">Belum Disetujui</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('pengajuan.destroyU', $item->id) }}"
                                                        class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            @php
                                                $i++;
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
    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
@endsection
