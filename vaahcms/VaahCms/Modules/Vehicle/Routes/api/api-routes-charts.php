
<?php
use VaahCms\Modules\Vehicle\Http\Controllers\Backend\ChartsController;

Route::group(
    [
        'prefix' => 'vehicle/chart',
        'namespace' => 'Backend',
    ],
    function () {
        Route::post ('/charts/data', [ChartsController::class, 'fetchCustomersCountData']);
        Route::get ('/charts/data', [ChartsController::class, 'fetchCustomersData']);
    });

