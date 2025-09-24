<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    use HasFactory;

    protected $table = "diagnosa";
    protected $fillable = ['user_id', 'nama', 'no_hp', 'alamat', 'pakar', 
    'kondisi', 'deskripsi', 'solusi', 'penyakit_id', 'presentase', 'tingkat_kecenderungan', 'status'];

    public function Penyakit(){
        return $this->belongsTo(Penyakit::class, 'penyakit_id');
    } 

    // Di model Diagnosa.php
public function gejala()
{
    return $this->belongsToMany(Gejala::class, 'diagnosa_gejala', 'diagnosa_id', 'gejala_id');
}

// Model Diagnosa.php
// public function pakar()
// {
//     return $this->belongsTo(User::class, 'pakar_id');
// }
// public function user()
// {
//     return $this->belongsTo(User::class, 'user_id');
// }

public function user()
{
    return $this->belongsTo(User::class);
}


}
