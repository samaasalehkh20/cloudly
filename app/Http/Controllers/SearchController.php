<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if ( config('images') ) {
            foreach ( config('images') as $key => $value ) {
                if ( $key == $request->key ) {

//                    $current_time = Carbon::now();
//                    $after_min = $current_time->addMinute();
//
//                    if ( $current_time != $after_min ) {
//                        $count_of_request =+ 1;
//                    }elseif( $current_time != $after_min ) {
//                        $count_of_request = 0;
                    //}

                    $hit = config::get('images.hit');
                    $hit = $hit + 1;
                    config::set(['images.hit' => $hit]);

                    $fp = fopen(base_path() .'/config/images.php' , 'w');
                    fwrite($fp, '<?php return ' . var_export(config('images'), true) . ';');
                    fclose($fp);

                    return response()->json([
                        'status' => true,
                        'key' => $key,
                        'value' => $value,
                    ]);
                }
            }

            $miss = config::get('images.miss');
            $miss = $miss + 1;
            config::set(['images.miss' => $miss]);

            $fp = fopen(base_path() .'/config/images.php' , 'w');
            fwrite($fp, '<?php return ' . var_export(config('images'), true) . ';');
            fclose($fp);

            return response()->json([
                'status' => false,
                'data' => 'Key Not Found',
            ]);

        }else{
            return response()->json([
                'status' => false,
                'data' => 'No Data',
            ]);
        }
    }

    public function index()
    {
        return view('Dashboard.search.search');
    }
}
