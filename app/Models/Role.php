<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'short_description',
        'long_description',
    ];
    public function users()
    { // dans la classe modèle Article
        return $this->hasMany(App\Models\User::class);
    }
}
