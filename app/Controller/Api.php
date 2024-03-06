<?php

namespace Controller;

use Model\Department;
use Model\Employee;
use Model\Structure;
use Src\Auth\Auth;
use Src\Request;
use Src\View;
use Validator\Validator;
use Validators\ValidationRules;

class Api
{
    public function employee(): void
    {
        if (Auth::check()) {
            $employee = Employee::all()->toArray();
            (new View())->toJSON($employee);
        } else {
            (new View())->toJSON((array)'Нет доступа');
        }
    }

    public function department(): void
    {
        if (Auth::check()) {
            $groupSubjects = Department::all()->toArray();
            (new View())->toJSON($groupSubjects);
        } else {
            (new View())->toJSON((array)'Нет доступа');
        }
    }

    public function echo(Request $request): void
    {
        (new View())->toJSON($request->all());
    }

    public function login(Request $request)
    {
        if ($request->method === 'POST') {
            if (Auth::attempt($request->all())) {
                $token = app()->auth::generateToken();
                Auth::user()->update([
                    'token' => $token
                ]);
                $users = app()->auth::user()->toArray();
                (new View())->toJSON((array)($users['token']));
            } else {
                (new View())->toJSON((array)'Login failed');
            }
        }
    }

    public function logout(Request $request): void
    {
        if (!Auth::attempt($request->all())) {
            $token = null;
            Auth::user()->update([
                'token' => $token
            ]);
        }
        Auth::logout();
        (new View())->toJSON((array)'logout');
    }

    public function addDepartment(Request $request): void
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), ValidationRules::getRules('addDepartment'), ValidationRules::getMessages());
            if (Auth::check()) {
                if ($validator->fails()) {
                    (new View())->toJSON(['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
                }
                if (Department::create($request->all())) {
                    (new View())->toJSON((array)'Отдел создан');
                }
            } else {
                (new View())->toJSON((array)'Не доступно');
            }
        }
    }

    public function addStructure(Request $request): void
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), ValidationRules::getRules('addStructure'), ValidationRules::getMessages());
            if (Auth::check()) {
                if ($validator->fails()) {
                    (new View())->toJSON(['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
                }
                if (Structure::create($request->all())) {
                    (new View())->toJSON((array)'Структура создана');
                }
            } else {
                (new View())->toJSON((array)'Не доступно');
            }
        }
    }
}