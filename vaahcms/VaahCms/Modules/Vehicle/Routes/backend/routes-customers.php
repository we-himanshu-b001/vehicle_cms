<?php

use VaahCms\Modules\Vehicle\Http\Controllers\Backend\CustomersController;

Route::group(
    [
        'prefix' => 'backend/vehicle/customers',
        
        'middleware' => ['web', 'has.backend.access'],
        
],
function () {
    /**
     * Get Assets
     */
    Route::get('/assets', [CustomersController::class, 'getAssets'])
        ->name('vh.backend.vehicle.customers.assets');
    /**
     * Get List
     */
    Route::get('/', [CustomersController::class, 'getList'])
        ->name('vh.backend.vehicle.customers.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', [CustomersController::class, 'updateList'])
        ->name('vh.backend.vehicle.customers.list.update');
    /**
     * Delete List
     */
    Route::delete('/', [CustomersController::class, 'deleteList'])
        ->name('vh.backend.vehicle.customers.list.delete');


    /**
     * Fill Form Inputs
     */
    Route::any('/fill', [CustomersController::class, 'fillItem'])
        ->name('vh.backend.vehicle.customers.fill');

    /**
     * Create Item
     */
    Route::post('/', [CustomersController::class, 'createItem'])
        ->name('vh.backend.vehicle.customers.create');
    /**
     * Get Item
     */
    Route::get('/{id}', [CustomersController::class, 'getItem'])
        ->name('vh.backend.vehicle.customers.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', [CustomersController::class, 'updateItem'])
        ->name('vh.backend.vehicle.customers.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', [CustomersController::class, 'deleteItem'])
        ->name('vh.backend.vehicle.customers.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', [CustomersController::class, 'listAction'])
        ->name('vh.backend.vehicle.customers.list.actions');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', [CustomersController::class, 'itemAction'])
        ->name('vh.backend.vehicle.customers.item.action');

    //---------------------------------------------------------

});
