<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilkLactation extends Model
{
    use HasFactory;

    protected $table = 'milk_lactation';

    protected $primaryKey = 'MILK_LID';

    public $timestamps = false;

    protected $fillable = [
        'MILK_LID',
        'lact_season',
        'lact_start',
        'lact_end',
        'lact_length'
    ];
}
