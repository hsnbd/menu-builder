<?php
use \Illuminate\Support\Facades\Route;


//Route::get('/menu', [Softbd\MenuBuilder\Controllers\MenuBuilderController::class, 'index'])->name('menu.index');
//Route::get('/menu/create', [Softbd\MenuBuilder\Controllers\MenuBuilderController::class, 'create'])->name('menu.create');
//Route::post('/menu', [Softbd\MenuBuilder\Controllers\MenuBuilderController::class, 'store'])->name('menu.store');

Route::resource('/menu', Softbd\MenuBuilder\Controllers\MenuBuilderController::class);

Route::get('/menu-builder', [Softbd\MenuBuilder\Controllers\MenuBuilderController::class, 'menuBuilder'])->name('menu-builder.index');
