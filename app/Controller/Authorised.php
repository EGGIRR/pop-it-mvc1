<?php

namespace Controller;

use Model\Department;
use Model\Employee;
use Model\Post;
use Model\Structure;
use Src\View;
use Src\Request;
use Validator\Validator;

class Authorised
{
    public function add_employee(Request $request): string
    {
        $departments = Department::all();
        $posts = Post::all();
        $structures = Structure::all();
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'fname' => ['required', 'not_number', 'russian'],
                'lname' => ['required', 'not_number', 'russian'],
                'patronymic' => ['required', 'not_number', 'russian'],
                'gender' => ['required'],
                'birthdate' => ['required'],
                'address' => ['required'],
                'avatar' => ['required', 'fileType']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
                'russian' => 'Поле :field должно содержать только русский алфавит',
                'number' => 'Поле :field должно содержать только цифры',
                'not_number' => 'Поле :field должно содержать только буквы',
                'fileType' => 'Поле :field должно быть в формате: png,jpeg или jpg',
            ]);
            if ($validator->fails()) {
                return new View('site.add_employee',
                    ['departments' => $departments, 'posts' => $posts, 'structures' => $structures, 'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }
            $uploadDirectory = 'images/';
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $avatar = $_FILES['avatar'];
                $filename = $uploadDirectory . basename($avatar['name']);
                if (move_uploaded_file($avatar['tmp_name'], $filename)) {
                    $request->set('avatar', $filename);
                }
            }
            if (Employee::create($request->all())) {
                app()->route->redirect('/hello');
            }
        }


        return new View('site.add_employee', ['departments' => $departments, 'posts' => $posts, 'structures' => $structures]);
    }

    public function add_department(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required', 'unique:departments,name', 'russian'],
                'type' => ['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
                'russian' => 'Поле :field должно содержать только русский алфавит',
                'number' => 'Поле :field должно содержать только цифры',
                'not_number' => 'Поле :field должно содержать только буквы'
            ]);

            if ($validator->fails()) {
                return new View('site.add_department',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (Department::create($request->all())) {
                app()->route->redirect('/hello');
            }
        }
        return new View('site.add_department');
    }

    public function add_post(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required', 'unique:posts,name'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
                'russian' => 'Поле :field должно содержать только русский алфавит',
                'number' => 'Поле :field должно содержать только цифры',
                'not_number' => 'Поле :field должно содержать только буквы'
            ]);

            if ($validator->fails()) {
                return new View('site.add_post',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (Post::create($request->all())) {
                app()->route->redirect('/hello');
            }
        }
        return new View('site.add_post');
    }

    public function add_structure(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required', 'unique:structures,name'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
                'russian' => 'Поле :field должно содержать только русский алфавит',
                'number' => 'Поле :field должно содержать только цифры',
                'not_number' => 'Поле :field должно содержать только буквы'
            ]);

            if ($validator->fails()) {
                return new View('site.add_structure',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (Structure::create($request->all())) {
                app()->route->redirect('/hello');
            }
        }
        return new View('site.add_structure');
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
        $employees2 = count($employees);
        $totalAge = 0;
        foreach ($employees as $employee) {
            $totalAge += date_diff(date_create($employee->birthdate), date_create('today'))->y;
        }
        $averageAge = count($employees) > 0 ? round($totalAge / count($employees)) : 0;

        return new View('site.employee_show', ['employees' => $employees, 'departments' => $departments, 'averageAge' => $averageAge, 'employees2' => $employees2]);
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

    public function search_employee(): string
    {
        $searchName = $_POST['employee'] ?? [];
        if (!empty($searchName)) {
            $employees = Employee::where('fname', $searchName)->get();
        } else {
            $employees = Employee::all();
        }
        return new View('site.search_employee', ['employees' => $employees]);
    }
}