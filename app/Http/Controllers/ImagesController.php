<?php

namespace App\Http\Controllers;

use App\Like;
use App\Image;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate(['rules'], [''messages]);
        $this->validate($request, [
            'image_path'  => 'required|image',
            'description' => 'required'
        ], [
            'image_path.required' => 'Seleccione una imagen',
            'image_path.image' => 'Selecciona una imagen con el formato: jpg, jpeg, png y gif'
        ]);

        $image = new Image();
        $image->image_path = $request->file('image_path')->store('images', 'public');
        $image->description = $request->input('description');
        // $image->user_id = Auth::user()->id; // atraves del metodo Auth
        $image->user_id = $request->user()->id; // atraves de la relacion user del modelo Image
        $image->save();

        return redirect()->route('home')->with('flash', 'Image upload successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = Image::find($id);

        return view('images.show', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $image = Image::find($id);

        if ($user && $image && $image->user->id == $user->id) {
            return view('images.edit', [
                'image' => $image
            ]);
        } else {
            // return redirect()->route('home');
            return back()->with('flash', 'Can not edit image ');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $request->validate(['rules'], [''messages]);
        $this->validate($request, [
            'image_path'  => 'image',
            'description' => 'required'
        ], [
            'image_path.required' => 'Seleccione una imagen',
            'image_path.image' => 'Selecciona una imagen con el formato: jpg, jpeg, png y gif'
        ]);

        $image = Image::find($id);

        // Validar image
        if ($request->hasFile('image_path')) {
            $image->image_path = $request->file('image_path')->store('images', 'public');
        }

        $image->description = $request->input('description');
        // $image->user_id = Auth::user()->id; // atraves del metodo Auth
        $image->user_id = $request->user()->id; // atraves de la relacion user del modelo Image
        $image->update();

        return redirect()->route('images.show', $image)->with('flash', 'Image update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Recoger datos del user, image, commnts y likes
        $user = Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();

        // Si el user esta identificado
        // Si el image fue encontrado
        // Si el image le pertenece al user identificado
        if ($user && $image && $image->user->id == $user->id) {

            // Eliminar comentarios
            if ($comments && count($comments) >= 1) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }

            // Eliminar likes
            if ($likes && count($likes) >= 1) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }

            // Eliminar ficheros de image
            Storage::disk('public')->delete($image->image_path);

            // Eliminar registro en la db
            $image->delete();

            $message = array('flash' => 'Image deleted sucessfully');
        } else {

            $message = array('flash' => 'Image not deleted');
        }

        return redirect()->route('home')->with($message);
    }
}
