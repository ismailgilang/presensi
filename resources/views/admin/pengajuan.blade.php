@extends('layouts.admin')
@section('title2', 'Pengajuan')
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
            text-align: center;
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
    @endsection @section('content') <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card ">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Data Pengajuan</h6>
                    </div>
                </div>
                <div class="dataTables_wrapper mt-3">
                    <div class="tableFixHead">
                        <div class="container">
                            <table class="display table text-align-center" id="example">
                                <thead>
                                    <tr>
                                        <th class="th">No</th>
                                        <th class="th">Nama</th>
                                        <th class="th">Nik</th>
                                        <th class="th">Jenis</th>
                                        <th class="th">Tanggal</th>
                                        <th class="th">Jam Mulai</th>
                                        <th class="th">Jam Berakhir</th>
                                        <th class="th">Diajukan</th>
                                        <th class="th">Status</th>
                                        <th class="th">TTD 1</th>
                                        <th class="th">TTD 2</th>
                                        <th class="th">TTD 3</th>
                                        <th class="th">Option</th>
                                    </tr>
                                </thead>
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
                                                    <span class="badge bg-success">{{ $item->status }}</span>
                                                @else
                                                    <span class="badge bg-warning">Belum Disetujui</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($item->ttd1))
                                                    <img src="{{ $item->ttd1 }}" alt=""
                                                        style="width:100px;height:50px">
                                                @else
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#modal1">
                                                        TTD 1
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($item->ttd2))
                                                    <img src="{{ $item->ttd2 }}" alt=""
                                                        style="width:100px;height:50px">
                                                @else
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#modal2">
                                                        TTD 2
                                                    </button>
                                                @endif

                                            </td>
                                            <td>
                                                @if (isset($item->ttd3))
                                                    <img src="{{ $item->ttd3 }}" alt=""
                                                        style="width:100px;height:50px">
                                                @else
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#modal3">
                                                        TTD 3
                                                    </button>
                                                @endif

                                            </td>
                                            <td style="gap: 10px">
                                                @if (isset($item->ttd1) && isset($item->ttd2) && isset($item->ttd3))
                                                    <a href="{{ route('pengajuan.approve', $item->id) }}"
                                                        class="btn btn-primary">Approve</a>
                                                @else
                                                    <span class="badge bg-warning">Belum Lengkap</span>
                                                @endif

                                                <a href="{{ route('pengajuan.destroy', $item->id) }}"
                                                    class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>@php
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
    <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="signInModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signInModalLabel">Tanda Tangan 1</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <form action="{{ route('post.ttd1', $item->id) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div id="signature-pad-modal1" class="signature-pad">
                            <div class="signature-pad-body" style="display:flex;justify-content:center"><canvas
                                    id="canvas-modal1" style="border: 1px solid black"></canvas>
                            </div>
                            <div class="signature-pad-footer mt-4">
                                <button type="button" class="btn btn-secondary" id="clear-button-modal1">Clear</button>
                                <button type="submit" class="btn btn-primary" id="save-button-modal1">Simpan</button>
                            </div>
                        </div>
                        <input type="hidden" name="signature_data_modal1" id="signature_data_modal1">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="signInModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signInModalLabel">Tanda Tangan 2</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <form action="{{ route('post.ttd2', $item->id) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div id="signature-pad-modal2" class="signature-pad">
                            <div class="signature-pad-body" style="display:flex;justify-content:center"><canvas
                                    id="canvas-modal2" style="border: 1px solid black"></canvas></div>
                            <div class="signature-pad-footer mt-4">
                                <button type="button" class="btn btn-secondary" id="clear-button-modal2">Clear</button>
                                <button type="submit" class="btn btn-primary" id="save-button-modal2">Simpan</button>
                            </div>
                        </div>
                        <input type="hidden" name="signature_data_modal2" id="signature_data_modal2">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="signInModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signInModalLabel">Tanda Tangan 3</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <form action="{{ route('post.ttd3', $item->id) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div id="signature-pad-modal3" class="signature-pad">
                            <div class="signature-pad-body" style="display:flex;justify-content:center"><canvas
                                    id="canvas-modal3" style="border: 1px solid black"></canvas></div>
                            <div class="signature-pad-footer mt-4">
                                <button type="button" class="btn btn-secondary" id="clear-button-modal3">Clear</button>
                                <button type="submit" class="btn btn-primary" id="save-button-modal3">Simpan</button>
                            </div>
                        </div>
                        <input type="hidden" name="signature_data_modal3" id="signature_data_modal3">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad"></script>

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
<script>
    // Inisialisasi SignaturePad untuk setiap modal
    var canvasModal1 = document.getElementById('canvas-modal1');
    var signaturePadModal1 = new SignaturePad(canvasModal1, {
        backgroundColor: 'rgb(255, 255, 255)' // warna latar belakang canvas
    });

    var canvasModal2 = document.getElementById('canvas-modal2');
    var signaturePadModal2 = new SignaturePad(canvasModal2, {
        backgroundColor: 'rgb(255, 255, 255)' // warna latar belakang canvas
    });

    var canvasModal3 = document.getElementById('canvas-modal3');
    var signaturePadModal3 = new SignaturePad(canvasModal3, {
        backgroundColor: 'rgb(255, 255, 255)' // warna latar belakang canvas
    });

    // Fungsi untuk membersihkan tanda tangan
    function clearSignature(pad) {
        pad.clear();
    }

    // Handle event saat tombol Clear diklik
    document.getElementById('clear-button-modal1').addEventListener('click', function() {
        clearSignature(signaturePadModal1);
    });

    document.getElementById('clear-button-modal2').addEventListener('click', function() {
        clearSignature(signaturePadModal2);
    });

    document.getElementById('clear-button-modal3').addEventListener('click', function() {
        clearSignature(signaturePadModal3);
    });

    // Handle event saat tombol Simpan diklik
    document.getElementById('save-button-modal1').addEventListener('click', function() {
        document.getElementById('signature_data_modal1').value = signaturePadModal1.toDataURL();
        $('#modal1').modal('hide'); // sembunyikan modal setelah disimpan
    });

    document.getElementById('save-button-modal2').addEventListener('click', function() {
        document.getElementById('signature_data_modal2').value = signaturePadModal2.toDataURL();
        $('#modal2').modal('hide'); // sembunyikan modal setelah disimpan
    });

    document.getElementById('save-button-modal3').addEventListener('click', function() {
        document.getElementById('signature_data_modal3').value = signaturePadModal3.toDataURL();
        $('#modal3').modal('hide'); // sembunyikan modal setelah disimpan
    });
</script>@endsection
