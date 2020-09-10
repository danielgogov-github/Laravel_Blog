@extends('base')

@section('content')
    <div class="text-right">
        <a href="{{ url('/comments') }}"><button class="btn btn-success">Back</button></a>
    </div>

    <div class="container">
        <div class="card text-center">
            <div class="card-header">
                <h3>Comment</h3>
            </div>

            <div class="card-body">
                <div class="bg-dark text-light">Author {{ $comment->name }}</div>
                <hr>
                <p class="card-text">{{ $comment->comment }}</p>
                <hr>
                <div class="text-left">
                    <span class="alert bg-dark text-light p-2">{{ $comment->post->title }}</span>
                    <span class="alert bg-info text-light p-2">{{ $comment->email }}</span>
                </div>
            </div>

            <div class="card-footer text-muted">
                <div class="text-right">
                    {{ $comment->created_at->diffForHumans() }} published
                </div>
            </div>      
        </div>
    </div>
@endsection
