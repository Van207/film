<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLogin
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
		if (Auth::check()) {

			// 0-superadmin, 1-admin, 2-user	
			if (Auth::user()->role == '0' || Auth::user()->role == '1') {
				return $next($request);
			} else {
				return redirect()->route('login');
			}
		} else {
			return redirect()->route('login');
		}
	}
}
