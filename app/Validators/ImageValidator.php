<?php

namespace Validators;

use Validator\AbstractValidator;

class ImageValidator extends AbstractValidator
{

    protected string $message = 'Недопустимое разрешение файла';

    public function rule(): bool
    {
        $type_valid = ['image/jpeg', 'image/jpg', 'image/png'];
        $value = $_FILES['avatar']['type'];
        return in_array($value, $type_valid);
    }
}