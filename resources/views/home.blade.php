@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- si la session tiene un mensaje con la llave flash y si tiene--}}
            @if (session()->has('flash'))
                {{-- se visualiza el mensaje del flahs declara en el controlador --}}
                <div class="alert alert-success">{{session('flash')}}</div>
            @endif

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
