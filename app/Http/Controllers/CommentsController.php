<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|string',
            'image_id' => 'required|string'
        ]);

        $comments = new Comment();
        $comments->content = $request->input('content');
        $comments->user_id = Auth::user()->id;
        $comments->image_id = $request->input('image_id');
        $comments->save();

        return redirect()->route('images.show', ['id' => $comments->image_id])
                            ->with('flash', 'Comments public successfully ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('comments.edit', compact('comment'));
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
        $this->validate($request, [
            'content' => 'required|string'
        ]);

        $comment = Comment::find($id);
        $comment->content = $request->input('content');
        $comment->update();

        return redirect()->route('images.show', ['id' => $comment->image->id])
                            ->with('flash', 'Comment update successfully ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $userAuth = Auth::user();

        // Si esta autenticado y (Comprobar si es dueño del comentario o de la publicacion de la imagen)
        if($userAuth && ( $comment->user_id == $userAuth->id || $comment->image->user_id == $userAuth->id)){
            $comment->delete();

            return redirect()->route('images.show', ['id' => $comment->image->id])
                            ->with('flash', 'Comment delete successfully ');
        }else{

            return redirect()->route('images.show', ['id' => $comment->image->id])
                            ->with('flash', 'Comment not delete ');
        }
    }
}
