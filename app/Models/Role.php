<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const ADMIN = 'admin';
    const USER = 'user';

    public $timestamps = false;

    protected $fillable = [
      'name',
      'slug',
    ];


    public function users(){
        return $this->belongsToMany(User::class , 'role_user' , 'role_id' , 'user_id');
    }

}
