@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Friends</h1>
                {{-- id=searching se ejecuta en main.js --}}
                <form method="GET" action="{{ route('users.index') }}" id="searching">
                    <div class="row">
                        <div class="form-group col">
                            <input type="text" id="search" class="form-control" />
                        </div>
                        <div class="form-group col btn-search">
                            <input type="submit" value="Search" class="btn btn-success"/>
                        </div>
                    </div>
                </form>
            <hr>

            @foreach ($users as $user)
                <div class="profile-user">

                    @if($user->avatar)
                        <div class="container-avatar">
                            <img src="{{Storage::url($user->avatar)}}" alt="">
                        </div>
                    @endif

                    <div class="user-info">
                        <h2>{{'@'.$user->nickname}}</h2>
                        <h3>{{$user->name .' '. $user->lastname}}</h3>
                        {{-- optional() verifica si el valor es nullo, y que no nos muestre el error, que el formato no existe--}}
                        <p>{{'Joined in: '. optional($user->created_at)->formatLocalized('%B %Y')}}</p>
                        {{-- <p>{{'Joined in: '. optional($user->created_at)->diffForHumans()}}</p> --}}
                        <a href="{{route('users.show', $user->id)}}" class="btn btn-success">View profile</a>
                    </div>
                    {{-- clearfix clase de bootstrap, limpia flotados --}}
                    <div class="clearfix"></div>
                    <hr>
                </div>
            @endforeach

            {{-- Paginación --}}
            {{$users->links()}}
        </div>
    </div>
</div>
@endsection
