<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'SCHED_ID';

    public $incrementing = true;

    public $timestamps = false;

    protected $table = 'schedule';

    protected $fillable = [
        "SCHED_ID",
        "event",
        "date",
        "medicine",
        "treatment",
        "symptoms",
        "weight",
        "temperature",
        "status",
        "RFID_TAG",
    ];

    public function livestockRegistration()
    {
        return $this->belongsTo(LivestockRegistration::class, 'RFID_TAG', 'RFID_TAG');
    }
}
