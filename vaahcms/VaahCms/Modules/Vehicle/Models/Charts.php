<?php namespace VaahCms\Modules\Vehicle\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Faker\Factory;
use WebReinvent\VaahCms\Models\VaahModel;
use WebReinvent\VaahCms\Traits\CrudWithUuidObservantTrait;
use WebReinvent\VaahCms\Models\User;
use WebReinvent\VaahCms\Libraries\VaahSeeder;
use Illuminate\Support\Facades\DB;

class Charts extends VaahModel
{

    public static function fetchCustomersCountData(Request $request)
    {
        // Extract dynamic parameters from the request
        $date_column = 'created_at'; // Default column
        $count = 'COUNT'; // Default count function
        $group_by_column = 'DATE_FORMAT(created_at, "%m")'; // Group by month

        // Start with the User query filtering by active customer roles
//        $list = User::whereHas('activeRoles', function ($query) {
//            $query->where('slug', 'customer');
//        });
//
//        // Applied filters
//        $filtered_data = self::appliedFilters($list, $request);
//
//        // Fetch data from the specified model
//        $chart_data = $filtered_data->selectRaw("$group_by_column as month")
//            ->selectRaw("$count($date_column) as total_count")
//            ->groupBy('month')
//            ->orderBy('month')
//            ->get();


        $chart_data = User::select(DB::raw("DATE_FORMAT($group_by_column, '%M') as month"), DB::raw("COUNT($date_column) as total_count"))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
//        dd($chart_data);

        // Prepare data for the chart
        $data = [
            ['name' => 'Customers', 'data' => array_fill(0, 12, 0)],
            ['name' => 'New Customers', 'data' => array_fill(0, 12, 0)]
        ];
        $labels = [];

        // Month names irrespective of year
        for ($month = 1; $month <= 12; $month++) {
            $labels[] = date('F', mktime(0, 0, 0, $month, 1));
        }

        // Dynamically assign data to total customers
        foreach ($chart_data as $item) {
//            $month_index = (int)$item->month - 1;
            foreach ($data as $key => $series) {
                $data[$key]['data'][(int)$item->month] = match ($key) {
                    0 => $item->total_count,
                    1 => $item->total_count - 5,
                };
            }

        }
//        dd($data);

        // Return the data and chart options
        return [
            'data' => [
                'chart_series' => $data,
            ],
            'chart_options' => [
                'chart' => [
                    'id' => 'dynamic-chart',
                    'background' => '#fff',
                    'toolbar' => ['show' => true],
                    'zoom' => ['enabled' => false],
                ],
                'xaxis' => [
                    'type' => 'category',
                    'categories' => $labels,
                ],
                'yaxis' => [
                    'title' => [
                        'text' => '',
                        'color' => '#008FFB',
                    ],
                ],
                'title' => [
                    'text' => 'Customers Count Bar Chart',
                    'align' => 'center',
                ],
                'legend' => [
                    'position' => 'top',
                    'horizontalAlign' => 'center',
                    'onItemClick' => [
                        'toggleDataSeries' => true,
                    ],
                ],

            ],
        ];
    }
    //-------------------------------------------------------------------------------------------------------
//    private static function appliedFilters($list, $request)
//    {
//        if (isset($request->filter)) {
//            $list = $list->isActiveFilter($request->filter);
//            $list = $list->dateRangeFilter($request->filter);
//            $list = $list->customerGroupFilter($request->filter);
//        }
//        return $list;
//    }


}
