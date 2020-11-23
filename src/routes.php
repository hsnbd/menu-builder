<?php

use \Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('menu-builder.route.prefix', 'menu-builder'),
    'as' => config('menu-builder.route.name_prefix', 'menu-builder.'),
    'middleware' => config('menu-builder.route.middleware', ['web'])],
    function ()
    {
    Route::get('/menus/{menu}/builder', [Softbd\MenuBuilder\Controllers\MenuBuilderController::class, 'builder'])->name('menus.builder');
    Route::post('/menus/{menu}/order', [Softbd\MenuBuilder\Controllers\MenuBuilderController::class, 'order_item'])->name('menus.order');

    Route::delete('/menus/{menu_id}/item/{id}', [Softbd\MenuBuilder\Controllers\MenuBuilderController::class, 'delete_menu'])->name('menus.item.destroy');
    Route::post('/menus/{menu}/item', [Softbd\MenuBuilder\Controllers\MenuBuilderController::class, 'add_item'])->name('menus.item.add');
    Route::put('/menus/{menu}/item', [Softbd\MenuBuilder\Controllers\MenuBuilderController::class, 'update_item'])->name('menus.item.update');

    Route::resource('/menus', Softbd\MenuBuilder\Controllers\MenuBuilderController::class);
});
