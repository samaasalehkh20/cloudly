<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $keys = config('images');


        $images = [];

        if( $keys ) {
            foreach ( $keys as $key => $value ) {
                if( $key != "hit" && $key != "miss" && $key != "size" ) {
                    $images[$key] = $value;
                }
            }
        }

        $hit = config('images.hit');
        $miss = config('images.miss');
        $size = config('images.size');
        return view('dashboard', compact('images','hit', 'miss', 'size'));
    }
}
