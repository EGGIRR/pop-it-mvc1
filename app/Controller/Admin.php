<?php

namespace Controller;

use Src\View;
use Src\Request;
use Model\User;
use Validator\Validator;
use Validators\ValidationRules;

class Admin
{
    public function adminAddEmployee(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), ValidationRules::getRules('signup'), ValidationRules::getMessages());


            if ($validator->fails()) {
                return new View('admin.adminAddEmployee',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (User::create($request->all())) {
                app()->route->redirect('/hello');
            }
        }

        return new View('admin.adminAddEmployee');
    }
}