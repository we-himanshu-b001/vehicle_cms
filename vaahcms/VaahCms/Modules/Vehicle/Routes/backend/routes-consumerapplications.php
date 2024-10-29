<?php

use VaahCms\Modules\Vehicle\Http\Controllers\Backend\ConsumerApplicationsController;

Route::group(
    [
        'prefix' => 'backend/vehicle/consumerapplications',
        
        'middleware' => ['web', 'has.backend.access'],
        
],
function () {
    /**
     * Get Assets
     */
    Route::get('/assets', [ConsumerApplicationsController::class, 'getAssets'])
        ->name('vh.backend.vehicle.consumerapplications.assets');
    /**
     * Get List
     */
    Route::get('/', [ConsumerApplicationsController::class, 'getList'])
        ->name('vh.backend.vehicle.consumerapplications.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', [ConsumerApplicationsController::class, 'updateList'])
        ->name('vh.backend.vehicle.consumerapplications.list.update');
    /**
     * Delete List
     */
    Route::delete('/', [ConsumerApplicationsController::class, 'deleteList'])
        ->name('vh.backend.vehicle.consumerapplications.list.delete');


    /**
     * Fill Form Inputs
     */
    Route::any('/fill', [ConsumerApplicationsController::class, 'fillItem'])
        ->name('vh.backend.vehicle.consumerapplications.fill');

    /**
     * Create Item
     */
    Route::post('/', [ConsumerApplicationsController::class, 'createItem'])
        ->name('vh.backend.vehicle.consumerapplications.create');
    /**
     * Get Item
     */
    Route::get('/{id}', [ConsumerApplicationsController::class, 'getItem'])
        ->name('vh.backend.vehicle.consumerapplications.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', [ConsumerApplicationsController::class, 'updateItem'])
        ->name('vh.backend.vehicle.consumerapplications.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', [ConsumerApplicationsController::class, 'deleteItem'])
        ->name('vh.backend.vehicle.consumerapplications.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', [ConsumerApplicationsController::class, 'listAction'])
        ->name('vh.backend.vehicle.consumerapplications.list.actions');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', [ConsumerApplicationsController::class, 'itemAction'])
        ->name('vh.backend.vehicle.consumerapplications.item.action');

    //---------------------------------------------------------

});
