@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- Message success --}}
            {{-- @include('partials.message_success') --}}

            {{-- Message error --}}
            @include('partials.message_error')

            <div class="card">
                <div class="card-header">{{ __('Update image') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('images.update', $image->id)}}" enctype="multipart/form-data">
                        @csrf

                        {{-- laravel simula el method PUT --}}
                        {{method_field('PUT')}}

                        <div class="form-group row">
                            <label for="image_path" class="col-md-3 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-7">
                                @if ($image->image_path)
                                {{--Funciona de igual manera como la clase Storage::url()--}}
                                {{-- <img src="/storage/{{$image->image_path}}"> --}}
                                <div class="container-avatar">
                                    <img src="{{Storage::url($image->image_path)}}" class="avatar">
                                </div>
                                @endif
                                <input id="image_path" type="file" class="form-control @error('image_path') is-invalid @enderror" name="image_path">

                                @error('image_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-3 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-7">
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="5" autocomplete="description" autofocus>{{$image->description}}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update image') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
