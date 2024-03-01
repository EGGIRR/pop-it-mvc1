<?php

namespace Controller;

use Model\Role;
use Model\Department;
use Model\Employee;
use Model\Post;
use Model\Structure;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;

class Site
{
    public function index(Request $request): string
    {
        $departments = Department::where('id', $request->id)->get();
        return (new View())->render('site.department', ['departments' => $departments]);
    }

    public function hello(): string
    {
        return new View('site.hello');
    }
    public function signup(Request $request): string
    {

        if ($request->method === 'POST' && User::create($request->all())) {
            app()->route->redirect('/hello');
        }
        $roles = Role::all();
        return new View('site.signup',['roles' => $roles]);
    }
    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }
    public function add_employee(Request $request): string
    {
        if ($request->method === 'POST' && Employee::create($request->all())) {
            app()->route->redirect('/hello');
        }

        // Вызов метода для получения данных из другой таблицы
        $departments = Department::all();
        $posts = Post::all();
        $structures = Structure::all();

        // Внедрение данных в представление
        return new View('site.add_employee', ['departments' => $departments,'posts' => $posts,'structures' => $structures]);
    }
    public function add_department(Request $request): string
    {
        if ($request->method === 'POST' && Department::create($request->all())) {
            app()->route->redirect('/hello');
        }
        return new View('site.add_department');
    }
    public function add_post(Request $request): string
    {
        if ($request->method === 'POST' && Post::create($request->all())) {
            app()->route->redirect('/hello');
        }
        return new View('site.add_post');
    }
    public function add_structure(Request $request): string
    {
        if ($request->method === 'POST' && Structure::create($request->all())) {
            app()->route->redirect('/hello');
        }
        return new View('site.add_structure');
    }
    public function add(): string
    {
        return new View('site.add');
    }
    public function show(): string
    {
        return new View('site.show');
    }
    public function employee_show(): string
    {
        $departments = Department::all();
        $selectedDepartments = $_POST['departments'] ?? [];

        if (!empty($selectedDepartments)) {
            $employees = Employee::whereIn('department_id', $selectedDepartments)->get();
        } else {
            $employees = Employee::all();
        }

        // Расчет среднего возраста
        $totalAge = 0;
        foreach ($employees as $employee) {
            $totalAge += date_diff(date_create($employee->birthdate), date_create('today'))->y;
        }
        $averageAge = count($employees) > 0 ? round($totalAge / count($employees)) : 0;

        return new View('site.employee_show', ['employees' => $employees, 'departments' => $departments, 'averageAge' => $averageAge]);
    }
    public function employee_structure(): string
    {
        $structures = Structure::all();
        $selectedStructure = $_POST['structure'] ?? [];

        if (!empty($selectedStructure)) {
            $employees = Employee::whereIn('structure_id', $selectedStructure)->get();
        } else {
            $employees = Employee::all();
        }


        return new View('site.employee_structure', ['employees' => $employees, 'structures' => $structures]);
    }
}