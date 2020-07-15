@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            {{-- Message error --}}
            @include('partials.message_error')

                <div class="card publication_image publication_image_detail">
                    <div class="card-header">
                        {{ __('Edit Comment') }}
                    </div>

                    <div class="card-body">
                        <div class="clearfix"></div>
                        <div class="comments">

                            <form action="{{route('comments.update', $comment->id)}}" method="POST">
                                @csrf

                                {{-- laravel simula el method PUT --}}
                                {{method_field('PUT')}}

                                <div class="form-group row">
                                    <textarea class="form-control @error('content') is-invalid @enderror" name="content"> {{old('content', $comment->content)}} </textarea>

                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-success">
                                            {{ __('Update comment') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
