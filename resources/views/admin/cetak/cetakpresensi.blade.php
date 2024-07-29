<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Cetak Presensi</h6>
                            <a href="{{route('kehadiran')}}" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                    <div class="table-responsive mt-1">
                        <table class="display table align-items-center" id="data">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="text-center">
                                            <h6 class="text-sm mb-0">No</h6>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="text-center">
                                            <h6 class="text-sm mb-0">Name</h6>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="text-center">
                                            <h6 class="text-sm mb-0">Nik</h6>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="text-center">
                                            <h6 class="text-sm mb-0">Area</h6>
                                        </div>
                                    </th>
                                    @for($i=1; $i < 32; $i++) <th>
                                        <div class="text-center">
                                            <h6 class="text-sm mb-0">{{$i}}</h6>
                                        </div>
                                        </th>
                                        @endfor


                                        <th>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0" style=" background-color: #9FE2BF; padding:5px 10px 5px 10px">M</h6>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0" style="background-color: red; padding:5px 10px 5px 10px">O</h6>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="text-center">
                                                <h6 class="text-sm mb-0" style="background-color: yellow; padding:5px 10px 5px 10px">TK</h6>
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
                                            <h6 class="text-sm mb-0"> {{$item->tugas }}</h6>
                                        </div>
                                    </td>
                                    @foreach($statusAbsen as $day => $status)
                                    @if($status == "M")
                                    <td><span style="background-color: green; color:white; padding:5px 10px 5px 10px;">{{ $status }}</span></td>
                                    @else
                                    <td><span style="background-color: red; color:white; padding:5px 10px 5px 10px">{{ $status }}</span></td>
                                    @endif
                                    @endforeach
                                    <td>
                                        <div class="text-sm mb-0">
                                            <h6>2</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm mb-0">
                                            <h6>0</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm mb-0">
                                            <h6>0</h6>
                                        </div>
                                    </td>

                                </tr>
                                @php
                                $counter++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <div id="myModal" class="modal" onclick="closeModal()">
                            <span class="close">&times;</span>
                            <img class="modal-content" id="modalImg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#data").DataTable({
                dom: "Bfrtip",
                buttons: [{
                    extend: 'excelHtml5',
                    text: 'Export to Excel',
                    customize: function(xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        // Loop melalui setiap baris dan setiap sel
                        $('row c', sheet).each(function() {
                            var cell = $(this);
                            // Periksa jika sel memiliki warna latar belakang yang didefinisikan
                            if (cell.attr('s') && cell.attr('s').indexOf('background-color') !== -1) {
                                // Dapatkan warna latar belakang dari atribut fill
                                var color = cell.attr('s').split('background-color:')[1].split(';')[0];
                                // Terapkan warna latar belakang ke sel
                                cell.attr('s', cell.attr('s') + 'fill:' + color + ';');
                            }
                        });
                    }
                }]
            });
        });
    </script>
</body>

</html>