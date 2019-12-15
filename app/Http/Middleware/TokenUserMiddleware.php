<?php

namespace App\Http\Middleware;

use App\Http\Errors\ErrorCode;
use App\Http\Utils\ResponseUtil;
use App\User;
use Closure;

class TokenUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::where('token', $request->token)->first();
        if (!$user) {
            return ResponseUtil::makeResponse(401, false, [
                "errors" => [
                    "unauthorized"
                ],
                "errorCode" => ErrorCode::UNAUTHORIZED
            ]);
        }
        $request->user = $user;
        return $next($request);
    }
}
