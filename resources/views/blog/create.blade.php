@extends('layouts.profile')

@section('content')
    <div class="well">
        <div class="widget">
            <h3 class="widget-title">Add new post</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br/>
            @endif
            <form method="post" action="{{ route('blog-store') }}" enctype="multipart/form-data">
                <div class="form-group">
                    @csrf
                    <label for="image">Image preview:</label>
                    <input type="file" class="form-control border-0" name="image"/>
                </div>
                <div class="form-group">
                    <label for="price">Title:</label>
                    <input type="text" class="form-control" name="post_title"/>
                </div>
                <div class="form-group">
                    <label for="quantity">Content:</label>
                    <textarea class="form-control ckeditor" rows="8" name="post_data"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ url('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
        $('.ckeditor').ckeditor();
    </script>
@endsection