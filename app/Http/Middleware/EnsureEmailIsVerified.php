<?php

namespace App\Http\Middleware;

use Closure;

class EnsureEmailIsVerified
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
        //判断 如果用户已经登入，并且还未认证Email 访问的不是email验证相关的url或者退出的url
        if($request->user()&&!$request->user()->hasVerifiedEmail()&&!$request->is('email/*','logout')){
            return $request->expectsJson()?abort(403,'您的电子邮箱还没验证哦!'):redirect()->route('verification.notice');
        }
        return $next($request);
    }
}
