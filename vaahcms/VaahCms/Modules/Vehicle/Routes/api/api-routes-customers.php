<?php
use VaahCms\Modules\Vehicle\Http\Controllers\Backend\CustomersController;
/*
 * API url will be: <base-url>/public/api/vehicle/customers
 */
Route::group(
    [
        'prefix' => 'vehicle/customers',
        'namespace' => 'Backend',
    ],
function () {

    /**
     * Get Assets
     */
    Route::get('/assets', [CustomersController::class, 'getAssets'])
        ->name('vh.backend.vehicle.api.customers.assets');
    /**
     * Get List
     */
    Route::get('/', [CustomersController::class, 'getList'])
        ->name('vh.backend.vehicle.api.customers.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', [CustomersController::class, 'updateList'])
        ->name('vh.backend.vehicle.api.customers.list.update');
    /**
     * Delete List
     */
    Route::delete('/', [CustomersController::class, 'deleteList'])
        ->name('vh.backend.vehicle.api.customers.list.delete');


    /**
     * Create Item
     */
    Route::post('/', [CustomersController::class, 'createItem'])
        ->name('vh.backend.vehicle.api.customers.create');
    /**
     * Get Item
     */
    Route::get('/{id}', [CustomersController::class, 'getItem'])
        ->name('vh.backend.vehicle.api.customers.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', [CustomersController::class, 'updateItem'])
        ->name('vh.backend.vehicle.api.customers.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', [CustomersController::class, 'deleteItem'])
        ->name('vh.backend.vehicle.api.customers.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', [CustomersController::class, 'listAction'])
        ->name('vh.backend.vehicle.api.customers.list.action');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', [CustomersController::class, 'itemAction'])
        ->name('vh.backend.vehicle.api.customers.item.action');



});
