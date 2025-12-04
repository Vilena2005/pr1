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
            'division_name' => trim($data['division_name']),
            'division_type' => trim($data['division_type']),
        ]);

        return new View('site.add-division', ['message' => 'Подразделение создано']);
    }

    public function divisionDeleteList (): string
    {
        $divisions = Division::all();
        return new View('site.divisions-delete', ['divisions' => $divisions]);
    }

    public function divisionDeleteSelected (Request $request): string
    {
        $selectedIds = $request->get('ids', []);
        $deletedCount = 0;
        $errors = [];

        if (!empty($selectedIds) && is_array($selectedIds)) {
            foreach ($selectedIds as $id) {

                $division = Division::find($id);

                if ($division) {

                    $division->delete();
                    $deletedCount++;
                }
                else {
                    $errors[] = "Помещение с ID {$id} не найден";
                }
//
//                // Проверяем связи перед удалением
//                if ($division->abonents_count > 0) {
//                    $warnings[] = "Подразделение '{$division->division_name}' не удалено: есть {$division->abonents_count} абонентов";
//                    continue;
//                }
//
//                if ($division->rooms_count > 0) {
//                    $warnings[] = "Подразделение '{$division->division_name}' не удалено: есть {$division->rooms_count} помещений";
//                    continue;
//                }

                // Удаляем подразделение, если связей нет

            }
        }

        // Обновляем список
        $divisions = Division::all();

        if (!empty($errors)) {
            return new View('site.rooms-delete', [
                'divisions' => $divisions,
                'errors' => $errors,
                'message' => "Помещения удалены"
            ]);
        }

//        $data = [
//            'divisions' => $divisions,
//            'deletedCount' => $deletedCount
//        ];
//        if (!empty($errors)) {
//            $data['errors'] = $errors;
//        }
//        if (!empty($warnings)) {
//            $data['warnings'] = $warnings;
//        }

//        return new View('site.divisions-delete', $data);

        return new View('site.divisions-delete', [
            'divisions' => $divisions,
            'message' => "Подразделения успешно удалены"
        ]);
    }

}