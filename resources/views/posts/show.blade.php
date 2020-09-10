@extends('base')

@section('content')
    <div class="text-right">
        <a href="{{ url('/posts') }}"><button class="btn btn-success">Back</button></a>
    </div>

    <div class="container">
        <div class="card text-center">
            <div class="card-header">
                <h3>{{ $post->title }}</h3>
            </div>

            <div class="card-body">
                <div class="bg-dark text-light">Author {{ $post->user->name }}</div>
                <hr>
                <p class="card-text">{{ $post->body }}</p>
                <hr>
                <div class="text-left">
                    <span class="alert bg-dark text-light p-2">{{ $post->category->category }}</span>
                    <span class="alert bg-info text-light p-2">{{ count($post->comments) }} comments</span>
                </div>
            </div>

            <div class="card-footer text-muted">
                <div class="text-left">
                    {{ $post->updated_at->diffForHumans() }} updated
                </div>
                <div class="text-right">
                    {{ $post->created_at->diffForHumans() }} published
                </div>
            </div>      
        </div>
    </div>

    @if (count($post->comments) > 0)
        @foreach ($post->comments as $comment)
        <hr>
        <div class="container">
            <div class="card text-center">
                <div class="card-header">
                    <h5>Comment</h5>
                </div>

                <div class="card-body">
                    <div class="bg-dark text-light">Author {{ $comment->name }}</div>
                    <hr>
                    <p class="card-text">{{ $comment->comment }}</p>
                </div>

                <div class="card-footer text-muted text-right">
                    {{ $comment->created_at->diffForHumans() }} published
                </div>      
            </div>
        </div>
        @endforeach
    @endif 
@endsection
