<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursEtudiant extends Model
{
    use HasFactory;

    protected $table = 'cours_etudiants';

    public $timestamps = false;

    protected $fillable = ['cours_id', 'etudiant_id'];

    public function etudiants(){
        return $this->belongsToMany(Etudiants::class, 'cours_etudiants', 'cours_id', 'etudiant_id');
    }

    public function cours(){
        return $this->belongsToMany(Cours::class, 'cours_etudiants', 'cours_id', 'etudiant_id');
    }
}
