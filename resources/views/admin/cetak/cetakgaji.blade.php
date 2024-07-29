<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 8px;
        }
    </style>

</head>

<body>
    <div class="container" id="container">
        <p class="fw-bold">RAJAWALI GARDA BUANA-86 SS</p>
        <p class="fw-bold" style="text-align:center">{{ \Carbon\Carbon::now()->format('F Y') }}</p>
        <div class="table-responsive">
            <table class="table" style="border-bottom: 1px solid transparent">
                <tr>
                    <td style="width: 200px;">NAMA</td>
                    <td>: {{ $data['nama'] }}</td>
                </tr>
                <tr>
                    <td>UNIT KERJA</td>
                    <td>: {{ $data['unit'] }}</td>
                </tr>
                <tr style="border-bottom: 1px solid black;">
                    <td>NIK</td>
                    <td>: {{ $data['nik'] }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <?php
        // Hitung total gaji
        $totalGaji = $data['gaji'] + $data['tunjabat'] + $data['masa'] + $data['tuntrans'] + $data['tunjma'] + $data['tunjkli'] + $data['lemburan'] + $data['backup'];

        // Hitung total potongan
        $totalPotongan = $data['bpjsk'] + $data['bpjsks'] + $data['cashbon'] + $data['cicilan'] + $data['potabsen'] + $data['tanggungr'] + $data['donasi'];

        // Hitung netto
        $netto = $totalGaji - $totalPotongan;
        ?>
        <div class="table-responsive">
            <table class="table" style="border-bottom: 1px solid transparent">
                <tr>
                    <td>GAJI POKOK</td>
                    <td>:</td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;"> {{ $data['gaji'] }}</td>
                </tr>
                <tr>
                    <td>TUNJ. JABATAN</td>
                    <td>:</td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $data['tunjabat'] }}</td>
                </tr>
                <tr>
                    <td>MASA KERJA</td>
                    <td>:</td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $data['masa'] }}</td>
                </tr>
                <tr>
                    <td>TUNJ. TRANSPORT</td>
                    <td>:</td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $data['tuntrans'] }}</td>
                </tr>
                <tr>
                    <td>TUNJ. MAKAN</td>
                    <td>:</td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $data['tunjma'] }}</td>
                </tr>
                <tr>
                    <td>TUNJ. KLIEN</td>
                    <td>:</td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $data['tunjkli'] }}</td>
                </tr>
                <tr>
                    <td>LEMBUR <span>(inc tunj. Mkn & trans)</span></td>
                    <td>:</td>
                    <td>1</td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $data['lemburan'] }}</td>
                </tr>
                <tr>
                    <td>BACKUP <span>(inc tunj. Mkn & trans)</span></td>
                    <td>:</td>
                    <td>0</td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $data['backup'] }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="border-bottom: 1px solid black;"></td>
                </tr>
                <tr style="border-bottom: 1px solid black;">
                    <td colspan="3" style="text-align: end;">GROSS</td>
                    <td>= Rp.</td>
                    <td style="text-align: end; ">{{ $totalGaji }}</td>
                </tr>
            </table>
        </div>
        <div class="table-responsive">
            <table class=" table" style="border-bottom: 1px solid transparent">
                <tr>
                    <td>BPJS KETENAGAKERJAAN</td>
                    <td></td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $data['bpjsk'] }}</td>
                </tr>
                <tr>
                    <td>BPJS KESEHATAN</td>
                    <td></td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $data['bpjsks'] }}</td>
                </tr>
                <tr>
                    <td>CICILAN CASH BON</td>
                    <td><span>-ke</span></td>
                    <td><span>-dari</span></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $data['cashbon'] }}</td>
                </tr>
                <tr>
                    <td>CICILAN KOPERASI</td>
                    <td><span>-ke</span></td>
                    <td><span>-dari</span></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $data['cicilan'] }}</td>
                </tr>
                <tr>
                    <td>POTONGAN ABSEN</td>
                    <td></td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $data['potabsen'] }}</td>
                </tr>
                <tr>
                    <td>TANGGUNG RENTENG</td>
                    <td></td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $data['tanggungr'] }}</td>
                </tr>
                <tr>
                    <td>DONASI</td>
                    <td></td>
                    <td></td>
                    <td>= Rp.</td>
                    <td style="border-bottom: 1px solid black; text-align: end;">{{ $data['donasi'] }}</td>
                </tr>
                <tr style="border-bottom: 1px solid black;">
                    <td colspan="3" style="text-align: center;">TOTAL POTONGAN</td>
                    <td>= Rp.</td>
                    <td style="text-align: end;">{{ $totalPotongan }}</td>
                </tr>
                <tr style="height: 60px; font-size:15px">
                    <td colspan="3" style="text-align: end;">NETTO</td>
                    <td> = Rp.</td>
                    <td style="text-align: end;">{{ $netto }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>