<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role', 'name', 'lastname', 'nickname', 'avatar', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relacion One To Many / de uno a muchos
    // Un Usuario tiene muchas imagenes
    public function images(){
        return $this->hasMany(Image::class);
    }

    // Mutador, recibe el pass y lo encripta
    /* Nota: desactivar el hash que se encuentra en Auth\RegisterController.php
        para que no haga doble encriptacion al registrar un user*/
    public function setPasswordAttribute($password){
        $this->attributes['password'] = bcrypt($password);
    }
}
