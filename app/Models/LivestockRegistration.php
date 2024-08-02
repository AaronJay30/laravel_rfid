<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivestockRegistration extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'livestock_reg';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'RFID_TAG';

    /**
     * Indicates if the primary key is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RFID_TAG',
        'IID',
        'CID',
        'BID',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($livestockRegistration) {
            $livestockRegistration->livestockInfo()->delete();
            $livestockRegistration->characteristic()->delete();
            $livestockRegistration->birthInfo()->delete();
        });
    }

    public function livestockInfo()
    {
        return $this->belongsTo(LivestockInfo::class, 'IID', 'IID');
    }

    public function characteristic()
    {
        return $this->belongsTo(Characteristic::class, 'CID', 'CID');
    }

    public function birthInfo()
    {
        return $this->belongsTo(BirthInfo::class, 'BID', 'BID');
    }
}
