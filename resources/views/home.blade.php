@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- Message success --}}
            @include('partials.message_success')

            @foreach ($images as $image)
                {{-- Se le pasa la variable image a la vista --}}
                @include('partials.image', ['image' => $image])
            @endforeach

            {{-- Paginación --}}
            {{$images->links()}}
        </div>
    </div>
</div>
@endsection
