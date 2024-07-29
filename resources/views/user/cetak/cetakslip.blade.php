<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 11px;
        }
    </style>

</head>

<body>
    <div class="container" id="container" style="border: 3px solid black">
        <br>
        <br>
        <table class="table">
            <tr>
                <td></td>
                <td style="color: white">
                    ____<img src="{{ public_path('foto/logo.png') }}" alt="logo"
                        style="width: 100px; height: 100px;">
                </td>
                <td></td>
            </tr>
        </table>
        <p class="fw-bold" style="text-align:center">STMIK Mardira Indonesia</p>
        <p class="fw-bold" style="text-align:center">{{ \Carbon\Carbon::now()->format('F Y') }}</p>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td style="width:70px"></td>
                    <td style="width: 50px">NAMA</td>
                    <td>: {{ $data['name'] }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>NIK</td>
                    <td>: {{ $data['nik'] }}</td>
                </tr>
            </table>
        </div>
        <?php
        // Hitung total gaji
        $totalGaji = $data['gaji'] + $data['tunjabat'] + $data['masa'] + $data['tuntrans'] + $data['tunjma'] + $data['tunjkli'] + $data['lemburan'] + $data['backup'];
        ?>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td style="width:70px"></td>
                    <td style="width: 200px"><strong>Penghasilan</strong></td>
                    <td></td>
                    <td style="width:30px"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Gaji Pokok</td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;"> {{ $data['gaji'] }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tunjangan Jabatan</td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $data['tunjabat'] }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tunjangan Fungsional/Administrasi</td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $data['masa'] }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tunjangan SKS</td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tunjangan Pulsa</td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $data['tunjma'] }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tunjangan Pembuatan Soal</td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $data['tunjkli'] }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tunjangan Periksa Soal</td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $data['lemburan'] }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tunjangan Ngawas</td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $data['backup'] }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tunjangan Lembur</td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end; "></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tunjangan Kesehatan</td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end; "></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Honor Makan & Trasnport</td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end; "></td>
                </tr>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td style="width:70px"></td>
                    <td style="width:200px"><strong>Potongan</strong></td>
                    <td></td>
                    <td style="width: 30px"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>BPJS Kesehatan</td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;"> {{ $data['gaji'] }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>BPJS Ketenagakerjaan</td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $data['tunjabat'] }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Koperasi</td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $data['masa'] }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Angsuran Koperasi ke</td>
                    <td></td>
                    <td>=</td>
                    <td style="text-align: end;">{{ $data['tuntrans'] }}</td>
                </tr>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td style="width:70px"></td>
                    <td style="width: 200px"><strong>Take Home PAY</strong></td>
                    <td></td>
                    <td style="width: 30px">= Rp.</td>
                    <td style="text-align: end;">{{ $data['tuntrans'] }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
