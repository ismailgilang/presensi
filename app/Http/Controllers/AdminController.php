<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;
use PDF;
use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\Jadwal;
use Dompdf\Options;
use Response;
use App\Http\Requests;
use App\Models\Absen;
use App\Models\User;
use App\Models\Patroli;
use App\Models\DataKaryawan;
use App\Models\Pengajuan;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

class AdminController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Mengambil pengguna yang sedang masuk
        $jabatans = User::where('id', $user->id)->pluck('jabatan'); // Mengambil jabatan pengguna

        // Mengirim data jabatan ke view
        return view('admin.dashboard', compact('jabatans', 'user'));
    }

    public function akun_admin()
    {
        $user = auth()->user(); // Mengambil pengguna yang sedang masuk
        $jabatans = User::where('id', $user->id)->pluck('jabatan');
        $data = User::all(); // Mengambil semua data
        return view('admin.akun_admin', compact('data', 'jabatans', 'user'));
    }


    public function create(): View
    {
        return view('admin.crud_akun.create');
    }
    public function getLastId()
    {
        // Ambil data terakhir dari database
        $lastId = DataKaryawan::latest()->pluck('nik')->first();
        return response()->json(['lastId' => $lastId]);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //create post

        //redirect to index
        return redirect()->route('akun_admin')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit($id)
    {
        $userData = User::findOrFail($id);
        return view('admin.crud_akun.edit', compact('userData'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'password' => 'required|string|min:5',
            'level' => 'required|in:admin,user',
        ]);

        $userData = User::findOrFail($id);
        $userData->name = $request->name;
        $userData->username = $request->username;
        $userData->password = bcrypt($request->password);
        $userData->level = $request->level;
        $userData->save();

        return redirect()->route('akun_admin')->with('success', 'Data user berhasil diupdate.');
    }

    public function delete($id)
    {
        // Cari data pengguna berdasarkan ID dan hapus
        User::findOrFail($id)->delete();
        return redirect()->route('akun_admin')->with('success', 'Data pengguna berhasil dihapus.');
    }

    //kehadiran
    public function kehadiran()
    {
        $nama = Datakaryawan::all();
        $dates = [];

        // Perulangan dari 1 hingga 31
        for ($i = 1; $i <= 31; $i++) {
            // Format tanggal dengan menambahkan 0 di depan jika angka kurang dari 10
            $formattedDate = str_pad($i, 2, '0', STR_PAD_LEFT);
            $dates[] = $formattedDate;
        }

        // Mengambil semua data user
        $tanggalSekarang = now(); // Mengambil tanggal dan waktu saat ini menggunakan fungsi now() dari Carbon
        // Mendapatkan tahun dan bulan saat ini
        $tahunSekarang = $tanggalSekarang->year;
        $bulanSekarang = $tanggalSekarang->month;

        // Mendapatkan data absen yang sesuai dengan tahun dan bulan saat ini dan nik yang sesuai dengan data user
        $dataabsen = Absen::whereYear('created_at', $tahunSekarang)
            ->whereMonth('created_at', $bulanSekarang)
            ->whereIn('nik', function ($query) {
                $query->select('nik')->from('absens');
            })
            ->get();
        $user = auth()->user(); // Mengambil pengguna yang sedang masuk
        $jabatans = User::where('id', $user->id)->pluck('jabatan');

        // Mengirimkan $dataPerTanggal ke view untuk menampilkan data berdasarkan tanggal
        return view('admin.kehadiran', compact('dates', 'dataabsen', 'jabatans', 'user', 'nama'));
    }
    public function detailpresensi()
    {
        $user = auth()->user(); // Mengambil pengguna yang sedang masuk
        $jabatans = User::where('id', $user->id)->pluck('jabatan');
        $data = Absen::all(); // Mengambil semua data
        return view('admin.detail.presensi', compact('data', 'jabatans', 'user'));
    }

    public function Ckehadiran()
    {
        $data = Absen::all(); // Mengambil semua data
        return view('admin.cetak.kehadiran', compact('data'));
    }
    public function cetakpresensi()
    {
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');
        $absenCounts = Absen::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->pluck('count', 'date');

        // Inisialisasi array untuk menampung status masuk atau tidak masuk
        $statusAbsen = [];

        // Loop dari tanggal 1 hingga 31
        for ($day = 1; $day <= 31; $day++) {
            $date = Carbon::create($currentYear, $currentMonth, $day)->format('Y-m-d');
            $statusAbsen[$day] = $absenCounts->has($date) ? 'M' : 'B';
        }

        $data = Absen::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->select('name', 'nik', 'tugas')
            ->distinct()
            ->get();
        $user = auth()->user(); // Mengambil pengguna yang sedang masuk
        $jabatans = User::where('id', $user->id)->pluck('jabatan');

        return view('admin.cetak.cetakpresensi', compact('data', 'statusAbsen', 'jabatans', 'user'));
    }
    public function exportPdfWithImage()
    {
        // Mengambil data dari tabel atau sumber lainnya
        $data = Absen::all(); // Pastikan Anda mengganti 'User' dengan model yang sesuai

        // Membuat objek Dompdf
        $pdf = new Dompdf();

        // Membuat HTML untuk file PDF
        $html = view('admin.cetak.kehadiran', compact('data'))->render();

        // Memuat HTML ke objek Dompdf
        $pdf->loadHtml($html);

        // Menyetel ukuran dan orientasi kertas
        $pdf->setPaper('A4', 'landscape');

        // Render PDF (optional)
        $pdf->render();

        // Output PDF
        return $pdf->stream('report.pdf');
    }

    //pengajian
    public function penggajian()
    {
        $user = auth()->user(); // Mengambil pengguna yang sedang masuk
        $jabatans = User::where('id', $user->id)->pluck('jabatan');
        $users = User::all(); // Ambil semua nama pengguna dari database
        return view('admin.penggajiank', compact('users', 'jabatans', 'user'));
    }

    public function validateAbsen($userId)
    {
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Mengambil jumlah absen untuk setiap shift
        $jumlahAbsen = Absen::where('nik', $userId)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->selectRaw('SUM(CASE WHEN sesi = "pagi" THEN 1 ELSE 0 END) AS jumlah_pagi')
            ->selectRaw('SUM(CASE WHEN sesi = "siang" THEN 1 ELSE 0 END) AS jumlah_siang')
            ->selectRaw('SUM(CASE WHEN sesi = "malam" THEN 1 ELSE 0 END) AS jumlah_malam')
            ->first();

        // Menggabungkan jumlah absen dari setiap shift ke dalam satu variabel
        $totalAbsen = $jumlahAbsen->jumlah_pagi + $jumlahAbsen->jumlah_siang + $jumlahAbsen->jumlah_malam;

        $jumlahLembur = Absen::where('nik', $userId)
            ->where('sesi', 'lembur')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
        $name = DataKaryawan::where('nik', $userId)->pluck('name')->first();
        $area = DataKaryawan::where('nik', $userId)->pluck('area')->first();
        $bpjsket = DataKaryawan::where('nik', $userId)->pluck('bpjskt')->first();
        $bpjskes = DataKaryawan::where('nik', $userId)->pluck('bpjskn')->first();

        // Kemudian kembalikan respons dalam format JSON
        return response()->json(['totalAbsen' => $totalAbsen, 'name' => $name, 'area' => $area, 'bpjsket' => $bpjsket, 'bpjskes' => $bpjskes, 'jumlahLembur' => $jumlahLembur]);
    }

    public function slip(Request $request)
    {
        // Ambil data dari request
        $data = $request->all();
        $nama = $request->input('nama');

        // Buat instance TCPDF
        $pdf = new TCPDF();
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();

        // Ambil HTML dari view cetakgaji.blade.php dengan data yang diberikan
        $html = view('admin.cetak.cetakgaji', compact('data'))->render();

        // Tambahkan HTML ke dokumen PDF
        $pdf->writeHTML($html);

        $filename = 'slip-gaji-' . $nama . '.pdf';

        // Mengirimkan PDF sebagai respons
        $pdf->Output($filename, 'D');
        exit;
    }

    public function penugasan()
    {
        $user = auth()->user(); // Mengambil pengguna yang sedang masuk
        $jabatans = User::where('id', $user->id)->pluck('jabatan');
        $users = DataKaryawan::all(); // Ambil semua nama pengguna dari database
        return view('admin/penugasan', compact('users', 'jabatans', 'user'));
    }

    public function validateTugas($userId)
    {
        $name = DataKaryawan::where('nik', $userId)->pluck('name')->first();
        $jabatan = DataKaryawan::where('nik', $userId)->pluck('jabatan')->first();
        $area = DataKaryawan::where('nik', $userId)->pluck('area')->first();
        return response()->json(['name' => $name, 'jabatan' => $jabatan, 'area' => $area]);
    }

    public function generatePDF(Request $request)
    {
        $data = $request->all();
        $nama = $request->input('nama');

        // Buat instance TCPDF
        $pdf = new TCPDF();
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();

        // Ambil HTML dari view cetakgaji.blade.php dengan data yang diberikan
        $html = view('admin.cetak.tugas', compact('data'))->render();

        // Tambahkan HTML ke dokumen PDF
        $pdf->writeHTML($html);

        $filename = 'Surat tugas ' . $nama . '.pdf';

        // Mengirimkan PDF sebagai respons
        $pdf->Output($filename, 'D');
        exit;
    }

    public function inventaris()
    {
        $user = auth()->user(); // Mengambil pengguna yang sedang masuk
        $jabatans = User::where('id', $user->id)->pluck('jabatan');
        return view('admin.inventaris', compact('jabatans', 'user'));
    }
    public function keuangan()
    {
        $user = auth()->user(); // Mengambil pengguna yang sedang masuk
        $jabatans = User::where('id', $user->id)->pluck('jabatan');
        return view('admin.keuangan', compact('jabatans', 'user'));
    }

    public function createj()
    {
        $users = DataKaryawan::pluck('area'); // Ambil semua nama pengguna dari database

        $currentMonth = Carbon::now()->month;
        $daysInMonth = Carbon::now()->daysInMonth;

        $dates = [];
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $date = Carbon::create(null, $currentMonth, $i);
            $dayName = $date->isoFormat('dd'); // Mendapatkan nama hari dalam bahasa Indonesia
            $content = "Isi tanggal ke-$i";
            $dates[] = ['date' => $date->format('d'), 'day' => $dayName, 'content' => $content];
        }
        return view('admin/crud/jadwal', compact('users', 'dates'));
    }

    public function data_karyawan()
    {
        $user = auth()->user(); // Mengambil pengguna yang sedang masuk
        $jabatans = User::where('id', $user->id)->pluck('jabatan');
        $data = DataKaryawan::all(); // Mengambil semua data
        return view('admin.datakaryawan', compact('data', 'jabatans', 'user'));
    }
    public function tambahkaryawan()
    {
        $areas = DataKaryawan::distinct()->pluck('area')->toArray();
        return view('admin.crud.tambahkaryawan', compact('areas'));
    }
    public function uploadkaryawan(Request $request)
    {
        DataKaryawan::create([
            // 'image'     => $image->hashName(),
            'nik'   => $request->nik,
            'name'     => $request->name,
            'jabatan'   => $request->jabatan,
            'area'     => $request->area,
            'status'   => $request->status,
            'bpjskt'   => $request->bpjskt,
            'bpjskn'     => $request->bpjskn,
            'tanggal'     => $request->tanggal,
        ]);
        User::create([
            // 'image'     => $image->hashName(),
            'name'     => $request->name,
            'username'   => $request->username,
            'email'     => $request->email,
            'password'   => $request->password,
            'nik'   => $request->nik,
            'level'     => $request->level,
            'jabatan'     => $request->jabatan,
        ]);

        //redirect to index
        return redirect()->route('dataKaryawan')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function editkaryawan($id)
    {
        $karyawan = DataKaryawan::findOrFail($id);
        // Mengembalikan view untuk halaman edit dengan data karyawan yang dipilih
        return view('admin.crud.editkaryawan', compact('karyawan'));
    }
    public function updatekaryawan(Request $request, $id)
    {
        // Validasi input
        // $request->validate([
        //     'nik' => 'required',
        //     'username' => 'required',
        //     'jabatan' => 'required',
        //     'area' => 'required',
        //     'status' => 'required',
        //     'bpjskt' => 'required',
        //     'bpjskn' => 'required',
        // ]);

        // Temukan karyawan berdasarkan NIK
        $karyawan = DataKaryawan::findOrFail($id);
        // Simpan data yang diperbarui
        $karyawan->name = $request->name;
        $karyawan->jabatan = $request->jabatan;
        $karyawan->area = $request->area;
        $karyawan->status = $request->status;
        $karyawan->bpjskt = $request->bpjskt;
        $karyawan->bpjskn = $request->bpjskn;
        $karyawan->tanggal = $request->tanggal;
        $karyawan->save();

        return redirect()->route('dataKaryawan')->with('success', 'Data user berhasil diupdate.');
    }
    public function destroyk($id)
    {
        // Cari data pengguna berdasarkan ID dan hapus
        DataKaryawan::findOrFail($id)->delete();
        return redirect()->route('dataKaryawan')->with('success', 'Data pengguna berhasil dihapus.');
    }

    public function getdataunit($unit)
    {
        $users = DataKaryawan::where('area', $unit)->get();
        return response()->json($users);
    }

    public function getData()
    {
        $data = User::all(); // Ganti YourModel dengan model Anda
        return response()->json($data);
    }

    public function Apengajuan()
    {
        $user = auth()->user(); // Mengambil pengguna yang sedang masuk
        $data = Pengajuan::all();
        return view('admin.pengajuan', compact('user', 'data'));
    }
    public function Dpengajuan($id)
    {
        $user = auth()->user(); // Mengambil pengguna yang sedang masuk
        Pengajuan::findOrFail($id)->delete();
        return redirect()->route('admin.pengajuan')->with('success', 'Data pengguna berhasil dihapus.');
    }
    public function approve($id)
    {
        $user = auth()->user(); // Mengambil pengguna yang sedang masuk
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = "Disetujui";
        $pengajuan->save();
        return redirect()->route('admin.pengajuan')->with('success', 'Data pengguna berhasil di Approve.');
    }

    public function ttd1(Request $request, $id)
    {
        $user = auth()->user(); // Mengambil pengguna yang sedang masuk
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->ttd1 = $request->signature_data_modal1;
        $pengajuan->save();
        return redirect()->route('admin.pengajuan')->with('success', 'Data pengguna berhasil di Approve.');
    }
    public function ttd2(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->ttd2 = $request->signature_data_modal2;
        $pengajuan->save();
        return redirect()->route('admin.pengajuan')->with('success', 'Data pengguna berhasil di Approve.');
    }
    public function ttd3(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->ttd3 = $request->signature_data_modal3;
        $pengajuan->save();
        return redirect()->route('admin.pengajuan')->with('success', 'Data pengguna berhasil di Approve.');
    }
}
