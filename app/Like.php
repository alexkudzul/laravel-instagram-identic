<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id', 'image_id'
    ];

    // Relacion Many to One / de muchos a uno
    // Un Like pertenece a una imagen
    public function image(){
        return $this->belongsTo(Image::class);
    }

    // Relacion Many to One / de muchos a uno
    // Un Like pertenece a una usuario
    public function user(){
        return $this->belongsTo(User::class);
    }
}
