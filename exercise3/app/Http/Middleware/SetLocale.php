<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected $languages = ['en', 'pl', 'tr'];

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get('locale', $request->getPreferredLanguage($this->languages));
        
        if ($request->has('lang') && in_array($request->input('lang'), $this->languages)) {
            $locale = $request->input('lang');
            $request->session()->put('locale', $locale);
        }

        app()->setLocale($locale);
        
        return $next($request);
    }
}
