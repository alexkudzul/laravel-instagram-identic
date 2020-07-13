<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'image_path', 'description', 'user_id'
    ];
    // Relacion One To Many / de uno a muchos
    // Una imagen tiene muchos comentarios
    public function comments(){
        return $this->hasMany(Comment::class)->orderBy('id', 'desc');
    }
    // Relacion One To Many / de uno a muchos
    // Una imagen tiene muchos likes
    public function likes(){
        return $this->hasMany(Like::class);
    }
    // Relacion Many to One / de muchos a uno
    // Una imagen pertenece a un usuario
    public function user(){
        return $this->belongsTo(User::class);
    }
}
