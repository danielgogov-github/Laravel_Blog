@extends('base')

@section('content')
    <div class="text-right">
        <a href="{{ url('/') }}"><button class="btn btn-success">Back</button></a>
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
    <hr>

    @if (count($post->comments) > 0)
        @foreach ($post->comments as $comment)
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
            <hr>
        </div>
        @endforeach
    @endif
        
        
    <div class="text-center">
        <h3>Add a comment</h3>
    </div>
    <hr>

    <div class="container">
        <form action="{{ url('show/'. $post->id) }}" method="POST">
            @method('POST')
            @csrf
    
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                <small class="form-text text-muted">Enter your name</small>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                <small class="form-text text-muted">Enter your email</small>
            </div>
        
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea name="comment" rows="6" class="form-control" required>{{ old('comment') }}</textarea>
                <small class="form-text text-muted">Enter your comment</small>
            </div>
            
            <div class="text-center">
                <button type="submit" class="btn btn-success">Add</button>
            </div>
        </form>
    </div>        
@endsection
