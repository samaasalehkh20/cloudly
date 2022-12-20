<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AllKeysController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
//        $images = [];
//        $keys = config('images');
//
//        if( $keys ) {
//            foreach ( $keys as $key => $value ) {
//                if( $key != "hit" && $key != "miss" && $key != "size") {
//                    $images[$key] = $value;
//                }
//            }
//        }
        $images = Image::query()->get();

        return view('Dashboard.all_key.index', compact('images'));
    }

    /**
     * @return RedirectResponse
     */
    public function clear()
    {
        foreach ( Image::all() as $image ) {
            $image->delete();
        }
        $fp = fopen(base_path() .'/config/images.php' , 'w');
        fwrite($fp, '<?php return ' . '  ' . ';');
        fclose($fp);



        toastr()->success('All Cleared');
        return redirect()->back();
    }
}
