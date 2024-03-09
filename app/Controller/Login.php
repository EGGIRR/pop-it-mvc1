<?php

namespace Controller;

use Src\Auth\Auth;
use Src\Request;
use Src\View;
use Validator\Validator;
use Validators\ValidationRules;

class Login
{

    public function login(Request $request)
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), ValidationRules::getRules('login'), ValidationRules::getMessages());
            if ($validator->fails()) {
                (new View())->toJSON(['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }
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

}