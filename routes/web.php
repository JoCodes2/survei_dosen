<?php

use App\Http\Controllers\CMS\DosenController;
use App\Http\Controllers\CMS\KriteriaController;
use App\Http\Controllers\CMS\ProgramstudiController;
use App\Http\Controllers\CMS\SemesterController;
use App\Http\Controllers\CMS\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
});

Route::get('/user', function () {
    return view('admin.user');
});

Route::get('/dosen', function () {
    return view('admin.dosen');
});

Route::get('/kriteria', function () {
    return view('admin.kriteria');
});

Route::get('/programstudi', function () {
    return view('admin.programstudi');
});

Route::get('/semester', function () {
    return view('admin.semester');
});

Route::prefix('survei')->group(function () {

    Route::prefix('user')->controller(UserController::class)->group(function () {
        Route::get('/', 'getAllData');
        Route::post('/create', 'createData');
        Route::get('/get/{id}', 'getDataById');
        Route::post('/update/{id}', 'updateData');
        Route::delete('/delete/{id}', 'deleteData');
    });

    Route::prefix('programstudi')->controller(ProgramstudiController::class)->group(function () {
        Route::get('/', 'getAllData');
        Route::post('/create', 'createData');
        Route::get('/get/{id}', 'getDataById');
        Route::post('/update/{id}', 'updateData');
        Route::delete('/delete/{id}', 'deleteData');
    });

    Route::prefix('kriteria')->controller(KriteriaController::class)->group(function () {
        Route::get('/', 'getAllData');
        Route::post('/create', 'createData');
        Route::get('/get/{id}', 'getDataById');
        Route::post('/update/{id}', 'updateData');
        Route::delete('/delete/{id}', 'deleteData');
    });

    Route::prefix('semester')->controller(SemesterController::class)->group(function () {
        Route::get('/', 'getAllData');
        Route::post('/create', 'createData');
        Route::get('/get/{id}', 'getDataById');
        Route::post('/update/{id}', 'updateData');
        Route::delete('/delete/{id}', 'deleteData');
    });

    Route::prefix('dosen')->controller(DosenController::class)->group(function () {
        Route::get('/', 'getAllData');
        Route::post('/create', 'createData');
        Route::get('/get/{id}', 'getDataById');
        Route::post('/update/{id}', 'updateData');
        Route::delete('/delete/{id}', 'deleteData');
    });
});
