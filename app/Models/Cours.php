<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    //private mixed $intitule;

    protected $table = 'cours';

    public $timestamps = false;

    protected $fillable = ['id','intitule', 'created_at', 'updated_at'];

    public function user(){
        return $this->belongsToMany(User::class, 'cours_users', 'cours_id', 'user_id');
    }

    public function etudiants(){
        return $this->belongsToMany(Etudiants::class, 'cours_etudiants', 'cours_id','etudiant_id');
    }

    public function seances(){
        return $this->hasMany(Seances::class);
    }
}
