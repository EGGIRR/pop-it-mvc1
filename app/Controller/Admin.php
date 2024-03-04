<?php

namespace Controller;

use Src\View;
use Src\Request;
use Model\User;
use Src\Validator\Validator;

class Admin
{
    public function admin_add_employee(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required', 'russian', 'not_number'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
                'russian' => 'Поле :field должно содержать только русский алфавит',
                'number' => 'Поле :field должно содержать только цифры',
                'not_number' => 'Поле :field должно содержать только буквы'
            ]);

            if ($validator->fails()) {
                return new View('site.admin_add_employee',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (User::create($request->all())) {
                app()->route->redirect('/hello');
            }
        }

        return new View('site.admin_add_employee');
    }
}