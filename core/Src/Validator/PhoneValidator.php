<?php

namespace Src\Validator;

class PhoneValidator
{
    protected string $phone;
    protected array $errors = [];

    public function __construct(?string $phone)
    {
        $this->phone = trim($phone ?? '');
    }

    public function fails(): bool
    {
        return $this->validate();
    }

    protected function validate(): bool
    {
        $this->errors = []; // Сбрасываем ошибки перед каждой валидацией

        // Проверяем допустимые символы — цифры, +, -, пробелы и скобки
        if (!preg_match('/^[\d\s\+\-\(\)]+$/', $this->phone)) {
            $this->errors[] = 'Номер телефона может содержать только цифры, пробелы';
        }

        // Оставляем только цифры для проверки длины
        $digitsOnly = preg_replace('/\D/', '', $this->phone);

        // Проверяем минимальную длину (например, 10 символов)
        if (strlen($digitsOnly) < 10) {
            $this->errors[] = 'Номер телефона должен содержать минимум 10 цифр.';
        }

        // Проверяем, чтобы не было слишком длинным (например, не больше 15 цифр)
        if (strlen($digitsOnly) > 15) {
            $this->errors[] = 'Номер телефона слишком длинный.';
        }


        // Если есть ошибки - возвращаем true (валидация не прошла)
        return !empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }


}