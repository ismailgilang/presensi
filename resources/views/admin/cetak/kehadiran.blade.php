<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('template/css/styles.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .button-group {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>

<body>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Cetak Absensi</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">All Level</li>
                </ol>
                <div class="button-group">
                    <a class="nav-link" href="{{ url('detailpresensi') }}"><button type="button" class="btn btn-success"><i class="fa fa-arrow-left"></i> Kembali</button></a>
                    <!-- <a class="nav-link" href="{{ url('/export-pdf') }}"><button type="button" class="btn btn-success"><i class="fa fa-file"></i> Cetak</button></a> -->
                </div>
                <div class="card mb-4 mt-3">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Absensi
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Real location</th>
                                        <th>Location</th>
                                        <th>Tugas</th>
                                        <th>NIK</th>
                                        <th>Sesi</th>
                                        <th>Keterangan</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $counter = 1;
                                    @endphp
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $counter }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->rlocation }}</td>
                                        <td>{{ $item->location }}</td>
                                        <td>{{ $item->tugas }}</td>
                                        <td>{{ $item->nik }}</td>
                                        <td>{{ $item->sesi }}</td>
                                        <td>{{ $item->ket }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, MMMM Do YYYY') }}</td>
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
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script>
        $(document).ready(function() {
            $("#data").DataTable({
                dom: "Bfrtip",
                buttons: ["excelHtml5", "pdfHtml5"],
            })
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('template/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('template/js/datatables-simple-demo.js') }} "></script>
</body>

</html>