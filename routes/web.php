<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\MasterUserController;
use App\Http\Controllers\MasterProkerController;
use App\Http\Controllers\UserKegiatanController;
use App\Http\Controllers\MasterAnggaranController;
use App\Http\Controllers\MasterKegiatanController;

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

Route::group(['middleware' => 'isAuth'], function () {
    Route::get('/', [GeneralController::class, 'login'])->name('general.index');
    Route::get('/login', [GeneralController::class, 'login'])->name('general.login');
    Route::post('/login', [GeneralController::class, 'aksi_login'])->name('general.aksi.login');
});
Route::get('/logout', [GeneralController::class, 'aksi_logout'])->name('general.aksi.logout');

//  URL : /staff
Route::group(['prefix' => 'staff', 'middleware' => 'isStaff'], function () {
    //  URL : /staff/index
    Route::get('/', [StaffController::class, 'index'])->name('staff.index');

    //  URL : /staff/profile
    Route::get('/profile', [StaffController::class, 'profile'])->name('staff.profile');
    //  URL : /staff/profile
    Route::post('/profile', [StaffController::class, 'aksi_update_profile'])->name('staff.profile.aksi.update');

    /**
     * Master Data
     */
    Route::group(['prefix' => 'master'], function () {
        /**
         * Akun User
         */
        Route::group(['prefix' => 'user'], function () {
            //  URL : /staff/master/user/index
            Route::get('/', [MasterUserController::class, 'index_user'])->name('master.user.index');
            //  URL : /staff/master/user/add
            Route::get('/add', [MasterUserController::class, 'add_user'])->name('master.user.add');
            //  URL : /staff/master/user/edit
            Route::get('/edit/{user_id}', [MasterUserController::class, 'edit_user'])->name('master.user.edit');
            //  URL : /staff/master/user/add
            Route::post('/add', [MasterUserController::class, 'aksi_add_user'])->name('master.user.aksi.add');
            //  URL : /staff/master/user/edit
            Route::post('/edit', [MasterUserController::class, 'aksi_edit_user'])->name('master.user.aksi.edit');
            //  URL : /staff/master/user/delete
            Route::post('/delete', [MasterUserController::class, 'aksi_delete_user'])->name('master.user.aksi.delete');
        });
        /**
         * Proker
         */
        Route::group(['prefix' => 'proker'], function () {
            //  URL : /staff/master/proker/index
            Route::get('/', [MasterProkerController::class, 'index_proker'])->name('master.proker.index');
            //  URL : /staff/master/proker/add
            Route::get('/add', [MasterProkerController::class, 'add_proker'])->name('master.proker.add');
            //  URL : /staff/master/proker/edit
            Route::get('/edit/{proker_id}', [MasterProkerController::class, 'edit_proker'])->name('master.proker.edit');
            //  URL : /staff/master/proker/add
            Route::post('/add', [MasterProkerController::class, 'aksi_add_proker'])->name('master.proker.aksi.add');
            //  URL : /staff/master/proker/edit
            Route::post('/edit', [MasterProkerController::class, 'aksi_edit_proker'])->name('master.proker.aksi.edit');
            //  URL : /staff/master/proker/delete
            Route::post('/delete', [MasterProkerController::class, 'aksi_delete_proker'])->name('master.proker.aksi.delete');
        });
        /**
         * Tahun Anggaran
         */
        Route::group(['prefix' => 'anggaran'], function () {
            //  URL : /staff/master/anggaran/index
            Route::get('/', [MasterAnggaranController::class, 'index_anggaran'])->name('master.anggaran.index');
            //  URL : /staff/master/anggaran/add
            Route::get('/add', [MasterAnggaranController::class, 'add_anggaran'])->name('master.anggaran.add');
            //  URL : /staff/master/anggaran/edit
            Route::get('/edit/{anggaran_id}', [MasterAnggaranController::class, 'edit_anggaran'])->name('master.anggaran.edit');
            //  URL : /staff/master/anggaran/add
            Route::post('/add', [MasterAnggaranController::class, 'aksi_add_anggaran'])->name('master.anggaran.aksi.add');
            //  URL : /staff/master/anggaran/edit
            Route::post('/edit', [MasterAnggaranController::class, 'aksi_edit_anggaran'])->name('master.anggaran.aksi.edit');
            //  URL : /staff/master/anggaran/delete
            Route::post('/delete', [MasterAnggaranController::class, 'aksi_delete_anggaran'])->name('master.anggaran.aksi.delete');
            //  URL : /staff/master/anggaran/proker/edit
            Route::post('/proker/edit', [MasterAnggaranController::class, 'aksi_edit_anggaran_proker'])->name('master.anggaran.proker.aksi.edit');
        });
    });
    
    /**
     * Kegiatan
     */
    Route::group(['prefix' => 'kegiatan'], function () {
        //  URL : /staff/kegiatan/index
        Route::get('/', [MasterKegiatanController::class, 'index_kegiatan'])->name('master.kegiatan.index');
        //  URL : /staff/kegiatan/add
        Route::get('/add', [MasterKegiatanController::class, 'add_kegiatan'])->name('master.kegiatan.add');
        //  URL : /staff/kegiatan/edit
        Route::get('/edit/{kegiatan_id}', [MasterKegiatanController::class, 'edit_kegiatan'])->name('master.kegiatan.edit');
        //  URL : /staff/kegiatan/edit
        Route::get('/view/{kegiatan_id}', [MasterKegiatanController::class, 'view_kegiatan'])->name('master.kegiatan.view');
        //  URL : /staff/kegiatan/edit
        Route::get('/filter/{proker_id}', [MasterKegiatanController::class, 'filter_kegiatan'])->name('master.kegiatan.filter');
        //  URL : /staff/kegiatan/add
        Route::post('/add', [MasterKegiatanController::class, 'aksi_add_kegiatan'])->name('master.kegiatan.aksi.add');
        //  URL : /staff/kegiatan/edit
        Route::post('/edit', [MasterKegiatanController::class, 'aksi_edit_kegiatan'])->name('master.kegiatan.aksi.edit');
        //  URL : /staff/kegiatan/delete
        Route::post('/delete', [MasterKegiatanController::class, 'aksi_delete_kegiatan'])->name('master.kegiatan.aksi.delete');
        //  URL : /staff/kegiatan/print
        Route::get('/print', [MasterKegiatanController::class, 'print_kegiatan'])->name('master.kegiatan.print');
    });
});

