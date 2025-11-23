<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = auth()->user();

        // Jika pengguna belum login (seharusnya sudah dicek oleh auth:sanctum)
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Iterasi melalui semua peran yang diminta di route
        foreach ($roles as $role) {
            // Cek apakah pengguna memiliki salah satu peran yang diminta
            if ($user->hasRole($role)) { 
                return $next($request);
            }
        }

        // Jika pengguna tidak memiliki satupun peran yang diminta, tolak
        return response()->json(['message' => 'Access Denied. You do not have permission to access this resource.'], 403); 
    }
}
