<?php

namespace App\Http\Controllers;

use App\Image;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $user = Auth::user();

        // Likes del usuario autenticado
        $likes = Like::where('user_id', $user->id)
                        ->orderBy('id', 'desc')
                            ->paginate(5);

        return view('likes.index', compact('likes'));
    }

    public function like($id)
    {
        // Obtener datos del user y de image
        $user = Auth::user();
        $image = Image::find($id);

        // Verifica si ya existe el like y no duplicar
        // count devuelve la cantidad de likes o filas que esta en la db
        $existLike = Like::where('user_id', $user->id)
            ->where('image_id', $image->id)
            ->count();

        // Si no existe un like, agregar uno nuevo
        if ($existLike == 0) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = $image->id;
            $like->save();

            // Se devuelve json, sera consultado por ajax
            return response()->json([
                'like' => $like,
            ]);
        } else {
            return response()->json([
                'message' => 'Exist like'
            ]);
        }
    }

    public function unlike($id)
    {
        // Obtener datos del user y de image
        $user = Auth::user();
        $image = Image::find($id);

        // Verifica si ya existe el like y no duplicar
        // first devuelve un elemento de la db
        $like = Like::where('user_id', $user->id)
                    ->where('image_id', $image->id)
                    ->first();

        if ($like) {

            $like->delete();

            // Se devuelve json, sera consultado por ajax
            return response()->json([
                'like' => $like,
                'message' => 'Unlike sucessfully'
            ]);
        } else {
            return response()->json([
                'message' => 'Not exist like'
            ]);
        }
    }
}
