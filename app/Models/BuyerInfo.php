<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerInfo extends Model
{
    use HasFactory;

    protected $table = 'buyer_info';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'buyer_name',
        'buyer_address',
        'buyer_contact',
        'sold_date',
        'sex',
        'animal_weight',
        'transaction_type',
        'animal_value',
        'remarks',
        'RFID_TAG',
    ];

    public function livestockRegistration()
    {
        return $this->belongsTo(LivestockRegistration::class, 'RFID_TAG', 'RFID_TAG');
    }
}
