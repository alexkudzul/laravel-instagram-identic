@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            {{-- Message success --}}
            @include('partials.message_success')

                <div class="card publication_image publication_image_detail">
                    <div class="card-header">
                        <div class="container-avatar">
                            <img src="{{Storage::url(auth()->user()->avatar)}}" class="avatar">
                        </div>
                        <div class="data-user">
                                {{$image->user->name.' '.$image->user->lastname}}
                                <span class="nickname">
                                    {{' | @'.$image->user->nickname}}
                                </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="container-image">
                            @if ($image->image_path)
                                {{--Funciona de igual manera como la clase Storage::url()--}}
                                {{-- <img src="/storage/{{$image->image_path}}"> --}}
                                <img src="{{Storage::url($image->image_path)}}">
                            @endif
                        </div>
                        <div class="description">
                            <span class="nickname">{{'@'.$image->user->nickname}} </span>
                            {{-- optional() verifica si el valor es nullo, y que no nos muestre de que el formato no existe--}}
                            <span class="date">{{' | '. optional($image->created_at)->diffForHumans()}}</span>
                            <span class="date">{{' | '. optional($image->created_at)->formatLocalized('%A %d %B %Y')}}</span>
                            <span class="date">{{' | hora: '. optional($image->created_at)->format('H:i a')}}</span>
                            <p>{{$image->description}}</p>
                        </div>
                        <div class="likes">

                            {{-- Comprobar si el user le dio like a la image --}}
                            <?php $user_like = false; ?>

                            @foreach ($image->likes as $like)
                                @if ($like->user->id == Auth::user()->id)
                                    <?php $user_like = true; ?>
                                @endif
                            @endforeach

                            @if ($user_like)
                                {{-- https://www.iconsdb.com/black-icons/hearts-icon.html --}}
                                <img src="{{asset('/img/heart-red.png')}}" data-id="{{$image->id}}" class="btn-unlike">
                            @else
                                {{-- https://www.iconsdb.com/black-icons/hearts-icon.html --}}
                                <img src="{{asset('/img/heart-black.png')}}" data-id="{{$image->id}}" class="btn-like">
                            @endif

                            <span class="number_likes">{{count($image->likes)}}</span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="comments">
                            <h2>Comments ({{count($image->comments)}})</h2>
                            <hr>
                            <form action="{{route('comments.store')}}" method="POST">
                                @csrf

                                <input type="hidden" name="image_id" value="{{$image->id}}" />
                                <p>
                                    <textarea class="form-control @error('content') is-invalid @enderror" name="content"> </textarea>

                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </p>
                                <button type="submit" class="btn btn-success">
                                    Send
                                </button>
                            </form>
                            <hr>
                            @foreach ($image->comments as $comment)
                                <div class="comment">
                                    <span class="nickname">{{'@'.$comment->user->nickname}} </span>
                                    {{-- optional() verifica si el valor es nullo, y que no nos muestre de que el formato no existe--}}
                                    <span class="date">{{' | '. optional($comment->created_at)->diffForHumans()}}</span>

                                    <p>{{$comment->content}} <br>
                                        {{-- Si esta autenticado y (Comprobar si es dueño del comentario o de la publicacion de la imagen) --}}
                                        @if (Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))

                                            <form action="{{route('comments.destroy', $comment->id)}}" method="POST" style="display:inline">
                                                {{-- laravel simula el method DELETE --}}
                                                @csrf {{method_field('DELETE')}}

                                                <button class="btn btn-sm btn-danger">
                                                    Delete
                                                </button>
                                            </form>

                                            <a href="{{route('comments.edit', $comment->id)}}" class="btn btn-sm btn-warning" >
                                                Edit
                                            </a>

                                        @endif

                                        {{-- Si esta autenticado y (Comprobar si es dueño del comentario o de la publicacion de la imagen) --}}
                                        {{-- @if (Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                            <a href="{{ route('comment.delete', $comment->id) }}" class="btn btn-sm btn-danger">
                                                Eliminar
                                            </a>

                                            <a href="{{route('comments.edit', $comment->id)}}" class="btn btn-sm btn-warning">
                                                Edit
                                            </a>
                                        @endif --}}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
