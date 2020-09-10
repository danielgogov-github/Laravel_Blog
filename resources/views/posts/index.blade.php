@extends('base')

@section('content')
    <div class="text-right">
        <a href="{{ url('/posts/create') }}"><button class="btn btn-success">Create post</button></a>
    </div>
    <hr>

    <div class="text-center">
        <div class="row bg-dark text-light p-2">
            <div class="col">Title</div>
            <div class="col">Body</div>
            <div class="col">Category</div>
            <div class="col">User</div>
            <div class="col">Publish</div>
            <div class="col">Edit</div>
            <div class="col">Delete</div>
        </div>
        <hr>

        @forelse ($all_posts as $post)
            <div class="row">
                <div class="col"><a href="{{ url('posts/'. $post->id) }}">{{ $post->title }}</a></div>
                <div class="col">{{ \Illuminate\Support\Str::limit($post->body, 20) }}</div>
                <div class="col">{{ $post->category->category }}</div>
                <div class="col">{{ $post->user->name }}</div>
                <div class="col">
                    <form action="{{ url('/posts/publish/'. $post->id) }}" method="POST">
                        @method("PUT")
                        @csrf
                        @if ($post->published === 1)
                            <button 
                                type="submit" class="btn btn-success" 
                                onclick="return confirm('Are you sure you want to unpublish the post {{ $post->title }}?')">Published
                            </button>
                        @else
                            <button 
                                type="submit" class="btn btn-secondary" 
                                onclick="return confirm('Are you sure you want to publish the post {{ $post->title }}?')">Not published
                            </button>
                        @endif
                    </form>
                </div>
                <div class="col"><a href="{{ url('/posts/'. $post->id .'/edit') }}"><button class="btn btn-dark">Edit</button></a></div>
                <div class="col">
                    <form action="{{ url('/posts/'. $post->id) }}" method="POST">
                        @method("DELETE")
                        @csrf
                        <button 
                            type="submit" class="btn btn-danger" 
                            onclick="return confirm('Are you sure you want to delete the post {{ $post->title }} and all of its comments?')">Delete
                        </button>
                    </form>
                </div>
            </div>
            <hr>
        @empty
            <h4>No posts yet</h4>
        @endforelse
    </div>

    {{ $all_posts->links() }}
@endsection
