@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible text-center">{{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>                
        </div>
    @endforeach
@endif

@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show text-center">{{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
