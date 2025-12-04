<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id',
        'division_name',
        'division_type'
    ];


    public function abonents ()
    {
        return $this->hasMany(Abonent::class, 'division_id');
    }

    public function rooms ()
    {
        return $this->hasMany(Room::class, 'division_id');
    }

}