<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $table = 'livestock_progress';

    protected $primaryKey = 'PID';

    public $timestamps = false;

    protected $fillable = [
        'PID',
        'RFID_TAG',
        'weight',
        'length',
        'wither',
        'date',
        'image',
    ];

    public function livestockRegistration()
    {
        return $this->belongsTo(LivestockRegistration::class, 'RFID_TAG', 'RFID_TAG');
    }
}
