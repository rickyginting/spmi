<?php

use App\Jenjang;
use App\Prodi;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

//Auth
Route::get('login', 'AuthController@index')->name('login');
Route::post('proses', 'AuthController@proses');
Route::post('logout', 'AuthController@logout')->name('logout');

//HOME
Route::get('/', 'HomeController@index')->name('home');

Route::get('tabel/{prodi:kode}', 'HomeController@tabel');
Route::get('tabel/berkas/{element}', 'HomeController@berkas');
Route::get('tabel/view/{berkas}', 'HomeController@view');

Route::get('single-search', 'HomeController@singleSearch')->name('singleSearch');
Route::post('single-search/hasil', 'HomeController@hasilsingleSearch');

Route::get('multiple-search', 'HomeController@multiSearch')->name('multipleSearch');
Route::post('multi-search/hasil', 'HomeController@hasilmultiSearch');

Route::get('diagram', 'HomeController@diagram')->name('diagram');
Route::get('diagram/login', function () {
    return redirect()->route('login');
});
Route::get('diagram/{prodi:kode}', 'HomeController@radarDiagram');

Route::middleware(['auth', 'cekRole:Admin,Ketua LPM,Ketua Program Studi,Dosen,UPPS,Mahasiswa,Alumni'])->group(function () {
//GET PRODI AND JENJANG
    $j = Jenjang::get();
    $p = Prodi::get();

//DASHBOARD
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

//Jenjang
    foreach ($j as $jenjang) {
        Route::get('kriteria/' . $jenjang->kode, 'KriteriaController@index')->name($jenjang->kode);
    }

//Prodi
    foreach ($p as $prodi) {
        Route::get('prodi/' . $prodi->kode, 'ProdiController@index')->name($prodi->kode);
        Route::get('prodi/{prodi:kode}/{any}', 'ProdiController@butir');
    }

//C1
    Route::post('kriteria/store', 'KriteriaController@store');
    Route::delete('kriteria/hapus/{l1}', 'KriteriaController@hapus');
    Route::put('kriteria/put/{l1}', 'KriteriaController@put');

//C1.x
    foreach ($j as $jenjang) {
        Route::get('sub-kriteria/l2/' . $jenjang->kode, 'Level2Controller@sort');
    }
    Route::get('sub-kriteria/l2', 'Level2Controller@index')->name('level2');
    Route::post('sub-kriteria/l2/post', 'Level2Controller@store');
    Route::delete('sub-kriteria/l2/hapus/{l2}', 'Level2Controller@hapus');
    Route::put('sub-kriteria/l2/put/{l2}', 'Level2Controller@put');

//C1.x.x
    foreach ($j as $jenjang) {
        Route::get('sub-kriteria/l3/' . $jenjang->kode, 'Level3Controller@sort');
    }
    Route::get('sub-kriteria/l3', 'Level3Controller@index')->name('level3');
    Route::post('sub-kriteria/l3/post', 'Level3Controller@store');
    Route::delete('sub-kriteria/l3/hapus/{l3}', 'Level3Controller@hapus');
    Route::put('sub-kriteria/l3/put/{l3}', 'Level3Controller@put');

//C1.x.x
    foreach ($j as $jenjang) {
        Route::get('sub-kriteria/l4/' . $jenjang->kode, 'Level4Controller@sort');
    }
    Route::get('sub-kriteria/l4', 'Level4Controller@index')->name('level4');
    Route::post('sub-kriteria/l4/post', 'Level4Controller@store');
    Route::delete('sub-kriteria/l4/hapus/{l4}', 'Level4Controller@hapus');
    Route::put('sub-kriteria/l4/put/{l4}', 'Level4Controller@put');

//Indikator
    foreach ($j as $jenjang) {
        Route::get('indikator/' . $jenjang->kode, 'IndikatorController@index')->name('indikator-' . $jenjang->kode);
    }
    Route::post('indikator/store', 'IndikatorController@store');
    Route::get('indikator/input-score/{indikator}', 'IndikatorController@inputScore');
    Route::post('indikator/store-score', 'IndikatorController@storeScore');
    Route::get('indikator/cek-score/{indikator}', 'IndikatorController@cekScore');

    Route::get('indikator/konfirmasi/{indikator}', 'IndikatorController@konfirmasi');
    Route::delete('indikator/hapus/{indikator}', 'IndikatorController@hapusIndikator');
    Route::get('indikator/edit/{indikator}', 'IndikatorController@editFormIndikator');
    Route::put('indikator/put/{indikator}', 'IndikatorController@putIndikator');

    Route::get('indikator/konfrimasi-score/{score}', 'IndikatorController@konfirmasiScore');
    Route::delete('indikator/score-hapus/{score}', 'IndikatorController@hapusScore');
    Route::get('indikator/score/edit/{score}', 'IndikatorController@editScore');
    Route::put('indikator/score/put/{score}', 'IndikatorController@putScore');

//Element
    foreach ($p as $prodi) {
        Route::get('element/' . $prodi->kode, 'ElementController@index')->name('element-' . $prodi->kode);
    }
    Route::get('element/tambah', 'ElementController@tambahElement')->name('tambah-element');
    Route::post('element/store', 'ElementController@store');

    Route::get('element/unggah-berkas/{element}', 'ElementController@unggahBerkas');
    Route::post('element/store-berkas', 'ElementController@storeBerkas');
    Route::get('element/lihat-berkas/{element}', 'ElementController@lihatBerkas');

    Route::get('element/syarat-akreditasi/{element}', 'ElementController@akreditas');
    Route::put('element/put-akreditasi/{element}', 'ElementController@putAkreditas');

    Route::get('element/syarat-unggul/{element}', 'ElementController@unggul');
    Route::put('element/put-unggul/{element}', 'ElementController@putUnggul');

    Route::get('element/syarat-baik/{element}', 'ElementController@baik');
    Route::put('element/put-baik/{element}', 'ElementController@putBaik');

    Route::delete('element/reset/{element}', 'ElementController@resetData');
    Route::get('element/konfirmasi/{element}', 'ElementController@konfirHapus');
    Route::delete('element/delete/{element}', 'ElementController@delete');

    Route::get('element/detail/{element}', 'ElementController@detailElement');
    Route::put('element/bobot/put/{element}', 'ElementController@putBobot');

//DATA BERKAS
    Route::get('berkas/cari', 'BerkasController@cari')->name('berkas');
    Route::post('berkas/hasil', 'BerkasController@hasil');
    Route::get('berkas/{berkas}', 'BerkasController@detail');

    Route::delete('berkas/hapus/{berkas}', 'BerkasController@hapus');
    Route::get('berkas/edit/{berkas}', 'BerkasController@edit');
    Route::put('berkas/put/{berkas}', 'BerkasController@put');

//Pengaturan
    Route::get('jenjang-pendidkan', 'PengaturanController@jenjang')->name('jenjang');
    Route::post('jenjang-pendidikan/post', 'PengaturanController@jenjangPost');
    Route::delete('jenjang-pendidikan/hapus/{jenjang}', 'PengaturanController@jenjangDelete');
    Route::put('jenjang-pendidikan/put/{jenjang}', 'PengaturanController@jenjangPut');

    Route::get('program-studi', 'PengaturanController@prodi')->name('prodi');
    Route::post('program-studi/post', 'PengaturanController@prodiPost');
    Route::delete('program-studi/hapus/{prodi}', 'PengaturanController@prodiDelete');
    Route::put('program-studi/put/{prodi}', 'PengaturanController@prodiPut');

//DATA USER
    Route::get('users', 'AdminController@index')->name('users');
    Route::get('users/tambah/admin', 'AdminController@tambahAdmin')->name('tambah-admin');
    Route::get('users/tambah/ketua-lpm', 'AdminController@tambahLpm')->name('tambah-lpm');
    Route::get('users/tambah/ketua-program-studi', 'AdminController@tambahKaprodi')->name('tambah-kaprodi');
    Route::get('users/tambah/dosen', 'AdminController@tambahDosen')->name('tambah-dosen');
    Route::get('users/tambah/upps', 'AdminController@tambahUpps')->name('tambah-upps');
    Route::get('users/tambah/mahasiswa-alumni', 'AdminController@tambahMhsAlm')->name('tambah-mhsalm');
    Route::post('users/store', 'AdminController@store');
    Route::delete('users/hapus/{user}', 'AdminController@hapus');
    Route::get('users/edit/{user}', 'AdminController@edit');
    Route::put('users/put/{user}', 'AdminController@put');

//DATA TARGET PENCAPAIAN
    Route::get('target', 'TargetController@index')->name('target');
    Route::get('target/{prodi:kode}', 'TargetController@detail');
    Route::get('target/create-target/{prodi:kode}', 'TargetController@createTarget');
    Route::put('target/update/{target}', 'TargetController@update');

//DATA MAHASISWA
    Route::get('data/mahasiswa/{prodi:kode}', 'MahasiswaController@index');
    Route::get('data/mahasiswa/tambah/{prodi:kode}', 'MahasiswaController@tambah');
    Route::post('data/mahasiswa/store', 'MahasiswaController@store');

});

