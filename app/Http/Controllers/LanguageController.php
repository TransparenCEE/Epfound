<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function loader(Request $request) {

        $request->session()->put('locale', $request->input('locale'));

       $locale = session('locale');

        App::setLocale($locale);

        return Redirect::back();
    }
}
