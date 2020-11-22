<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (file_exists(storage_path('installed'))) {
            if (Session::has('locale')) {
                $locale = Session::get('locale', Config::get('app.locale'));
            } else {
                $languages = DB::table('languages')->where('is_default', '=', '1')->get();
                $request->session()->put('direction', $languages[0]->direction);
                $locale = $languages[0]->code;
            }

            App::setLocale($locale);
        }
        return $next($request);
    }
}
