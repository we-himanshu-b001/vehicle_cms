<?php namespace VaahCms\Modules\Vehicle\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use VaahCms\Modules\Vehicle\Models\Charts;
use VaahCms\Modules\Vehicle\Models\ConsumerApplication;
use VaahCms\Modules\Vehicle\Models\Customer;
use VaahCms\Modules\Vehicle\Models\Vehicle;
use WebReinvent\VaahCms\Models\Taxonomy;


class ChartsController extends Controller
{


    //----------------------------------------------------------
    public function __construct()
    {

    }

    public function fetchCustomersData(Request $request){
        return Charts::fetchCustomersCountData($request);
    }


    public function fetchCustomersCountData(Request $request)
    {
        try{
            return Charts::fetchCustomersCountData($request);
        }catch (\Exception $e){
            $response = [];
            $response['success'] = false;
            if(env('APP_DEBUG')){
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else{
                $response['errors'][] = trans("vaahcms-general.something_went_wrong");
            }
            return $response;
        }
    }


}
