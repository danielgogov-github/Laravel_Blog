@extends('base')

@section('content')
    <div class="text-right">
        <a href="{{ url('/categories/create') }}"><button class="btn btn-success">Create category</button></a>
    </div>
    <hr>

    <div class="text-center">
        <div class="row bg-dark text-light p-2">
            <div class="col">Category</div>
            <div class="col">Edit</div>
            <div class="col">Delete</div>
        </div>
        <hr>

        @forelse ($all_categories as $category)
            <div class="row">
                <div class="col">{{ $category->category }}</div>
                <div class="col"><a href="{{ url('/categories/'. $category->id .'/edit') }}"><button class="btn btn-dark">Edit</button></a></div>
                <div class="col">
                    <form action="{{ url('/categories/'. $category->id) }}" method="POST">
                        @method("DELETE")
                        @csrf
                        <button 
                            type="submit" class="btn btn-danger" 
                            onclick="return confirm('Are you sure you want to delete the category {{ $category->category }} and all of its posts?')">Delete
                        </button>
                    </form>
                </div>
            </div>
            <hr>
        @empty
            <h4>No categories yet</h4>
        @endforelse
    </div>

    {{ $all_categories->links() }}
@endsection
