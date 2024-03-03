<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class ImageValidator extends AbstractValidator
{

    protected string $message = 'Недопустимое разрешение файла';

    public function rule(): bool
    {
        $type_valid = ['image/jpeg','image/jpg','image/png'];
        $value  = $_FILES['image']['type'];
        return in_array($value, $type_valid);
    }
}