<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'room_number',
        'room_type',
        'division_id'
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}