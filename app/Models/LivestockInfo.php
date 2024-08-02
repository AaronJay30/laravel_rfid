<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivestockInfo extends Model
{
    use HasFactory;

    protected $table = 'livestock_info';

    public $timestamps = false;

    protected $primaryKey = 'IID';

    protected $fillable = [
        'IID',
        'given_name',
        'farm_name',
        'sex',
        'breed',
        'sire',
        'dam',
        'birth_date',
        'death_date',
        'sold_date',
    ];
}