//Dropdown Ajax [Buat Element, Cari Berkas]
Route::post('dropdownlist/getJen', 'dropdownController@getJen')->name('getJen');
Route::post('dropdownlist/getPro', 'dropdownController@getPro')->name('getPro');
Route::post('dropdownlist/getIndikator', 'dropdownController@getIndikator')->name('getInd');
Route::post('dropdownlist/getScore', 'dropdownController@getScore')->name('getScore');
Route::post('dropdownlist/getl1', 'dropdownController@getL1')->name('l1');
Route::post('dropdownlist/getl2', 'dropdownController@getL2')->name('l2');
Route::post('dropdownlist/getl3', 'dropdownController@getL3')->name('l3');
Route::post('dropdownlist/getl4', 'dropdownController@getL4')->name('l4');

//NO MULTIPLE SAAT EDIT BERKAS
Route::post('dropdownlist/getl1ne', 'dropdownController@getL1ne')->name('l1ne');
Route::post('dropdownlist/getl2ne', 'dropdownController@getL2ne')->name('l2ne');
Route::post('dropdownlist/getl3ne', 'dropdownController@getL3ne')->name('l3ne');
Route::post('dropdownlist/getl4ne', 'dropdownController@getL4ne')->name('l4ne');

//NO MULTIPLE [Sub Butir L2 - L4]
Route::post('dropdownlist/getjn', 'dropdownController@getjn')->name('jn');
Route::post('dropdownlist/getl1n', 'dropdownController@getL1n')->name('l1n');
Route::post('dropdownlist/getl2n', 'dropdownController@getL2n')->name('l2n');
Route::post('dropdownlist/getl3n', 'dropdownController@getL3n')->name('l3n');
Route::post('dropdownlist/getl4n', 'dropdownController@getL4n')->name('l4n');

//NO MULTIPLE SAAT EDIT LEVEL [Sub Butir L2 - L4]
Route::post('dropdownlist/getjnu', 'dropdownController@getjnu')->name('jnu');
Route::post('dropdownlist/getl1nu', 'dropdownController@getL1nu')->name('l1nu');
Route::post('dropdownlist/getl2nu', 'dropdownController@getL2nu')->name('l2nu');
Route::post('dropdownlist/getl3nu', 'dropdownController@getL3nu')->name('l3nu');
Route::post('dropdownlist/getl4nu', 'dropdownController@getL4nu')->name('l4nu');
