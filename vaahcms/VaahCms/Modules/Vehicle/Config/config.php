<?php

return [
    "name"=> "Vehicle",
    "title"=> "Vehicle Type And Details",
    "slug"=> "vehicle",
    "thumbnail"=> "https://img.site/p/300/160",
    "is_dev" => env('MODULE_VEHICLE_ENV')?true:false,
    "excerpt"=> "Vehicle system for management",
    "description"=> "Vehicle system for management",
    "download_link"=> "",
    "author_name"=> "vaah",
    "author_website"=> "https://vaah.dev",
    "version"=> "0.0.1",
    "is_migratable"=> true,
    "is_sample_data_available"=> true,
    "db_table_prefix"=> "vh_vehicle_",
    "providers"=> [
        "\\VaahCms\\Modules\\Vehicle\\Providers\\VehicleServiceProvider"
    ],
    "aside-menu-order"=> null
];
