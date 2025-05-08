<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiants extends Model
{
    use HasFactory;

    protected $table = 'etudiants';

    public $timestamps = false;

    protected $fillable = ['id','nom','prenom','noet', 'created_at', 'updated_at'];


    public function cours(){
        return $this->belongsToMany(Cours::class,'cours_etudiants', 'etudiant_id', 'cours_id');
    }

    public function seances(){
        return $this->belongsToMany(Seances::class, 'presences', 'etudiant_id', 'seance_id');
    }
}
