<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Central extends Model
{
    use HasFactory;
    public $table = 'central';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'api_key',
    ];
}
