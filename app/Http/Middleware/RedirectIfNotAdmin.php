<?php

namespace Seasonofjubilee\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = 'admin')
	{
		if(Auth::guard('admin')->guest() || !Auth::guard('admin')->check()){
			return redirect()->route('admin.login');
		}
		return $next($request);
	}
}