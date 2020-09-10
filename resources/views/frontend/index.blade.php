@extends('base')

@section('content')
    <div class="container">
        <form action="{{ url('/') }}" method="POST">
            @method("POST")
            @csrf
            <div class="row">
                <div class="col-xl-11">
                    <input type="text" name="search" value="" class="form-control">
                </div>
                <div class="col-xl-1">
                    <button type="submit" class="btn btn-dark">Search</button>
                </div>
            </div>
        </form>
    </div>
    <hr>

    <div class="card-columns">
        @forelse ($all_posts as $post)
            <div class="card text-center">
                <div class="card-header">
                    <h3>{{ $post->title }}</h3>
                </div>

                <div class="card-body">
                    <div class="bg-dark text-light text-center">Author {{ $post->user->name }}</div>
                    <hr>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($post->body, rand(100, 1000)) }}</p>
                    <hr>
                    <div class="text-left">
                        <span class="alert bg-dark text-light p-2">{{ $post->category->category }}</span>
                        <span class="alert bg-info text-light p-2">{{ count($post->comments) }} comments</span>
                    </div>
                    <div class="text-right"> 
                        <a href="{{ url('show/'. $post->id) }}"><button class="btn btn-success">See the post</button></a>
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
        @empty  
            <div class="text-center">
                <h3>No posts yet</h3>
            </div>
        @endforelse
    </div>

    {{ $all_posts->links() }}
@endsection
