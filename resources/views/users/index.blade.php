@extends('base')

@section('content')
    <div class="text-right">
        <a href="{{ url('/users/register') }}"><button class="btn btn-success">Create user</button></a>
    </div>
    <hr>

    <div class="text-center">
        <div class="row bg-dark text-light p-2">
            <div class="col">Username</div>
            <div class="col">Email</div>
            <div class="col">Created</div>
            <div class="col">Posts count</div>
            <div class="col">Delete</div>
        </div>
        <hr>

        @foreach ($all_users as $user)
            <div class="row">
                <div class="col">{{ $user->name }}</div>
                <div class="col">{{ $user->email }}</div>
                <div class="col">{{ $user->created_at }}</div>
                <div class="col">{{ count($user->posts) }}</div>            
                <div class="col">
                    <form action="{{ url('/users/'. $user->id) }}" method="POST">
                        @method("DELETE")
                        @csrf
                        @if ($user->id === Auth::user()->id)
                            <button class="btn btn-danger" disabled>Delete</button>
                        @else
                            <button 
                                type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete the user {{ $user->name }}?')">Delete
                            </button>
                        @endif
                    </form>
                </div>
            </div>
            <hr>
        @endforeach
    </div>

    {{ $all_users->links() }}
@endsection
