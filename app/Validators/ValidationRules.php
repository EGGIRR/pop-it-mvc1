<?php

namespace Validators;
class ValidationRules
{
    public static function getRules($context): array
    {
        switch ($context) {
            case 'signup':
                return [
                    'name' => ['required', 'not_number', 'russian'],
                    'login' => ['required', 'unique:users,login'],
                    'password' => ['required'],
                ];
            case 'login':
                return [
                    'login' => ['required'],
                    'password' => ['required'],
                ];
            case 'addEmployee':
                return [
                    'fname' => ['required', 'not_number', 'russian'],
                    'lname' => ['required', 'not_number', 'russian'],
                    'patronymic' => ['required', 'not_number', 'russian'],
                    'gender' => ['required'],
                    'birthdate' => ['required'],
                    'address' => ['required'],
                    'avatar' => ['required']
                ];
            case 'addDepartment':
                return [
                    'name' => ['required', 'unique:departments,name', 'not_number'],
                    'type' => ['required'],
                ];
            case 'addPost':
                return [
                    'name' => ['required', 'unique:posts,name', 'not_number', 'russian'],
                ];
            case 'addStructure':
                return [
                    'name' => ['required', 'unique:structures,name', 'not_number'],
                ];
            // Add more cases for different contexts as needed
            default:
                return [];
        }
    }

    public static function getMessages(): array
    {
        return [
            'required' => 'Поле :field пусто',
            'unique' => 'Поле :field должно быть уникально',
            'russian' => 'Поле :field должно содержать только русский алфавит',
            'number' => 'Поле :field должно содержать только цифры',
            'not_number' => 'Поле :field должно содержать только буквы',
            'fileType' => 'Поле :field должно быть в формате: png,jpeg или jpg'
        ];
    }
}