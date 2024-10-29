<?php
use VaahCms\Modules\Vehicle\Http\Controllers\Backend\ConsumerApplicationsController;
/*
 * API url will be: <base-url>/public/api/vehicle/consumerapplications
 */
Route::group(
    [
        'prefix' => 'vehicle/consumerapplications',
        'namespace' => 'Backend',
    ],
function () {

    /**
     * Get Assets
     */
    Route::get('/assets', [ConsumerApplicationsController::class, 'getAssets'])
        ->name('vh.backend.vehicle.api.consumerapplications.assets');
    /**
     * Get List
     */
    Route::get('/', [ConsumerApplicationsController::class, 'getList'])
        ->name('vh.backend.vehicle.api.consumerapplications.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', [ConsumerApplicationsController::class, 'updateList'])
        ->name('vh.backend.vehicle.api.consumerapplications.list.update');
    /**
     * Delete List
     */
    Route::delete('/', [ConsumerApplicationsController::class, 'deleteList'])
        ->name('vh.backend.vehicle.api.consumerapplications.list.delete');


    /**
     * Create Item
     */
    Route::post('/', [ConsumerApplicationsController::class, 'createItem'])
        ->name('vh.backend.vehicle.api.consumerapplications.create');
    /**
     * Get Item
     */
    Route::get('/{id}', [ConsumerApplicationsController::class, 'getItem'])
        ->name('vh.backend.vehicle.api.consumerapplications.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', [ConsumerApplicationsController::class, 'updateItem'])
        ->name('vh.backend.vehicle.api.consumerapplications.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', [ConsumerApplicationsController::class, 'deleteItem'])
        ->name('vh.backend.vehicle.api.consumerapplications.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', [ConsumerApplicationsController::class, 'listAction'])
        ->name('vh.backend.vehicle.api.consumerapplications.list.action');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', [ConsumerApplicationsController::class, 'itemAction'])
        ->name('vh.backend.vehicle.api.consumerapplications.item.action');



});
