@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1 style="text-align: center">Favorite images</h1>
            <hr>

            @foreach ($likes as $like)
                {{-- Se le pasa la variable image a la vista, accediendo a la relacion image del modelo Like --}}
                @include('partials.image', ['image' => $like->image])
            @endforeach

            {{-- Paginación --}}
            {{$likes->links()}}
        </div>
    </div>
</div>
@endsection
