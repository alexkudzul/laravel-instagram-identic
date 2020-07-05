<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /*deshabilita la proteccion de asginacion masiva de datos*/
    // protected $guarded =[];
    // Si la tabla es diferente a la migracion se puede nombrar de la siguiente forma:
    // protected $table = "comments";

    protected $fillable = [
        'content', 'user_id', 'image_id'
    ];

    // Relacion Many to One / de muchos a uno
    // Un Comentario pertenece a una imagen
    public function image()
    {
        return $this->belongsTo(Image::class);
    }
    // Relacion Many to One / de muchos a uno
    // Un Comentario pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
