@extends('layouts.admin')
@section('title2', 'Kehadiran')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<style>
    .dataTables_wrapper {
        width: 100%;
        overflow: auto;
    }

    /* Pastikan tabel tidak mengganggu elemen-elemen kontrol */
    .dataTables_wrapper .dataTables_scroll {
        overflow-x: auto;
        overflow-y: hidden;
    }

    .tableFixHead {
        overflow: auto;
        height: max-content;

    }

    .tableFixHead thead th {
        position: sticky;
        background-color: #5e72e4;
        top: 0;
        z-index: 1;

    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 8px 16px;
    }

    td {
        border: 1px solid #eee;
    }

    th {
        background: grey;
    }

    .th {
        color: white;
    }

    .masuk {
        background-color: green;
        color: white;
        text-align: center;
    }

    .bolos {
        background-color: red;
        color: white;
        text-align: center;
    }

    .izin {
        background-color: grey;
        color: white;
        text-align: center;
    }
</style>
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card ">
            <div class="card-header pb-0 p-3">
                <div class="d-flex flex-wrap justify-content-between">
                    <div class="d-flex  justify-content-between" style="gap:10px">
                        <a href="{{route('cetakpresensi')}}" class="btn btn-primary d-flex align-items-center">Cetak</a>
                        <a href="{{route('detailpresensi')}}" class="btn btn-primary">Detail Presensi</a>
                    </div>
                </div>

            </div>
            <div class="dataTables_wrapper mt-3">
                <div class="tableFixHead">
                    <div class="container">
                        <table class="display table align-items-center" id="example">
                            <thead>
                                <tr>
                                    <th>
                                        <div class=" text-center">
                                            <h6 class="th text-sm mb-0">No</h6>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="text-center">
                                            <h6 class="th text-sm mb-0">Name</h6>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="text-center">
                                            <h6 class="th text-sm mb-0">Nik</h6>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="text-center">
                                            <h6 class="th text-sm mb-0">Area</h6>
                                        </div>
                                    </th>
                                    @for ($i = 1; $i <= 31; $i++) <th>
                                        <div class="text-center">
                                            <h6 class="th text-sm mb-0">{{ $i }}</h6>
                                        </div>
                                        </th>
                                        @endfor
                                        <th>
                                            <div class="masuk text-center" style="width:30px;">
                                                <h6 class="th text-sm mb-0">M</h6>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="bolos text-center" style="width:30px;">
                                                <h6 class="th text-sm mb-0">TK</h6>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="izin text-center" style="width:30px;">
                                                <h6 class="th text-sm mb-0">B</h6>
                                            </div>
                                        </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $counter = 1;
                                $today = now()->format('d');
                                @endphp
                                @foreach ($nama as $name)
                                @if (in_array($name->jabatan, ['Anggota', 'anggota', 'Danru', 'dandru']))
                                @php
                                $totalO = 0;
                                $totalM = 0;
                                $totalB = 0;
                                @endphp
                                <tr>
                                    <td>{{ $counter }}</td>
                                    <td>{{ $name->name }}</td>
                                    <td>{{ $name->nik }}</td>
                                    <td>{{ $name->area }}</td>
                                    @for ($i = 1; $i <= 31; $i++) <td>
                                        @php
                                        $absen = $dataabsen->first(function ($absen) use ($i, $name) {
                                        return $absen->created_at->format('d') == $i && $absen->nik == $name->nik;
                                        });
                                        if ($absen) {
                                        echo '<div class="masuk">M</div>';
                                        $totalM++;
                                        } else {
                                        if ($i > $today) {
                                        echo '<div class="belum">B</div>';
                                        $totalB++;
                                        } else {
                                        echo '<div class="bolos">O</div>';
                                        $totalO++;
                                        }
                                        }
                                        @endphp
                                        </td>
                                        @endfor
                                        <td>{{ $totalM }}</td>
                                        <td>{{ $totalO }}</td>
                                        <td>{{ $totalB }}</td>
                                </tr>
                                @php
                                $counter++;
                                @endphp
                                @endif
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<!-- Custom JS -->
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true,
            scrollX: true, // Menambahkan gulir horizontal
            scrollY: true, // Menambahkan gulir horizontal
            dom: '<"top"f>rt<"bottom"ip><"clear">', // Atur elemen yang akan ditampilkan
            lengthMenu: [
                [10, 10, 25, 50, -1],
                [10, 10, 25, 50, "All"]
            ], // Opsi untuk jumlah baris per halaman
            pagingType: "numbers", // Jenis pagination
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
    });
</script>
@endsection