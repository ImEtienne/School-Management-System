<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursUsers extends Model
{
    use HasFactory;

    protected $table = 'cours_users';

    public $timestamps = false;

    protected $fillable = ['cours_id', 'user_id'];
}
