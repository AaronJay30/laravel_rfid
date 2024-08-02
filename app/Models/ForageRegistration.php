<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForageRegistration extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'forage_reg';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'FID';

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
        'FID',
        'RFID_TAG',
        'FEED_ID',
        'EST_ID',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($forageRegistration) {
            $forageRegistration->forageInfo()->delete();
        });
    }

    public function forageInfo()
    {
        return $this->belongsTo(ForageInfo::class, 'FEED_ID', 'FEED_ID');
    }

    public function forageEst()
    {
        return $this->belongsTo(ForageEst::class, 'EST_ID', 'EST_ID');
    }
}
