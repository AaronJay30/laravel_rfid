<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreedRegistration extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'breed_reg';

    protected $fillable = [
        'BID',
        'KID_ID',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($breedRegistration) {
            $breedRegistration->breedDetails()->delete();
            $breedRegistration->breedKidBirth()->delete();
        });
    }

    public function breedDetails()
    {
        return $this->belongsTo(BreedDetails::class, 'BID', 'BID');
    }

    public function breedKidBirth()
    {
        return $this->belongsTo(BreedKidBirth::class, 'KID_ID', 'KID_ID');
    }
}
