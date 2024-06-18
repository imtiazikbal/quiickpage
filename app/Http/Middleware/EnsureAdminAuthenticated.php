<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\AdminLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Symfony\Component\HttpFoundation\Response;

class EnsureAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        dd(Auth::user());

        // Check if the user is logged in
           // Check if the user is logged in
    if (!Auth::check()) {
        dd('User not logged in');
        return redirect('/admin/login/view')->with('error', 'You must be logged in to access this page.');
    }

    // Retrieve the logged-in user
    $user = Auth::user();

    // Check if the user is an admin
    if (!$user instanceof AdminLogin) {
        return redirect('/panel')->with('error', 'You are not authorized to access this page.');
    }

    // User is authenticated and is an admin, proceed with the request
    return $next($request);

    }
    }

