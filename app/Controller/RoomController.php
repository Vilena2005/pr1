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
        $divisions = Division::all();
        return new View('site.add-room', compact('divisions'));
    }

    public function room (Request $request): string
    {
        $data = $request->all();
        $errors = [];

        // Проверка полей
        foreach (['room_number', 'room_type'] as $field) {
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
            return new View('site.add-room', [
                'errors' => $errors,
                'old' => $data
            ]);
        }

        Room::create([
            'room_number' => trim($data['room_number']),
            'room_type' => trim($data['room_type']),
            'division_id' => ($data['division_id'] ?? ''),
        ]);

        return new View('site.add-room', ['message' => 'Помещение создано']);
    }

}