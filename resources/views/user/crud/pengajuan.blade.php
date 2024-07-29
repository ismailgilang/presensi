@extends('layouts.user')
@section('title', 'Dashboard')
@section('css')
    <style>
        .card {
            width: 100%;
        }
    </style>
@endsection
@section('content')
    <div class="card">
        <h3 class="text-center mt-3">Form Pengajuan Lembur / Piket</h3>
        <div class="card-body">
            <form method="POST" action="{{ route('pengajuan.store') }}">
                @csrf

                <!-- Nama -->
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->name }}"
                        readonly required>
                </div>

                <!-- NIK -->
                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" value="{{ $user->nik }}"
                        readonly required>
                </div>

                <!-- Lembur/Piket -->
                <div class="form-group">
                    <label for="jenis">Jenis Lembur / Piket</label>
                    <select class="form-control" id="jenis" name="jenis" required>
                        <option value="" selected>-- Pilih Jenis</option>
                        <option value="lembur">Lembur</option>
                        <option value="piket">Piket</option>
                    </select>
                </div>

                <!-- Tanggal -->
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>

                <!-- Jam Mulai -->
                <div class="form-group">
                    <label for="jam_mulai">Jam Mulai</label>
                    <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
                </div>

                <!-- Jam Berakhir -->
                <div class="form-group">
                    <label for="jam_berakhir">Jam Berakhir</label>
                    <input type="time" class="form-control" id="jam_berakhir" name="jam_berakhir" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
@section('js')
@endsection
