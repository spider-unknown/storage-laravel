<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use Session;
use Illuminate\Support\Facades\Auth;

class ClearanceMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if (Auth::user()->hasPermissionTo('Administer roles & permissions')) //If user has this //permission
        {
            return $next($request);
        }

        $req = Request::fullUrl();
        $error = false;


        if ($req == (route('order.create')))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('Create Order'))
            {
                $error = true;
            }
        }else if ($req == route('order.edit', ['id'=>$request->id])) //If user is editing a post
        {
            if (!Auth::user()->hasPermissionTo('Edit Order')) {
                $error = true;
            }
        }else if ($req == route('order.delete', ['id'=>$request->id])) //If user is deleting a post
        {
            if (!Auth::user()->hasPermissionTo('Delete Order')) {
                $error = true;
            }
        }

        if($error){
            Session::flash('error' , 'You don\'t have permission!');
            return redirect()->back();
        }else{
            return $next($request);
        }

    }
}