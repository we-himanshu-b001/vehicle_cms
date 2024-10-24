<?php
use VaahCms\Modules\Vehicle\Http\Controllers\Backend\VehiclesController;
/*
 * API url will be: <base-url>/public/api/vehicle/vehicles
 */
Route::group(
    [
        'prefix' => 'vehicle/vehicles',
        'namespace' => 'Backend',
    ],
function () {

    /**
     * Get Assets
     */
    Route::get('/assets', [VehiclesController::class, 'getAssets'])
        ->name('vh.backend.vehicle.api.vehicles.assets');
    /**
     * Get List
     */
    Route::get('/', [VehiclesController::class, 'getList'])
        ->name('vh.backend.vehicle.api.vehicles.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', [VehiclesController::class, 'updateList'])
        ->name('vh.backend.vehicle.api.vehicles.list.update');
    /**
     * Delete List
     */
    Route::delete('/', [VehiclesController::class, 'deleteList'])
        ->name('vh.backend.vehicle.api.vehicles.list.delete');


    /**
     * Create Item
     */
    Route::post('/', [VehiclesController::class, 'createItem'])
        ->name('vh.backend.vehicle.api.vehicles.create');
    /**
     * Get Item
     */
    Route::get('/{id}', [VehiclesController::class, 'getItem'])
        ->name('vh.backend.vehicle.api.vehicles.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', [VehiclesController::class, 'updateItem'])
        ->name('vh.backend.vehicle.api.vehicles.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', [VehiclesController::class, 'deleteItem'])
        ->name('vh.backend.vehicle.api.vehicles.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', [VehiclesController::class, 'listAction'])
        ->name('vh.backend.vehicle.api.vehicles.list.action');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', [VehiclesController::class, 'itemAction'])
        ->name('vh.backend.vehicle.api.vehicles.item.action');



});
