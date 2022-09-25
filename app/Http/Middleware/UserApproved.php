<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserApproved
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
        if(Auth::user())
        {
            switch (Auth::user()->approved) {
                case '0':
                    User::where('id', Auth::user()->id)->update(['approved' => '1']);
                    Auth::logout();
                    return redirect()->route('index')->with('success', 'You have registered successfully and your  account is pending for review. Once reviewed and approved by the administrator, you can login again.');
                    break;

                case '1':
                    Auth::logout();
                    return redirect()->route('index')->with('warning', 'Your account is pending for review. Once reviewed and approved by the administrator, you can login again.');
                    break;
                case '2':
                    return $next($request);
                    break;
                case '3':
                    Auth::logout();
                    return redirect()->route('index')->with('error', 'Your account has been rejected.');
                    break;
                default:
                    return $next($request);
                    break;
            }
        }
        return $next($request);
    }
}
