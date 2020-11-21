<?php

namespace App\Http\Middleware\Vendors;

use Closure;
use DB;
use Auth;

class ViewVendor
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
            ->where('vendors_view', 1)
            ->first();
        if ($check == null) {
            return redirect('not_allowed');
        } else {
            return $next($request);
        }
    }
}
