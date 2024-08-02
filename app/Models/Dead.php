<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dead extends Model
{
    use HasFactory;

    protected $table = 'dead';

    protected $primaryKey = 'DEAD_ID';

    public $timestamps = false;

    protected $fillable = [
        'DEAD_ID',
        'death_cause',
        'death_date',
        'remarks',
        'RFID_TAG',
    ];

    public function livestockRegistration()
    {
        return $this->belongsTo(LivestockRegistration::class, 'RFID_TAG', 'RFID_TAG');
    }
}
