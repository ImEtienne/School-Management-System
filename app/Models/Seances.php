<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seances extends Model
{
    use HasFactory;

    protected $table = 'seances';

    public $timestamps = false;

    protected $fillable = ['id', 'cours_id', 'date_debut', 'date_fin'];

    public function etudiants(){
        return $this->belongsToMany(Etudiants::class, 'presences', 'etudiant_id', 'seance_id');
    }

    public function cours(){
        return $this->belongsTo(Cours::class, 'cours_id', 'id');
    }
}
