<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreedDetails extends Model
{
    use HasFactory;

    protected $table = 'breed_details';

    public $timestamps = false;

    protected $primaryKey = 'BID';

    protected $fillable = [
        'BID',
        'breed_type',
        'dam_id',
        'sire_id',
        'dam_breed_count',
        'sire_breed_count',
        'breed_date',
    ];

    public function sire()
    {
        return $this->belongsTo(LivestockRegistration::class, 'sire_id', 'RFID_TAG');
    }

    public function dam()
    {
        return $this->belongsTo(LivestockRegistration::class, 'dam_id', 'RFID_TAG');
    }
}
