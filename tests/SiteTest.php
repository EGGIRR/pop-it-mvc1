<?php

use Model\User;
use PHPUnit\Framework\TestCase;

class SiteTest extends TestCase
{


    /**
     * @dataProvider additionProvider
     * @runInSeparateProcess
     */
    public function testSignup(string $httpMethod, array $userData,string $message): void
    {
        //Выбираем занятый логин из базы данных
        if ($userData['login'] === 'login is busy') {
            $userData['login'] = User::get()->first()->login;
        }

        // Создаем заглушку для класса Request.
        $request = $this->createMock(\Src\Request::class);
        // Переопределяем метод all() и свойство method
        $request->expects($this->any())
            ->method('all')
            ->willReturn($userData);
        $request->method = $httpMethod;

        //Сохраняем результат работы метода в переменную
        $result = (new \Controller\Site())->signupTest($request);
        $decodedResult = json_decode($result);

        if (!empty($decodedResult)) {
            // Преобразование декодированного сообщения обратно в JSON для сравнения
            $decodedMessage2 = mb_convert_encoding($decodedResult->message, 'utf8', 'auto');
            $this->assertEquals($message, $decodedMessage2);
            return;
        }
        //Проверяем добавился ли пользователь в базу данных
        $this->assertTrue((bool)User::where('login', $userData['login'])->count());
        //Удаляем созданного пользователя из базы данных
        User::where('login', $userData['login'])->delete();
    }



//Метод, возвращающий набор тестовых данных
    public static function additionProvider(): array
    {
        return [
            ['POST', ['name' => 'Владислав', 'login' => 'eggi', 'password' => '123','role_id' => '2'],
                '{"login":["Поле login должно быть уникально"]}',
            ],
            ['POST', ['name' => 'Владислав', 'login' => 'eggi2', 'password' => '123','role_id' => '2'],
                '{"login":["Поле login должно быть уникально"]}',
            ],
            ['POST', ['name' => 'admin', 'login' => 'eggi3', 'password' => '123','role_id' => '2'],
                '{"name":["Поле name должно содержать только русский алфавит"]}',
            ],
        ];

    }

    protected function setUp(): void
    {
        //Установка переменной среды
        $_SERVER['DOCUMENT_ROOT'] = '.';

        //Создаем экземпляр приложения
        $GLOBALS['app'] = new Src\Application(new Src\Settings([
            'app' => include $_SERVER['DOCUMENT_ROOT'] . '/config/app.php',
            'db' => include $_SERVER['DOCUMENT_ROOT'] . '/config/db.php',
            'path' => include $_SERVER['DOCUMENT_ROOT'] . '/config/path.php',
        ]));


        //Глобальная функция для доступа к объекту приложения
        if (!function_exists('app')) {
            function app()
            {
                return $GLOBALS['app'];
            }
        }
    }
}