@extends('layouts.admin')
@section('title2', 'Penggajian')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        z-index: 1;
        left: -120px;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-item {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-item:hover {
        background-color: #ddd;
    }

    .form-select {
        border: 1px solid #ced4da;
        /* Menambahkan border pada select */
        border-radius: 4px;
        /* Mengatur border radius */
        height: calc(2.25rem + 2px);
        /* Menyesuaikan tinggi dengan input lain */
        text-align-last: center;
        /* Menengahkan teks */
    }

    .select2-container--bootstrap4 .select2-selection--single {
        height: calc(2.25rem + 2px);
        /* Menyesuaikan tinggi dengan input lain */
        border: 1px solid #ced4da;
        /* Menambahkan border pada select */
        border-radius: 4px;
        /* Mengatur border radius */
        display: flex;
        align-items: center;
    }
</style>
@endsection
@section('content')
<main>
    <div class="container-fluid px-4">
        <div class="card mb-4 mt-3">
            <div class="card-body">
                <form action="{{ route('cetak.slip') }}" method="post">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="userSelect" class="form-label">Pilih Pengguna</label>
                        <select name="nik" class="form-select select2" id="userSelect" style="width: 100%;">
                            <option value="">Pilih Pengguna</option>
                            @foreach($users as $id)
                            <option value="{{ $id->nik }}">{{ $id->nik }} | {{$id->name}}</option>
                            @endforeach
                        </select>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jumlahAbsenInput" class="form-label">Jumlah Absen</label>
                                    <input type="text" class="form-control" id="jumlahAbsenInput" name="jumlahabsen" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ktaInput" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="ktaInput" name="nama" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gaji" class="form-label">Gaji Pokok</label>
                                    <input type="text" class="form-control" id="gaji" name="gaji" value="1400000" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="areaInput" class="form-label">Unit Kerja</label>
                                    <input type="text" class="form-control" id="areaInput" name="unit" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tunjangan_jabat" class="form-label">Tunjangan Jabatan</label>
                                    <input type="text" class="form-control" id="tunjangan_jabat" name="tunjabat">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="masa" class="form-label">Masa Kerja</label>
                                    <input type="text" class="form-control" id="masa" name="masa">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tunjangant" class="form-label">Tunjangan transport</label>
                                    <input type="text" class="form-control" id="tunjangant" name="tuntrans" value="700000" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tunjanganm" class="form-label">Tunjangan Makan</label>
                                    <input type="text" class="form-control" id="tunjanganm" name="tunjma" value="700000" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tunjangank" class="form-label">Tunjangan Klien</label>
                                    <input type="text" class="form-control" name="tunjkli" id="tunjangank">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lemburInput" class="form-label">Lemburan</label>
                                    <input type="text" class="form-control" name="lemburan" id="lemburInput" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bpjskInput" class="form-label">BPJS Ketenagakerjaan</label>
                                    <input type="text" class="form-control" name="bpjsk" id="bpjskInput" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bpjsksInput" class="form-label">BPJS Kesehatan</label>
                                    <input type="text" class="form-control" name="bpjsks" id="bpjsksInput" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cashbon" class="form-label">Cicilan Cash BON</label>
                                    <input type="text" class="form-control" name="cashbon" id="cashbon">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cicilan" class="form-label">Cicilan Koprasi</label>
                                    <input type="text" class="form-control" name="cicilan" id="cicilan">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="potabsen" class="form-label">Potongan Absen</label>
                                    <input type="text" class="form-control" name="potabsen" id="potabsen">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggungr" class="form-label">Tanggung Renteng</label>
                                    <input type="text" class="form-control" name="tanggungr" id="tanggungr">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="donasi" class="form-label">Donasi</label>
                                    <input type="text" class="form-control" name="donasi" id="donasi">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="backup" class="form-label">Backup</label>
                                    <input type="text" class="form-control" name="backup" id="backup">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-file"></i> Cetak Slip</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4'
        });

        $('#userSelect').change(function() {
            var userId = $(this).val();
            if (userId) {
                $.ajax({
                    url: '/validate-absen/' + userId,
                    type: 'GET',
                    success: function(response) {
                        $('#jumlahAbsenInput').val(response.totalAbsen);
                        $('#ktaInput').val(response.name);
                        $('#areaInput').val(response.area);
                        $('#bpjskInput').val(response.bpjsket);
                        $('#bpjsksInput').val(response.bpjskes);
                        $('#lemburInput').val(response.jumlahLembur);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                $('#jumlahAbsenInput').val('');
                $('#ktaInput').val('');
                $('#areaInput').val('');
                $('#bpjskInput').val('');
                $('#bpjsksInput').val('');
                $('#lemburInput').val('');
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('template/js/scripts.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('template/js/datatables-simple-demo.js') }} "></script>
@endsection