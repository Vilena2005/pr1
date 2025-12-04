<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonent extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'surname',
        'name',
        'patronym',
        'birth_date',
        'division_id',
        'phone',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }



}
