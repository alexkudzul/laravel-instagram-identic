@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            {{-- si la session tiene un mensaje con la llave flash y si tiene--}}
            @if (session()->has('flash'))
                {{-- se visualiza el mensaje del flahs declara en el controlador --}}
                <div class="alert alert-success">{{session('flash')}}</div>
            @endif

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
                            <img src="{{asset('img/heart-black.png')}}">
                            <span class="number_likes">{{count($image->likes)}}</span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="comments">
                            <h2>Comments ({{count($image->comments)}})</h2>
                            <hr>

                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
