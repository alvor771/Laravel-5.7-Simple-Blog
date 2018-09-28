@extends('layouts.profile')

@section('content')
    <div class="well">
        <div class="widget">
            <h3 class="widget-title">Edit "<i class="text-info">{{ $post->post_title }}</i>" post</h3>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
                <div class="form-group">
                    @method('PUT')
                    @csrf
                    <div class="image">
                        <img class="img-thumbnail" src="{{ asset('storage/' . $post->image) }}" title="" alt=""
                             width="100"/>
                        <a href="#" title="Change image">Change image</a>
                        <div class="change-image d-none">
                            <label for="image">Image:</label>
                            <input type="file" class="form-control" value="{{ $post->image }}" name="image"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price">Title:</label>
                    <input type="text" class="form-control" value="{{ $post->post_title }}" name="post_title"/>
                </div>
                <div class="form-group">
                    <label for="quantity">Content:</label>
                    <textarea class="form-control ckeditor" name="post_data">{{ $post->post_data }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('dashboard') }}" class="btn btn-dark">Back</a>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Initialize CKEditor -->
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        $('.ckeditor').ckeditor();
    </script>

    <!-- Other scripts -->
    <script>
        $(document).ready(function () {
            // Show image field for change current image
            $('.image a').on('click', function (e) {
                $('.change-image').removeClass('d-none');
                $(this).remove();
                e.preventDefault();
            });
        });
    </script>
@endsection