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


        if ($req == (route('product.create')))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('Create Product'))
            {
                $error = true;
            }
        }else if ($req == route('product.edit', ['id'=>$request->id])) //If user is editing a post
        {
            if (!Auth::user()->hasPermissionTo('Edit Product')) {
                $error = true;
            }
        }else if ($req == route('product.delete', ['id'=>$request->id])) //If user is deleting a post
        {
            if (!Auth::user()->hasPermissionTo('Delete Product')) {
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