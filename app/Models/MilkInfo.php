<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilkInfo extends Model
{
    use HasFactory;

    protected $table = 'milk_info';

    protected $primaryKey = 'MILK_MID';

    public $timestamps = false;

    protected $fillable = [
        'MILK_MID',
        'milk_yield',
        'milking_time',
        'milk_temp',
        'milk_quality',
        'milk_fat',
        'milk_protein',
        'milker_name',
    ];
}
