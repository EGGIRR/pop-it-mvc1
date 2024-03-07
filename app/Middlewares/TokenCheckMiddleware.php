<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;
use Src\View;

class TokenCheckMiddleware
{
    public function handle(Request $request)
    {
        $token = $request->bearerToken();
        $user = Auth::user();
        if($token !== $user->getToken()){
            (new View())->toJSON(['message' => 'Вы не авторизованны']);
        }
    }
}