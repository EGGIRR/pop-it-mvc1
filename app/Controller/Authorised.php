<?php

namespace Controller;

use Model\Department;
use Model\Employee;
use Model\Post;
use Model\Structure;
use Src\View;
use Src\Request;
use Validator\Validator;
use Validators\Image;
use Validators\ValidationRules;

class Authorised
{
    public function addEmployee(Request $request): string
    {
        $departments = Department::all();
        $posts = Post::all();
        $structures = Structure::all();
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), ValidationRules::getRules('addEmployee'), ValidationRules::getMessages());

            if ($validator->fails()) {
                return new View('authorised.addEmployee',
                    ['departments' => $departments, 'posts' => $posts, 'structures' => $structures, 'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            Image::uploadFile($request, 'images/');

            if (Employee::create($request->all())) {
                app()->route->redirect('/hello');
            }
        }


        return new View('authorised.addEmployee', ['departments' => $departments, 'posts' => $posts, 'structures' => $structures]);
    }

    public function addDepartmentTest(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), ValidationRules::getRules('addDepartment'), ValidationRules::getMessages());

            if ($validator->fails()) {
                return json_encode(['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }
            if (Department::create($request->all())) {
                app()->route->redirect('/hello');
            }
        }
        return false;
    }

    public function addDepartment(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), ValidationRules::getRules('addDepartment'), ValidationRules::getMessages());

            if ($validator->fails()) {
                return new View('authorised.addDepartment',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }
            if (Department::create($request->all())) {
                app()->route->redirect('/hello');
                return false;
            }
        }
        return (new View())->render('authorised.addDepartment');
    }

    public function addPost(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), ValidationRules::getRules('addPost'), ValidationRules::getMessages());


            if ($validator->fails()) {
                return new View('authorised.addPost',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (Post::create($request->all())) {
                app()->route->redirect('/hello');
            }
        }
        return new View('authorised.addPost');
    }

    public function addStructure(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), ValidationRules::getRules('addStructure'), ValidationRules::getMessages());


            if ($validator->fails()) {
                return new View('authorised.addStructure',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (Structure::create($request->all())) {
                app()->route->redirect('/hello');
            }
        }
        return new View('authorised.addStructure');
    }

    public function employeeShow(): string
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

        return new View('authorised.employeeShow', ['employees' => $employees, 'departments' => $departments, 'averageAge' => $averageAge, 'employees2' => $employees2]);
    }

    public function employeeStructure(): string
    {
        $structures = Structure::all();
        $selectedStructure = $_POST['structure'] ?? [];

        if (!empty($selectedStructure)) {
            $employees = Employee::whereIn('structure_id', $selectedStructure)->get();
        } else {
            $employees = Employee::all();
        }


        return new View('authorised.employeeStructure', ['employees' => $employees, 'structures' => $structures]);
    }

    public function searchEmployee(): string
    {
        $searchName = $_POST['employee'] ?? [];
        if (!empty($searchName)) {
            $employees = Employee::where('fname', $searchName)->get();
        } else {
            $employees = Employee::all();
        }
        return new View('authorised.searchEmployee', ['employees' => $employees]);
    }
}