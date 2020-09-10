@php
    $input_categories = old('categories');
    $input_title = old('title'); 
    $post_body = old('body');
@endphp
@extends('base')

@section('content')
    <div class="text-right">
        <a href="{{ url('/posts') }}"><button class="btn btn-success">Back</button></a>
    </div>

    <div class="container">
        <form action="{{ url($form_array['action']) }}" method="POST">
            @method($form_array['method'])
            @csrf
            
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" class="form-control" required>
                    <option value="" selected disabled hidden>Categories</option>
                    @foreach ($categories as $key => $category)
                        @isset($post->category_id)
                            @if ($post->category_id === $key)
                                <option value="{{ $key }}" selected>{{ $category }}</option>
                                @continue
                            @endif
                        @endisset
                        <option value="{{ $key }}">{{ $category }}</option>
                        @if ($key === intval($input_categories))
                            <option value="{{ $key }}" selected>{{ $category }}</option>
                        @endif
                    @endforeach
                </select>
                <small class="form-text text-muted">Select the post category</small>
            </div>    

            <div class="form-group">
                <label for="title">Title</label>
                @isset($category->category)
                    @php
                        $input_title = $category->category;
                    @endphp
                @endisset
                @isset($post->title)
                    @php
                        $input_title = $post->title;
                    @endphp                
                @endisset
                <input type="text" name="title" value="{{ $input_title }}" class="form-control" required>
                <small class="form-text text-muted">Enter the post title</small>
            </div>

            @isset($post->body)
                @php
                    $post_body = $post->body;
                @endphp
            @endisset        
            <div class="form-group">
                <label for="body">Body</label>
                <textarea name="body" rows="8" class="form-control" required>{{ $post_body }}</textarea>
                <small class="form-text text-muted">Enter the post body</small>
            </div>
            
            <div class="form-group">
                <label for="publish">Publish</label>
                <select name="publish" class="form-control" required>
                    @if(isset($post->published))
                        @if ($post->published === 1)
                            <option value="1" selected>Yes</option>
                            <option value="0">No</option>
                        @else                        
                            <option value="1">Yes</option>
                            <option value="0" selected>No</option>
                        @endif
                    @else 
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>                    
                    @endisset                
                </select>
                <small class="form-text text-muted">Publish the post?</small>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-dark">{{ $form_array['label'] }}</button>
            </div>
        </form>
    </div>
@endsection
