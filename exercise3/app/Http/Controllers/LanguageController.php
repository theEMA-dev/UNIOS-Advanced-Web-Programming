<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switchLang(string $lang)
    {
        if (in_array($lang, ['en', 'pl', 'tr'])) {
            session()->put('locale', $lang);
            app()->setLocale($lang);
        }
        return redirect()->back();
    }
}
