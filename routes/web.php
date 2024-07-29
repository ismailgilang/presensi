<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/unduh-surat', [SuratController::class, 'unduhSurat']);

// login
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
// kita atur juga untuk middleware menggunakan group pada routing
// didalamnya terdapat group untuk mengecek kondisi login
// jika user yang login merupakan admin maka akan diarahkan ke AdminController
// jika user yang login merupakan user biasa maka akan diarahkan ke UserController
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login:admin']], function () {
        Route::resource('admin', AdminController::class);
    });
    Route::group(['middleware' => ['cek_login:user']], function () {
        Route::resource('user', UserController::class);
    });
});

Route::get('/dashboard_admin', [AdminController::class, 'index'])->name('admin');
// admin / akun
//create
Route::get('/akun_admin', [AdminController::class, 'akun_admin'])->name('akun_admin');
Route::get('/akun_admin/create', [AdminController::class, 'create'])->name('createdA');
Route::get('/last-id', [AdminController::class, 'getLastId'])->name('last-id');
Route::post('/akun_admin/create/upload', [AdminController::class, 'store']);
// data karyawan
Route::get('/data_karyawan', [AdminController::class, 'data_karyawan'])->name('dataKaryawan');
Route::get('/tambah-karyawan', [AdminController::class, 'tambahkaryawan'])->name('tambah-karyawan');
Route::post('/upload-karyawan', [AdminController::class, 'uploadkaryawan'])->name('upload-karyawan');
Route::get('/edit-karyawan/{id}', [AdminController::class, 'editkaryawan'])->name('edit-karyawan');
Route::get('/hapus-karyawan/{id}', [AdminController::class, 'destroyk'])->name('hapus-karyawan');
Route::put('/update-karyawan/{id}', [AdminController::class, 'updatekaryawan'])->name('update-karyawan');
//edit
Route::get('/editakun/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/update/{id}', [AdminController::class, 'update'])->name('admin.update');
//delete
Route::get('/hapus/{id}', [AdminController::class, 'delete'])->name('admin.delete');
//admin / kehadiran
//admin / kehadiran / user
Route::get('/kehadiran', [AdminController::class, 'kehadiran'])->name('kehadiran');
Route::get('/detailpresensi', [AdminController::class, 'detailpresensi'])->name('detailpresensi');
Route::get('cetakpresensi', [AdminController::class, 'cetakpresensi'])->name('cetakpresensi');
Route::get('/kehadiran/cetak', [AdminController::class, 'Ckehadiran'])->name('cetak');
Route::get('/export-pdf', [AdminController::class, 'exportPdfWithImage'])->name('export.pdf');
// penggajian
Route::get('/penggajian', [AdminController::class, 'penggajian'])->name('penggajian');
Route::get('/validate-absen/{userId}', [AdminController::class, 'validateAbsen']);
Route::post('/cetakslip', [AdminController::class, 'slip'])->name('cetak.slip');
//
Route::get('/Admin/pengajuan', [AdminController::class, 'Apengajuan'])->name('admin.pengajuan');
Route::get('/Admin/pengajuan/delete/{id}', [AdminController::class, 'Dpengajuan'])->name('pengajuan.destroy');
Route::get('/pengajuan/approve/{id}', [AdminController::class, 'approve'])->name('pengajuan.approve');
Route::post('/pengajuan/ttd1/{id}', [AdminController::class, 'ttd1'])->name('post.ttd1');
Route::post('/pengajuan/ttd2/{id}', [AdminController::class, 'ttd2'])->name('post.ttd2');
Route::post('/pengajuan/ttd3/{id}', [AdminController::class, 'ttd3'])->name('post.ttd3');


// user
Route::get('/dashboardU', [UserController::class, 'index'])->name('dashboardU');
//user - ABSEN
Route::get('/dashboardU/absen', [UserController::class, 'absen'])->name('absen');
Route::post('/dashboardU/absen/upload', [UserController::class, 'upload']);
Route::get('/dashboardU/dataabsen', [UserController::class, 'dataabsen'])->name('dataabsen');
//user absen pulang
Route::get('/absenpulang/{id}', [UserController::class, 'absenp'])->name('absenp');
//profile
Route::get('/dashboardU/profile', [UserController::class, 'profile'])->name('profile');
Route::post('/dashboardU/absen/uploadP', [UserController::class, 'uploadP'])->name('uploadP');
Route::get('/editProfile/{id}', [UserController::class, 'editprofile'])->name('edit.profile');
Route::post('/updateProfile', [UserController::class, 'updateprofile'])->name('update.profile');
//password
Route::get('/resetUserPW/{id}', [UserController::class, 'resetPW'])->name('resetUserPW');
Route::post('/updatePW', [UserController::class, 'updatePW'])->name('updatePW');
//slip
Route::get('cetak/slip/anggota/{id}', [UserController::class, 'cetakslipA'])->name('cetakslip.anggota');
//pengajuan
Route::get('/dashboardU/pengajuan', [UserController::class, 'pengajuan'])->name('pengajuan');
Route::get('/dashboardU/pengajuan/create', [UserController::class, 'Cpengajuan'])->name('pengajuan.create');
Route::post('/dashboardU/pengajuan/store', [UserController::class, 'Spengajuan'])->name('pengajuan.store');
Route::get('/pengajuan/delete/{id}', [AdminController::class, 'Dpengajuan'])->name('pengajuan.destroyU');
