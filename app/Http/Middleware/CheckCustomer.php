<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CheckCustomer
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
        $customer = Auth::user()->customers()->first();
        if ($customer){
            $adress = $customer->adress()->first();

            Session::put('customerId', $customer->id);
            Session::put('adressId', $adress->id);
            return $next($request);
        } else {
            return redirect(route('userCreate'));
        }
    }
}
