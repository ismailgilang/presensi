<?php

namespace App\Http\Controllers;


use App\Jobs\ProcessAbsen;
use Illuminate\Http\Request;
use TCPDF;
use App\Http\Requests;
use App\Models\Absen;
use App\Models\DataKaryawan;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $jabatan = Auth::user()->jabatan;
        return view('user.dashboardU', compact('user', 'jabatan'));
    }

    public function absen()
    {
        $user = Auth::user();
        $jabatan = Auth::user()->jabatan;
        $today = Carbon::today();

        // Ambil data absen untuk user tertentu pada hari ini
        $absenHariIni = Absen::where('nik', auth()->user()->nik)
            ->whereDate('created_at', $today)
            ->get();

        $currentDate = Carbon::now()->toDateString();
        $absen = Absen::whereDate('created_at', $currentDate)->get();

        $unit = DataKaryawan::where('nik', $user->nik)->first();
        $waktuSekarang = Carbon::now()->format('H:i');
        return view('user.absen', compact('user', 'unit', 'waktuSekarang', 'absen', 'absenHariIni', 'jabatan'));
    }
    public function upload(Request $request)
    {
        ProcessAbsen::dispatch($request->all());
        return redirect()->route('absen')->with('success', 'Data user berhasil diupdate.');
    }

    public function absenp($id)
    {
        $absen = Absen::findOrFail($id);

        // Ambil waktu saat absen dibuat (created_at)
        $createdAt = $absen->created_at;

        // Ambil waktu saat ini
        $currentTime = Carbon::now();

        // Hitung selisih waktu dalam jam
        $hoursDifference = $currentTime->diffInHours($createdAt);

        // Tentukan ket2 berdasarkan selisih waktu
        if ($hoursDifference >= 9) {
            $absen->ket2 = "pulang tepat";
        } else {
            $absen->ket2 = "pulang cepat";
        }

        // Simpan perubahan pada record Absen
        $absen->save();

        // Redirect ke route 'dataabsen' dengan pesan sukses
        return redirect()->route('dataabsen')->with('success', 'Data user berhasil diupdate.');
    }

    public function dataabsen()
    {
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');
        $user = Auth::user();
        $jabatan = Auth::user()->jabatan;

        $userName = Auth::user()->name;

        $data = DB::table('absens')
            ->where('name', $userName)
            ->whereYear('absens.created_at', $currentYear)
            ->whereMonth('absens.created_at', $currentMonth)
            ->get();

        $totalMasuk = $data->filter(function ($item) {
            return in_array($item->ket, ['Masuk', 'Masuk Telat']);
        })->count();
        $totalIzin = $data->where('ket', 'Izin')->count();
        $totalBKO = $data->where('ket', 'Masuk Backup')->count();
        return view('user.dataabsen', [
            'data' => $data,
            'user' => $user,
            'totalMasuk' => $totalMasuk,
            'totalIzin' => $totalIzin,
            'jabatan' => $jabatan,
            'totalBKO' => $totalBKO
        ]);
    }

    public function profile()
    {
        $user = Auth::user();
        $jabatan = Auth::user()->jabatan;
        $data = DataKaryawan::where('nik', $user->nik)->first();
        return view('user.profile', compact('user', 'data', 'jabatan'));
    }
    public function uploadP(Request $request)
    {
        $id = $request->input('id'); // Mengambil nilai 'id' dari form
        $user = User::findOrFail($id); // Mencari user berdasarkan 'id'

        if ($request->hasFile('profile')) { // Memeriksa apakah ada file yang diunggah
            $fotoP = $request->file('profile'); // Mengambil file yang diunggah
            $filename = $fotoP->getClientOriginalName(); // Mendapatkan nama asli file

            // Menyimpan file ke dalam direktori public/storage/foto dengan nama asli file
            $fotoP->move(public_path('storage/foto'), $filename);

            // Menyimpan path file ke dalam variabel $fotoPPath
            $fotoPPath = 'foto/' . $filename;

            // Simpan path foto ke dalam field 'profile_picture' di tabel user misalnya
            $user->profile = $fotoPPath;
            $user->save();

            return redirect()->route('profile')->with('success', 'Data Berhasil Disimpan!');
        }

        return redirect()->route('profile')->with('Error', 'Data Tidak Berhasil Disimpan!');
    }

    public function editprofile($id)
    {
        // Ambil pengguna berdasarkan ID
        $users = User::findOrFail($id);

        // Ambil nik dari pengguna tersebut
        $fiks = $users->nik;

        // Ambil data karyawan berdasarkan nik
        $data = DataKaryawan::where('nik', $fiks)->first();

        // Ambil pengguna yang memiliki nik yang sama (biasanya hanya satu)
        $user = User::where('nik', $fiks)->first();

        // Kembalikan view dengan data
        return view('user.crud.editProfile', compact('user', 'data'));
    }

    public function updateprofile(Request $request)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'id' => 'required|exists:users,id',          // Pastikan ID pengguna ada di tabel users
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nohp' => 'nullable|string|max:15',
            'jabatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        // Cari pengguna berdasarkan ID
        $user = User::findOrFail($request->id);

        // Perbarui data pengguna
        $user->name = $request->name;
        $user->nik = $request->nik;
        $user->email = $request->email;
        $user->nohp = $request->nohp;
        $user->jabatan = $request->jabatan;
        $user->save();

        // Cari data karyawan berdasarkan NIK
        $dataKaryawan = DataKaryawan::where('nik', $user->nik)->firstOrFail();

        // Perbarui data karyawan
        $dataKaryawan->tanggal = $request->tanggal;
        $dataKaryawan->save();

        // Redirect atau kembalikan respons dengan pesan sukses
        return redirect()->route('profile')->with('success', 'Data Berhasil Disimpan!');
    }
    public function resetPW($id)
    {
        // Ambil pengguna berdasarkan ID
        $user = User::findOrFail($id);
        // Kembalikan view dengan data
        return view('user.crud.resetPass', compact('user'));
    }
    public function updatePW(Request $request)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'id' => 'required|exists:users,id',          // Pastikan ID pengguna ada di tabel users
            'name' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'Cpassword' => 'required|string|max:255',
        ]);

        // Periksa apakah password dan konfirmasi password sama
        if ($request->password !== $request->Cpassword) {
            // Jika tidak sama, kembalikan ke halaman sebelumnya dengan pesan error
            return redirect()->back()->withErrors(['Cpassword' => 'Password dan Konfirmasi Password tidak sama']);
        }

        // Cari pengguna berdasarkan ID
        $user = User::findOrFail($request->id);

        // Perbarui password pengguna setelah hashing
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirect atau kembalikan respons dengan pesan sukses
        return redirect()->route('profile')->with('success', 'Data Berhasil Disimpan!');
    }

    public function dataAnggota()
    {
        $user = Auth::user();

        // Ambil jabatan dari pengguna yang sedang login
        $jabatan = $user->jabatan;

        // Ambil area dari pengguna yang sedang login
        $area = Datakaryawan::where('nik', $user->nik)->value('area');

        // Ambil tanggal hari ini
        $today = Carbon::today();

        // Ambil presensi (absen) dari pengguna yang berada di area yang sama dan hanya untuk hari ini
        $presensiHariIni = Absen::whereDate('created_at', $today)
            ->where('tugas', $area)
            ->get();

        // Kirim data ke view
        return view('user.dataanggota', compact('jabatan', 'presensiHariIni'));
    }

    public function cetakslipA(Request $request, $id)
    {
        // Ambil data dari request
        $user = Auth::user();
        $data = User::findOrFail($id);
        $nama = DataKaryawan::where('nik', $user->nik);

        // Buat instance TCPDF
        $pdf = new TCPDF();
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();

        $html = view('user.cetak.cetakslip', compact('data', 'nama'))->render();

        // Tambahkan HTML ke dokumen PDF
        $pdf->writeHTML($html);

        $filename = 'slip-gaji-' . $user->name . '.pdf';

        // Mengirimkan PDF sebagai respons
        $pdf->Output($filename, 'D');
        exit;
    }

    public function pengajuan()
    {
        $user = auth()->user(); // Mengambil pengguna yang sedang masuk
        $data = Pengajuan::all();
        return view('user.pengajuan', compact('user', 'data'));
    }

    public function Cpengajuan()
    {
        $user = auth()->user(); // Mengambil pengguna yang sedang masuk
        return view('user.crud.pengajuan', compact('user'));
    }

    public function Spengajuan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:50',
            'jenis' => 'required|in:lembur,piket',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_berakhir' => 'required',
        ]);

        // Simpan data ke dalam database
        $pengajuan = new Pengajuan();
        $pengajuan->nama = $request->nama;
        $pengajuan->nik = $request->nik;
        $pengajuan->jenis = $request->jenis;
        $pengajuan->tanggal = $request->tanggal;
        $pengajuan->jam_mulai = $request->jam_mulai;
        $pengajuan->jam_berakhir = $request->jam_berakhir;
        $pengajuan->save();

        // Redirect atau response sesuai kebutuhan aplikasi
        return redirect()->route('pengajuan')->with('success', 'Data pengajuan berhasil disimpan.');
    }
    public function Dpengajuan($id)
    {
        $user = auth()->user(); // Mengambil pengguna yang sedang masuk
        Pengajuan::findOrFail($id)->delete();
        return redirect()->route('pengajuan')->with('success', 'Data pengguna berhasil dihapus.');
    }
}
