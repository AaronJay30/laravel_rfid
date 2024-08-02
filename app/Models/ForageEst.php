<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForageEst extends Model
{
    use HasFactory;

    protected $table = 'forage_est';

    protected $primaryKey = 'EST_ID';

    public $timestamps = false;

    protected $fillable = [
        'EST_ID',
        'est',
        'est_status',
        'soil_type',
        'forage_type',
        'climate_condition',
        'date_planted',
        'date_harvested',
    ];
}
