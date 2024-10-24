<?php

use VaahCms\Modules\Vehicle\Http\Controllers\Backend\VehiclesController;

Route::group(
    [
        'prefix' => 'backend/vehicle/vehicles',
        
        'middleware' => ['web', 'has.backend.access'],
        
],
function () {
    /**
     * Get Assets
     */
    Route::get('/assets', [VehiclesController::class, 'getAssets'])
        ->name('vh.backend.vehicle.vehicles.assets');
    /**
     * Get List
     */
    Route::get('/', [VehiclesController::class, 'getList'])
        ->name('vh.backend.vehicle.vehicles.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', [VehiclesController::class, 'updateList'])
        ->name('vh.backend.vehicle.vehicles.list.update');
    /**
     * Delete List
     */
    Route::delete('/', [VehiclesController::class, 'deleteList'])
        ->name('vh.backend.vehicle.vehicles.list.delete');


    /**
     * Fill Form Inputs
     */
    Route::any('/fill', [VehiclesController::class, 'fillItem'])
        ->name('vh.backend.vehicle.vehicles.fill');

    /**
     * Create Item
     */
    Route::post('/', [VehiclesController::class, 'createItem'])
        ->name('vh.backend.vehicle.vehicles.create');
    /**
     * Get Item
     */
    Route::get('/{id}', [VehiclesController::class, 'getItem'])
        ->name('vh.backend.vehicle.vehicles.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', [VehiclesController::class, 'updateItem'])
        ->name('vh.backend.vehicle.vehicles.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', [VehiclesController::class, 'deleteItem'])
        ->name('vh.backend.vehicle.vehicles.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', [VehiclesController::class, 'listAction'])
        ->name('vh.backend.vehicle.vehicles.list.actions');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', [VehiclesController::class, 'itemAction'])
        ->name('vh.backend.vehicle.vehicles.item.action');

    //---------------------------------------------------------

});
