<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    use HasFactory;

    protected $table = "diagnosa";
    protected $fillable = ['nama', 'no_hp', 'alamat', 'penyakit_id', 'presentase', 'tingkat_kecenderungan'];

    public function Penyakit(){
        return $this->belongsTo(Penyakit::class, 'penyakit_id');
    } 
}
