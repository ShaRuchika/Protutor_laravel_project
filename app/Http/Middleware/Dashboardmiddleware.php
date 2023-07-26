<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Dashboardmiddleware
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
        $userid = Session::get('userid');
        //$currentUser = $this->auth->getUser();

        if (!isset($userid) and $userid==''){
            //abort(403, 'Unauthorized action.');
            return redirect('/login')->with('error_msg', __('Please first login.'));
        }
        return $next($request);
    }
}
