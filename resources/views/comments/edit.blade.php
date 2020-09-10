@php
    $name_value = $comment->name;
    if(old('name') !== null) {
        $name_value = old('name');
    }
    $email_value = $comment->email;
    if(old('email') !== null) {
        $email_value = old('email');
    }
    $textarea_value = $comment->comment;
    if(old('comment') !== null) {
        $textarea_value = old('comment');
    }
@endphp
@extends('base')

@section('content')
    <div class="text-right">
        <a href="{{ url('/comments') }}"><button class="btn btn-success">Back</button></a>
    </div>

    <div class="container">
        <form action="{{ url('comments/'. $comment->id) }}" method="POST">
            @method('PUT')
            @csrf
    
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ $name_value }}" class="form-control" required>
                <small class="form-text text-muted">Enter your name</small>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ $email_value }}" class="form-control" required>
                <small class="form-text text-muted">Enter your email</small>
            </div>
        
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea name="comment" rows="6" class="form-control" required>{{ $textarea_value }}</textarea>
                <small class="form-text text-muted">Enter your comment</small>
            </div>
            
            <div class="text-center">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>     
@endsection
