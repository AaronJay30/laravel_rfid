<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirthInfo extends Model
{
    use HasFactory;

    protected $table = 'livestock_birthinfo';

    protected $primaryKey = 'BID';

    public $timestamps = false;

    protected $fillable = [
        'BID',
        'birth_date',
        'birth_season',
        'birth_type',
        'milk_type',
        'birth_image',
    ];
}
