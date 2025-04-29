<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ThemeController extends Controller
{
    public function switch(Request $request)
    {
        $theme = $request->theme;
        
        if (!in_array($theme, ['light', 'dark', 'system'])) {
            $theme = 'system';
        }

        // Store theme preference in a cookie that lasts for 1 year
        $minutes = 60 * 24 * 365;
        
        return response()->json([
            'message' => 'Theme updated successfully',
            'theme' => $theme
        ])->cookie('theme', $theme, $minutes);
    }

    public function current(Request $request)
    {
        $theme = $request->cookie('theme', 'system');
        
        return response()->json([
            'theme' => $theme
        ]);
    }
}
