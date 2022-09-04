<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    public $table = 'booking';
    public $timestamps = true;
    protected $fillable = [
        'users_id',
        'status_id',
        'store_id',
        'start_date',
        'end_date',
        'verify_date'
    ];

    public function scopeStartsBetween(Builder $query, $date): Builder
    {

        return $query->where('start_date', 'betwwen',);
    }
}
