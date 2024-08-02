<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForageInfo extends Model
{
    use HasFactory;

    protected $table = 'forage_info';

    protected $primaryKey = 'FEED_ID';

    public $timestamps = false;

    protected $fillable = [
        'FEED_ID',
        'forage_type',
        'dry_matter',
        'feed_intake',
        'duration_start',
        'duration_end'
    ];
}
