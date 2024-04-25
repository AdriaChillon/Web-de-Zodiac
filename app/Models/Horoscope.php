<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horoscope extends Model
{
    protected $fillable = ['date','sign', 'lang', 'time', 'phrase'];
}