//  URL : /user
Route::group(['prefix' => 'user', 'middleware' => 'isUser'], function () {
    //  URL : /user/index
    Route::get('/', [UserController::class, 'index'])->name('user.index');

    //  URL : /user/profile
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    //  URL : /user/profile
    Route::post('/profile', [UserController::class, 'aksi_update_profile'])->name('user.profile.aksi.update');

    /**
     * Kegiatan
     */
    Route::group(['prefix' => 'kegiatan'], function () {
        //  URL : /user/kegiatan/index
        Route::get('/', [UserKegiatanController::class, 'index_kegiatan'])->name('user.kegiatan.index');
        //  URL : /user/kegiatan/view
        Route::get('/view/{kegiatan_id}', [UserKegiatanController::class, 'view_kegiatan'])->name('user.kegiatan.view');
        //  URL : /user/kegiatan/edit
        Route::get('/view-filter/{kegiatan_id}', [UserKegiatanController::class, 'view_filter_kegiatan'])->name('user.kegiatan.view.filter');
        //  URL : /user/kegiatan/edit
        Route::get('/filter/{proker_id}', [UserKegiatanController::class, 'filter_kegiatan'])->name('user.kegiatan.filter');
        //  URL : /staff/kegiatan/print
        Route::get('/print', [UserKegiatanController::class, 'print_kegiatan'])->name('user.kegiatan.print');
    });
});
