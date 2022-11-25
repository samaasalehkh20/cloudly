<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RecentController extends Controller
{
    public function index()
    {
        $images = null;
        foreach (  config('images') as $key => $value ) {

            $images = Image::query()->whereNotNull('updated_at')->orderBy('updated_at', 'desc')->get();

        }

        return view('Dashboard.recent.index', compact('images'));
    }
}
