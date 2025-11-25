<?php

namespace Controller;

use Model\Abonent;
use Model\Division;
use Src\Request;
use Src\View;

class DivisionController
{
    public function division_see (): string
    {
        return new View('site.division', [ 'divisions'=> Division::all() ]);

    }
    public function division_make (): string
    {
        return new View('site.add-division');
    }

    public function division (Request $request): string
    {
        $data = $request->all();
        $errors = [];

        // Проверка полей
        foreach (['division_name', 'division_type'] as $field) {
            if (empty($data[$field])) {
                $errors[] = "Поле {$field} обязательно для заполнения.";
            } else {
                $len = mb_strlen($data[$field]);
                if ($len < 3) {
                    $errors[] = "Поле {$field} должно содержать минимум 3 символа.";
                }
                if ($len > 255) {
                    $errors[] = "Поле {$field} должно содержать максимум 255 символов.";
                }
            }
        }

        // Если есть ошибки — возвращаем вью с ошибками и не создаём объект
        if (!empty($errors)) {
            return new View('site.add-division', [
                'errors' => $errors,
                'old' => $data
            ]);
        }

        Division::create([
            'division_name' => $data['division_name'],
            'division_type' => $data['division_type'],
        ]);

        return new View('site.add-division', ['message' => 'Подразделение создано']);
    }

}