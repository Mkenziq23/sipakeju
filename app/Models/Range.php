<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Range extends Model
{
    use HasFactory;

    protected $fillable = ['min_value', 'max_value', 'keterangan'];
    protected $table = 'range';


}
