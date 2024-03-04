<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class RusValidator extends AbstractValidator
{

    protected string $message = 'Разрешен только русский язык';

    public function rule(): bool
    {
        return preg_match('/^[йцукенгшщзхъфывапролджэячсмитьбюЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮ]+$/', $this->value);
    }
}