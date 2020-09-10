@php
   $input_value = old('category'); 
@endphp
@extends('base')

@section('content')
    <div class="text-right">
        <a href="{{ url('/categories') }}"><button class="btn btn-success">Back</button></a>
    </div>

    <div class="container">
        <form action="{{ url($form_array['action']) }}" method="POST">
            @method($form_array['method'])
            @csrf    

            <div class="form-group">
                <label for="category">Category</label>
                @isset($category->category)
                    @php
                        $input_value = $category->category;
                    @endphp
                @endisset
                <input type="text" name="category" value="{{ $input_value }}" class="form-control" required>
                <small class="form-text text-muted">Enter the category name here</small>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-dark">{{ $form_array['label'] }}</button>
            </div>
        </form>
    </div>
@endsection
