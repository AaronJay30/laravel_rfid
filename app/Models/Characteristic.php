<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    use HasFactory;

    protected $table = 'livestock_char';

    protected $primaryKey = 'CID';

    public $timestamps = false;

    protected $fillable = [
        'CID',
        'jaw',
        'ear',
        'body',
        'teat',
        'horn',
    ];
}
