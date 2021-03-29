<?php

use \Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('menu-builder.route.prefix', 'menu-builder'),
    'as' => config('menu-builder.route.name_prefix', 'menu-builder.'),
    'middleware' => config('menu-builder.route.middleware', ['web'])],
    function ()
    {
    Route::get('/menus/{menu}/builder', [Hsnbd\MenuBuilder\Controllers\MenuBuilderController::class, 'builder'])->name('menus.builder');
    Route::post('/menus/{menu}/order', [Hsnbd\MenuBuilder\Controllers\MenuBuilderController::class, 'orderItem'])->name('menus.order');
    Route::post('/menus/export', [Hsnbd\MenuBuilder\Controllers\MenuBuilderController::class, 'exportAllMenu'])->name('menus.export');
    Route::post('/menus/import', [Hsnbd\MenuBuilder\Controllers\MenuBuilderController::class, 'importAllMenu'])->name('menus.import');

    Route::delete('/menus/{menu_id}/item/{id}', [Hsnbd\MenuBuilder\Controllers\MenuItemController::class, 'destroy'])->name('menus.item.destroy');
    Route::post('/menus/{menu}/item', [Hsnbd\MenuBuilder\Controllers\MenuItemController::class, 'store'])->name('menus.item.store');
    Route::put('/menus/{menu}/item', [Hsnbd\MenuBuilder\Controllers\MenuItemController::class, 'update'])->name('menus.item.update');

    Route::resource('/menus', Hsnbd\MenuBuilder\Controllers\MenuController::class)->except(['show']);

});
