<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApproverMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $level = null): Response
    {
        /** @var \App\Models\User|null $user */
        $user = auth()->user();

        if (!$user || !$user->isApprover()) {
            abort(403);
        }
        return $next($request);
    }
}
