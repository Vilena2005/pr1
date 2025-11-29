<?php

namespace Controller;

use Model\Abonent;
use Model\Division;
use Src\Request;
use Src\View;


class AbonentController
{
    public function index (): string
    {
        return new View('site.abonent', ['abonents' => Abonent::all() ]);
    }

    public function make (): string
    {
        $divisions = Division::all();
        return new View('site.add-abonent', compact('divisions'));
    }

    public function abonent (Request $request): string
    {
        $data = $request->all();
        $errors = [];

        // Проверка полей
        foreach (['surname', 'name', 'patronym', 'birth_date','phone'] as $field) {
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
        //Возврат при ошибке
        if (!empty($errors)) {
            return new View('site.add-abonent', [
                'errors' => $errors,
                'old' => $data
            ]);
        }

        Abonent::create([
            'surname' => trim($data['surname']),
            'name' => trim($data['name']),
            'patronym' => trim($data['patronym']),
            'birth_date' => $data['birth_date'],
            'division_id' => ($data['division_id'] ?? ''),
            'phone' => trim($data['phone']),
        ]);

        return new View('site.add-abonent', ['message' => 'Абонент создан']);
    }


    public function deleteList(): string
    {
        $abonents = Abonent::all();
        return new View('site.abonents-delete', ['abonents' => $abonents]);
    }

    public function deleteSelected(Request $request): string
    {
        $selectedIds = $request->get('ids', []);
        $deletedCount = 0;
        $errors = [];

        if (!empty($selectedIds) && is_array($selectedIds)) {
            foreach ($selectedIds as $id) {
                $abonent = Abonent::find($id);
                if ($abonent) {
                    $abonent->delete();
                    $deletedCount++;
                } else {
                    $errors[] = "Абонент с ID {$id} не найден";
                }
            }
        }

        $abonents = Abonent::all();

        if (!empty($errors)) {
            return new View('site.abonents-delete', [
                'abonents' => $abonents,
                'errors' => $errors,
                'message' => "Абоненты удалены"
            ]);
        }

        return new View('site.abonents-delete', [
            'abonents' => $abonents,
            'message' => "Абоненты успешно удалены"
        ]);
    }


}