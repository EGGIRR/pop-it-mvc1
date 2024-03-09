<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;
use Src\View;

class TokenCheckMiddleware
{
    public function handle(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $token = $request->bearerToken();
            if ($token !== $user->getToken()) {
                (new View())->toJSON(['message' => 'Неверный токен']);
            }else{
                (new View())->toJSON(['message' => 'Вы не автоизировались!']);
            }
        }
    }
}