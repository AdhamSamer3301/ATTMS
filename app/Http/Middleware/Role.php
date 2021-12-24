<?php

// namespace App\Http\Middleware;

// use Closure;

// class Role
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \Closure  $next
//      * @return mixed
//      */
//     public function handle($request, Closure $next, ... $roles)
// {


//     $user = Auth::user();

//     if($user->isAdmin())
//         return $next($request);

//     foreach($roles as $role) {
//         // Check if user has the role This check will depend on how your roles are set up
//         if($user->hasRole($role))
//             return $next($request);
//     }

//     return redirect('login');
// }
// }
