<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use View;

class BaseAdminController extends Controller
{
    public function __construct()
    {
        // SELECT main categories without country
        $mainCategory = DB::select("SELECT * FROM `mainCategory`");
        $menu['units'] = $mainCategory;

        // select everything including country
        $mainCategory = DB::select("SELECT * FROM `mainCategory`");
        $menu['allunits'] = $mainCategory;

        View::share('menu', $menu);

    }
}
