<?php

namespace App\Http\Middleware;

use App\Models\Affiliate;
use Closure;
use Illuminate\Http\Request;

class AfiliadoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
      $user=Affiliate::where('idAffiliated',Auth()->user()->idUser)->first();
      $activo=Auth()->user()->active;
            if ($user->firstBuy && $activo==1) {
              
                return redirect()->route('addproduct');
            }
        return redirect()->route('addpackage');
    }
}
