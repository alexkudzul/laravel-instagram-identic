@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="profile-user">

				@if($user->avatar)
					<div class="container-avatar">
						<img src="{{Storage::url($user->avatar)}}" alt="">
					</div>
				@endif

				<div class="user-info">
					<h1>{{'@'.$user->nickname}}</h1>
					<h2>{{$user->name .' '. $user->lastname}}</h2>
                    {{-- optional() verifica si el valor es nullo, y que no nos muestre el error, que el formato no existe--}}
                    <p>{{'Joined in: '. optional($user->created_at)->formatLocalized('%B %Y')}}</p>
                    {{-- <p>{{'Joined in: '. optional($user->created_at)->diffForHumans()}}</p> --}}
				</div>
            </div>

            <hr>

            {{-- Recorre las images que tiene el user --}}
            @foreach ($user->images as $image)
                {{-- Se le pasa la variable image a la vista --}}
                @include('partials.image', ['image' => $image])
            @endforeach

        </div>
    </div>
</div>
@endsection
