<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use \Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class UploadImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Cache\Store
     */
    public function create()
    {
        return view('Dashboard.upload_image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        // Write Data in \Config\images Then DB;
        $image_path = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $image_path = $file->store('images', [
                 'disk' => 's3',
            ]);
        }

        if ( config('images')) {
            foreach ( config('images') as $key => $value ) {
                if ( $key == $request->key ) {
                    config(['images.'.$request->key =>  $image_path]);

                    $size = config::get('images.size');
                    $size =+ $request->file('image')->getSize();
                    $final_size = $size / 1000000; // To Convert Bytes To MB
                    config::set(['images.size' => $final_size]);

                    $fp = fopen(base_path() .'/config/images.php' , 'w');
                    fwrite($fp, '<?php return ' . var_export(config('images'), true) . ';');
                    fclose($fp);

                    toastr()->success('Key Already Exists, But Image Successfully Uploaded');

                    return redirect()->back();
                }
            }
        }



        Image::create([
           'key' => $request->key,
           'image' => Storage::disk('s3')->url($image_path),
           'title' => $request->title,
           'created_at' => null,
           'updated_at' => null,
        ]);

        if ( !config::get('images.hit') ) {
            config::set( 'images.hit', 0);
        }

        if ( !config::get('images.miss') ) {
            config::set( 'images.miss', 0);
        }

        if ( !config::get('images.size') ) {
            config::set( 'images.size', 0);
        }

        // Set Size After Upload
        $size = config::get('images.size');
        $size =+ $request->file('image')->getSize();
        $final_size = $size / 1000000; // To Convert Bytes To MB
        config::set(['images.size' => $final_size]);

        config(['images.'.$request->key =>  $image_path]);

        $fp = fopen(base_path() .'/config/images.php' , 'w');
        fwrite($fp, '<?php return ' . var_export(config('images'), true) . ';');
        fclose($fp);

        toastr()->success('Successfully Uploaded');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function getRecent(Request $request)
    {
//        if (config('images')) {
//            foreach ( config('images') as $key => $value ) {
//                if ( $key == $request->key ) {
//
//                    config(['images.'.$request->key => $value]);
//
//                    $fp = fopen(base_path() .'/config/images.php' , 'w');
//                    fwrite($fp, '<?php return ' . var_export(config('images'), true) . ';');
//                    fclose($fp);
//                }
//            }
//        }

        $image = Image::where('id', $request->id)->first();

        $image->update([
            'updated_at' => now(),
        ]);
    }

}
