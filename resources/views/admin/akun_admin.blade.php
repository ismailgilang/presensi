@extends('layouts.admin')
@section('title2', 'Admin Account')
@section('css')
<!-- Datatables CSS -->
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
</style>
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card ">
            <div class="card-header pb-0 p-3">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-2">Data Account</h6>
                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inputModal">
                        Tambah
                    </button> -->
                </div>
            </div>

            <div class="dataTables_wrapper mt-3">
                <div class="tableFixHead">
                    <div class="container">
                        <table class="table align-items-center " id="example">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="text-center">
                                            <h6 class="th text-sm mb-0"> No</h6>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="text-center">
                                            <h6 class="th text-sm mb-0"> Name</h6>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="text-center">
                                            <h6 class="th text-sm mb-0"> Nik</h6>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="text-center">
                                            <h6 class="th text-sm mb-0"> username</h6>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="text-center">
                                            <h6 class="th text-sm mb-0"> password</h6>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="text-center">
                                            <h6 class="th text-sm mb-0"> level</h6>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="text-center">
                                            <h6 class="th text-sm mb-0"> Option</h6>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $counter = 1;
                                @endphp
                                @foreach ($data as $item)
                                <tr>
                                    <td>
                                        <div class="text-center">
                                            <h6 class="text-sm mb-0">{{ $counter }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <h6 class="text-sm mb-0"> {{$item->name }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <h6 class="text-sm mb-0"> {{$item->nik }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <h6 class="text-sm mb-0">{{ $item->username }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <h6 class="text-sm mb-0">{{ $item->password }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <h6 class="text-sm mb-0"> {{$item->level }}</h6>
                                        </div>
                                    </td>
                                    <td style="display: flex; gap :10px">
                                        <a href="{{ route('admin.edit', ['id' => $item->id]) }}" class="btn btn-warning">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.delete', ['id' => $item->id]) }}" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
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
<!--modal sementara-->
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ], // Opsi untuk jumlah baris per halaman
            pagingType: "numbers", // Jenis pagination
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection