<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    protected function authenticate($request, array $guards)
    {
        $result = parent::authenticate($request, $guards);
        $user = $request->user();
        if ($user && $user->active == false) {
            \Auth::guard('web')->logout();
            $request->session()->invalidate();
            return redirect('/login');
        }
        return $result;
    }
}
