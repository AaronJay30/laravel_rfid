<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilkRegistration extends Model
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'MILK_ID';

    /**
     * Indicates if the primary key is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    public $timestamps = false;



    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'milk_reg';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'MILK_ID',
        'RFID_TAG',
        'MILK_MID',
        'MILK_LID',
        'milking_date',
    ];

    public function milkInfo()
    {
        return $this->belongsTo(MilkInfo::class, 'MILK_MID', 'MILK_MID');
    }

    public function milkLactation()
    {
        return $this->belongsTo(MilkLactation::class, 'MILK_LID', 'MILK_LID');
    }

    public function livestockRegistration()
    {
        return $this->belongsTo(LivestockRegistration::class, 'RFID_TAG', 'RFID_TAG');
    }
}
