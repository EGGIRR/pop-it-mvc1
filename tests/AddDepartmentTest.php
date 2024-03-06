<?php

use Model\Department;
use PHPUnit\Framework\TestCase;
use Validators\ValidationRules;

class AddDepartmentTest extends TestCase
{


    /**
     * @dataProvider additionProvider
     */
    public function testAddDepartment(string $httpMethod, array $userData,string $message): void
    {
        if ($userData['name'] === 'login is busy') {
            $userData['name'] = Department::get()->first()->name;
        }

        // Создаем заглушку для класса Request.
        $request = $this->createMock(\Src\Request::class);
        // Переопределяем метод all() и свойство method
        $request->expects($this->any())
            ->method('all')
            ->willReturn($userData);
        $request->method = $httpMethod;

        //Сохраняем результат работы метода в переменную
        $result = (new \Controller\Authorised())->addDepartmentTest($request);
        $decodedResult = json_decode($result);

        if (!empty($decodedResult)) {
            // Преобразование декодированного сообщения обратно в JSON для сравнения
            $decodedMessage2 = mb_convert_encoding($decodedResult->message, 'utf8', 'auto');
            $this->assertEquals($message, $decodedMessage2);
            return;
        }

        //Проверяем добавился ли пользователь в базу данных
        $this->assertTrue((bool)Department::where('name', $userData['name'])->count());
        //Удаляем созданного пользователя из базы данных
        Department::where('name', $userData['name'])->delete();
    }


//Метод, возвращающий набор тестовых данных
    public static function additionProvider(): array
    {
        return [
            ['POST', ['name' => '', 'type' => 'Внутренний'],
                '{"name":["Поле name пусто","Поле name должно содержать только русский алфавит"]}'
            ],
            ['POST', ['name' => 'Department', 'type' => 'Внутренний'],
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