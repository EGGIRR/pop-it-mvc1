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

        // Получаем путь текущего маршрута
        $path = $request->getPath();

        // Проверяем, что текущий маршрут не является /login
        if ($path !== '/login' && $user) {
            $token = $request->bearerToken();
            if ($token !== $user->getToken()) {
                (new View())->toJSON(['message' => 'Неверный токен']);
            }
        }
    }
}