<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreedKidBirth extends Model
{
    use HasFactory;

    protected $table = 'breed_kid_birth';

    public $timestamps = false;

    protected $primaryKey = 'KID_ID';

    protected $fillable = [
        'KID_ID',
        'kid_birth_date',
        'kid_weight',
        'kid_length',
    ];
}
