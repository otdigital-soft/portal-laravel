<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class IndexController extends Controller
{
    public function referrer($ref_code)
    {
        Cookie::queue('ref_code', $ref_code, 60 * 24 * 30);
        return redirect()->route('register');
    }

    public function privacyPolicy()
    {
        return view('privacy');
    }

    public function termsOfUse()
    {
        return view('terms');
    }
}
