<?php

namespace Providers;

use Src\Provider\AbstractProvider;
use Src\Route;

class RouteProvider extends AbstractProvider
{

    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->app->bind('route', Route::single()->setPrefix($this->app->settings->getRootPath()));

        if ($this->checkPrefix('/api')) {
            require_once __DIR__ . '/../..' . $this->app->settings->getRoutePath() . '/web.php';
            $this->app->settings->removeAppMiddleware('csrf');
            //Загружаем маршруты из файла для апи
            Route::group('/api', function () {
                require_once __DIR__ . '/../..' . $this->app->settings->getRoutePath() . '/api.php';
            });
            return;
        }
        if ($this->checkPrefix('/loginapi')) {
            require_once __DIR__ . '/../..' . $this->app->settings->getRoutePath() . '/login.php';
            $this->app->settings->removeAppMiddleware('TokenCheckMiddleware');
//            Route::group('/loginapi', function () {
//                require_once __DIR__ . '/../..' . $this->app->settings->getRoutePath() . '/login.php';
//            });
            return;
        }
        if ($this->checkPrefix('/')) {
            require_once __DIR__ . '/../..' . $this->app->settings->getRoutePath() . '/web.php';
            $this->app->settings->removeAppMiddleware('TokenCheckMiddleware');
            return;
        }


        //Загружаем маршруты из стандартного файла
        require_once __DIR__ . '/../..' . $this->app->settings->getRoutePath() . '/web.php';

    }

    private function getUri(): string
    {
        //Возвращает адрес без пути до директории
        return substr($_SERVER['REQUEST_URI'], strlen($this->app->settings->getRootPath()));
    }

    private function checkPrefix(string $prefix): bool
    {
        //Получение маршрута
        $uri = $this->getUri();
        //Проверка на вхождение префикса
        return strpos($uri, $prefix) === 0;
    }
}