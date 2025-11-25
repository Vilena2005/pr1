<?php

namespace Controller;

use Model\Abonent;
use Model\Division;
use Model\Room;
use Src\Request;
use Src\View;


class RoomController {

    public function index_room (): string
    {
        return new View('site.room', ['rooms' => Room::all() ]);
    }

    public function make_room (): string
    {
        $rooms = Room::all();
        return new View('site.add-room', compact('rooms'));
    }

    public function room (Request $request): string
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

        // Если есть ошибки — возвращаем вью с ошибками и не создаём объект
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

}