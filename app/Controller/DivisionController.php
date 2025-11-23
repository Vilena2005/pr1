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

        foreach (['division_name', 'division_type'] as $field) {
            if (empty($data[$field])) {
                $errors[] = "Поле {$field} обязательно для заполнения.";
            }
        }

        Division::create([
            'division_name' => $data['division_name'],
            'division_type' => $data['division_type'],
        ]);

        return new View('site.division', [
            'divisions'=> Division::all(),
            'message' => 'Подразделение создано успешно']);
    }

}