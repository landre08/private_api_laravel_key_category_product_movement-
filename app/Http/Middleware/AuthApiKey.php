<?php

namespace App\Http\Middleware;

use App\Services\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class AuthApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-KEY');
        if (empty($apiKey)) {
            return ApiResponse::error('API KEY is missing.', 401);
        }

        $user = User::where('api_key', $apiKey)->first();
        if (empty($user)) {
            return ApiResponse::error('Invalid API Key.', 401);
        }

        return $next($request);
    }
}
