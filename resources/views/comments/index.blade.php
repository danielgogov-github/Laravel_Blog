@extends('base')

@section('content')
    <div class="text-center">
        <div class="row bg-dark text-light p-2">
            <div class="col">Comment</div>
            <div class="col">From</div>
            <div class="col">Email</div>
            <div class="col">Post</div>
            <div class="col">Edit</div>
            <div class="col">Delete</div>
        </div>
        <hr>

        @forelse ($all_comments as $comment)
            <div class="row">
                <div class="col"><a href="{{ url('/comments/'. $comment->id) }}">{{ \Illuminate\Support\Str::limit($comment->comment, 20) }}</a></div>
                <div class="col">{{ \Illuminate\Support\Str::limit($comment->name, 20) }}</div>
                <div class="col">{{ \Illuminate\Support\Str::limit($comment->email, 20) }}</div>
                <div class="col">{{ \Illuminate\Support\Str::limit($comment->post->title, 20) }}</div>
                
                <div class="col"><a href="{{ url('/comments/'. $comment->id .'/edit') }}"><button class="btn btn-dark">Edit</button></a></div>

                <div class="col">
                    <form action="{{ url('/comments/'. $comment->id) }}" method="POST">
                        @method("DELETE")
                        @csrf
                        <button 
                            type="submit" class="btn btn-danger" 
                            onclick="return confirm('Are you sure you want to delete the comment {{ \Illuminate\Support\Str::limit($comment->comment, 25) }} from {{ \Illuminate\Support\Str::limit($comment->name, 25) }}?')">Delete
                        </button>
                    </form>
                </div>
            </div>
            <hr>
        @empty
            <h4>No comments yet</h4>    
        @endforelse
    </div>

    {{ $all_comments->links() }}
@endsection
