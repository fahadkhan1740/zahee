<?php

namespace App\Http\Middleware\Vendors;

use Closure;
use DB;
use Auth;

class AddVendor
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
        $check = DB::table('manage_role')
            ->where('user_types_id', Auth()->user()->role_id)
            ->where('vendors_create', 1)
            ->first();
        if ($check == null) {
            return redirect('not_allowed');
        }
        return $next($request);
    }
}
