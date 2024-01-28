<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('formulir-pendaftaran/(:segment)', 'User::formulir_pendaftaran/$1');
$routes->get('jalur/(:segment)', 'User::jalur/$1');
$routes->get('tahap/(:segment)', 'User::tahap/$1');
$routes->get('list-agenda/(:segment)', 'User::list_agenda/$1');
$routes->get('cek-data', 'User::cek_data');
$routes->post('cek-data-result', 'User::action');
$routes->get('pendaftaran-berhasil/(:segment)', 'User::pendaftaran_berhasil/$1');
$routes->post('dynamic_dependent/action', 'Dynamic_dependent::action');
$routes->post('dynamic_dependent/get', 'Dynamic_dependent::get');
$routes->post('add-zonasi/(:segment)', 'Formulir::add_zonasi/$1');
$routes->post('add-prestasi/(:segment)', 'Formulir::add_prestasi/$1');
$routes->post('add-test', 'Formulir::add_test');
$routes->get('test', 'Formulir::test');
$routes->get('login', 'User::login');
$routes->post('masuk', 'Login::process');
$routes->get('logout', 'Login::logout');



$routes->get('dashboard', 'Admin::dashboard', ['as' => 'dashboard']);
$routes->get('dashboard-siswa', 'Admin::dashboard_siswa');
$routes->get('pilih-tahap/(:segment)', 'Admin::pilih_tahap/$1');
$routes->get('data-pendaftar/(:segment)', 'Admin::data_pendaftar/$1');
$routes->get('export/(:segment)', 'Worksheet::export/$1');
$routes->get('export-accepted/(:segment)', 'Worksheet::export_diterima/$1');
$routes->post('import/(:segment)', 'Worksheet::import/$1');
$routes->post('delete-pendaftar/(:segment)', 'Pendaftar::delete_pendaftar/$1');
$routes->post('status-penerimaan/(:segment)', 'Pendaftar::status_penerimaan/$1');
$routes->get('data-siswa', 'Admin::data_siswa');
$routes->get('edit-siswa', 'Admin::edit_siswa');
$routes->get('profil-siswa/(:segment)', 'Pendaftar::edit_profil/$1');
$routes->get('registrasi-ulang/(:segment)', 'Pendaftar::edit_ulang_profil/$1');
$routes->get('profil-pendaftar', 'Admin::profil_pendaftar');

$routes->get('kategori-kode', 'Admin::kategori_kode'); 
$routes->get('edit-kategori/(:segment)', 'Opsi::edit_kategori/$1');
$routes->post('add-kategori', 'Opsi::add_kategori');
$routes->post('update-kategori/(:segment)', 'Opsi::update_kategori/$1');
$routes->post('add-opsi/(:segment)', 'Opsi::add_opsi/$1');
$routes->post('update-opsi/(:segment)', 'Opsi::update_opsi/$1');
$routes->post('delete-opsi/(:segment)', 'Opsi::delete_opsi/$1');

$routes->get('data-periode', 'Admin::periode', ['as' => 'data-periode']);
$routes->post('add-periode', 'TahapSeleksi::add_periode', ['as' => 'add-periode']);
$routes->post('update-periode/(:segment)', 'TahapSeleksi::update_periode/$1', ['as' => 'update-periode']);
$routes->post('delete-periode/(:segment)', 'TahapSeleksi::delete_periode/$1', ['as' => 'delete-periode']);

$routes->get('data-sekolah', 'Admin::datasekolah');
$routes->post('update-sekolah/(:segment)', 'Admin::update_sekolah/$1');
$routes->post('delete-sekolah/(:segment)', 'Admin::delete_sekolah/$1');
$routes->post('import', 'WorksheetSekolah::import');

$routes->get('data-tahap', 'Admin::tahap', ['as' => 'data-tahap']);
$routes->post('add-tahap', 'TahapSeleksi::add_tahap', ['as' => 'add-tahap']);
$routes->post('update-tahap/(:segment)', 'TahapSeleksi::update_tahap/$1', ['as' => 'update-tahap']);
$routes->post('delete-tahap/(:segment)', 'TahapSeleksi::delete_tahap/$1', ['as' => 'delete-tahap']);

$routes->get('data-jalur', 'Admin::jalur', ['as' => 'data-jalur']);
$routes->post('add-jalur', 'TahapSeleksi::add_jalur', ['as' => 'add-jalur']);
$routes->post('update-jalur/(:segment)', 'TahapSeleksi::update_jalur/$1', ['as' => 'update-jalur']);
$routes->post('delete-jalur/(:segment)', 'TahapSeleksi::delete_jalur/$1', ['as' => 'delete-jalur']);

$routes->get('data-akun', 'Admin::akun');
$routes->post('add-akun', 'Akun::add_akun');
$routes->post('update-akun/(:segment)', 'Akun::update_akun/$1');
$routes->post('delete-akun/(:segment)', 'Akun::delete_akun/$1');

$routes->get('data-pembayaran', 'Admin::data_pembayaran');
$routes->post('add-konfirmasi', 'Pembayaran::add_konfirmasi');

$routes->post('add-konfirmasi-siswa', 'Pembayaran::add_konfirmasi_siswa');
$routes->get('konfirmasi-pembayaran/(:segment)', 'Midtrans::konfirmasi_pembayaran/$1');
$routes->post('/midtrans/token', 'Midtrans::token');

$routes->get('pembayaran-selesai', 'Admin::pembayaran_selesai');



$routes->post('delete-pembayaran/(:segment)', 'Pembayaran::delete_pembayaran/$1');
$routes->post('update-konfirmasi/(:segment)', 'Pembayaran::update_konfirmasi/$1');

$routes->post('status-pembayaran/(:segment)/(:segment)', 'Pembayaran::status_pembayaran/$1/$2');

$routes->get('data-jurusan', 'Admin::data_jurusan');
$routes->post('add-jurusan', 'Jurusan::add_jurusan');
$routes->post('update-jurusan/(:segment)', 'Jurusan::update_jurusan/$1');
$routes->post('delete-jurusan/(:segment)', 'Jurusan::delete_jurusan/$1');

$routes->get('data-agenda', 'Admin::data_agenda');
$routes->post('add-agenda', 'Agenda::add_agenda');
$routes->post('update-agenda/(:segment)', 'Agenda::update_agenda/$1');
$routes->post('delete-agenda/(:segment)', 'Agenda::delete_agenda/$1');
$routes->post('update-zonasi/(:segment)', 'Pendaftar::update_zonasi/$1');
$routes->post('update-profil/(:segment)', 'Pendaftar::update_profil/$1');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
