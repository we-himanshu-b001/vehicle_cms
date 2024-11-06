
<?php
use VaahCms\Modules\Vehicle\Http\Controllers\Backend\ChartsController;

Route::group(
    [
        'prefix' => 'backend/vehicle/chart',
        'middleware' => ['web', 'has.backend.access'],
    ],
    function () {
        Route::get ('/charts/data', [ChartsController::class, 'fetchCustomersData']);
        Route::post ('/charts/data', [ChartsController::class, 'fetchCustomersCountData']);
    });

