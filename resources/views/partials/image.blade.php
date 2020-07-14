<div class="card publication_image">
    <div class="card-header">
        <div class="container-avatar">
            <img src="{{Storage::url(auth()->user()->avatar)}}" class="avatar">
        </div>
        <div class="data-user">
            <a href="{{route('users.show', $image->user->id)}}">
                {{$image->user->name.' '.$image->user->lastname}}
                <span class="nickname">
                    {{' | @'.$image->user->nickname}}
                </span>
            </a>
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
            {{-- optional() verifica si el valor es nullo, y que no nos muestre de que formato no existe--}}
            <span class="date">{{' | '. optional($image->created_at)->diffForHumans()}}</span>
            {{-- <span class="date">{{' | '. optional($image->created_at)->formatLocalized('%A %d %B %Y')}}</span> --}}

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

        <div class="comments">
            <a href="{{route('images.show', $image->id)}}" class="btn btn-sm btn-comments">
                Comments ({{count($image->comments)}})
            </a>
        </div>
    </div>
</div>
