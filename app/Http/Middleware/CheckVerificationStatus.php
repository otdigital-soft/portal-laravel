<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckVerificationStatus
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
        if (auth()->check()) {
            if (auth()->user()->status == 'pending') {
                auth()->logout();
                return redirect()->route('login')->with('error', 'Your account is pending verification by your Sponsor. Please follow-up with them. We look forward to welcoming you into the Shifft Community!');
            }
        }
        return $next($request);
    }
}
