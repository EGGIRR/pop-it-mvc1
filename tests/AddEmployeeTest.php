<?php
//
//use Controller\Authorised;
//use Model\Department;
//use PHPUnit\Framework\TestCase;
//use Src\Request;
//
//class AddEmployeeTest extends TestCase
//{
//    /**
//     * @dataProvider departmentProvider
//     */
//    public function testAddStudent(array $studentData, bool $expectSuccess): void
//    {
//        // Создаем заглушку для класса Request.
//        $request = $this->createMock(Request::class);
//        $request->method('all')->willReturn($studentData);
//        $request->method = 'POST';
//
//        // Создаем экземпляр класса, метод которого будем тестировать.
//        $student = new Department();
//
//        // Вызываем метод studentAdd() и сохраняем результат работы в переменную.
//        $response = $student->addDepartment($request);
//
//        // Проверяем статус добавления.
//        if ($expectSuccess) {
//            $this->assertInstanceOf(Department::class, Department::where('name', $studentData['name'])->first());
//        } else {
//            $this->assertFalse(Department::where('name', $studentData['name'])->exists());
//        }
//    }
//
//    public static function departmentProvider(): array
//    {
//        return [
//            [
//                [
//                    'name' => 'qwe',
//                ],
//                false,
//            ],
//            [
//                [
//                    'name' => 'Департамент',
//                ],
//                true,
//            ],
//            [
//                [
//                    'name' => '',
//                ],
//                false,
//            ],
//        ];
//    }
//    protected function setUp(): void
//    {
//        //Установка переменной среды
//        $_SERVER['DOCUMENT_ROOT'] = '/Домашняя/mount/nvryybs-m4/pop-it-mvc1';
//
//        //Создаем экземпляр приложения
//        $GLOBALS['app'] = new Src\Application(new Src\Settings([
//            'app' => include $_SERVER['DOCUMENT_ROOT'] . '/config/app.php',
//            'db' => include $_SERVER['DOCUMENT_ROOT'] . '/config/db.php',
//            'path' => include $_SERVER['DOCUMENT_ROOT'] . '/config/path.php',
//        ]));
//
//        //Глобальная функция для доступа к объекту приложения
//        if (!function_exists('app')) {
//            function app()
//            {
//                return $GLOBALS['app'];
//            }
//        }
//    }
//}