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

}