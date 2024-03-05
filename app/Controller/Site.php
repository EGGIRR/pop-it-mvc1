<?php

namespace Controller;

use Model\Role;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;
use Validator\Validator;

class Site
{
    public function hello(): string
    {
        return new View('site.hello');
    }

    public function signup(Request $request): string
    {
        $roles = Role::all();
        if ($request->method === 'POST') {
//            $validator = new Validator($request->all(), [
//                'name' => ['required', 'not_number', 'russian'],
//                'login' => ['required', 'unique:users,login'],
//                'password' => ['required'],
//            ], [
//                'required' => 'Поле :field пусто',
//                'unique' => 'Поле :field должно быть уникально',
//                'russian' => 'Поле :field должно содержать только русский алфавит',
//                'number' => 'Поле :field должно содержать только цифры',
//                'not_number' => 'Поле :field должно содержать только буквы'
//            ]);
//
//            if ($validator->fails()) {
//                return new View('site.signup',
//                    ['roles' => $roles, 'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
//            }
            if (User::create($request->all())) {
                app()->route->redirect('/login');
                return false;
            }
        }
        return new View('site.signup', ['roles' => $roles]);
    }

    public function login(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'login' => ['required'],
                'password' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
                'russian' => 'Поле :field должно содержать только русский алфавит',
                'number' => 'Поле :field должно содержать только цифры',
                'not_number' => 'Поле :field должно содержать только буквы'
            ]);

            if ($validator->fails()) {
                return new View('site.login',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }
        }

        if ($request->method === 'GET') {
            return new View('site.login');
        }

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

    public function add(): string
    {
        return new View('site.add');
    }

    public function show(): string
    {
        return new View('site.show');
    }
}