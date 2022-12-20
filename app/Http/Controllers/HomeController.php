<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
//        $images = [];
//        $keys= config('images');
//
//        if( $keys ) {
//            foreach ( $keys as $key => $value ) {
//                if( $key != "hit" && $key != "miss" && $key != "size") {
//                    $images[$key] = $value;
//                }
//
//            }
//        }
//        foreach ( $images as $image ) {
//            return \Illuminate\Support\Facades\Storage::disk('s3')->response('images/' . $image);
//        }

        $images = Image::query()->get();

        return view('Dashboard.home', compact('images'));
    }
}
