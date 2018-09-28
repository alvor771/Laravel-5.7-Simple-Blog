@extends('layouts.blog')

@section('content')

    @foreach($posts as $post)


        <article id="post-{{ $post->id }}" class="mb-4">
            <div class="blog-item-wrap">

                <a href="{{ route('post.show', ['id' => $post->id]) }}" title="{{ $post->post_title }}">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="" title=""
                         style="height: auto; max-width: 100%;"/>
                </a>

                <div class="post-inner-content border-top">
                    <header class="entry-header page-header">
                        <h2 class="entry-title">
                            <a href="{{ route('post.show', ['id' => $post->id]) }}">{{ $post->post_title }}</a>
                        </h2>
                        <div class="entry-meta">
                            <span class="text-secondary">
                                <i class="material-icons align-middle">date_range</i>
                                <span class="d-inline-block align-middle">{{ date('M d, Y', strtotime($post->created_at)) }}</span>
                                <i class="material-icons align-middle">account_box</i>
                                <span class="d-inline-block align-middle">{{ $post->user->name }}</span>
                                @if ($post->comments->count())
                                    <i class="material-icons align-middle">comment</i>
                                    <span class="d-inline-block align-middle">{{ $post->comments->count() }}
                                        Comment(s)</span>
                                @endif
                                <i class="material-icons align-middle">remove_red_eye</i>
                                <span class="d-inline-block align-middle">{{ $post->views }}</span>
                            </span>
                        </div>
                    </header>

                    <div class="entry-content">
                        {!! substr(strip_tags($post->post_data), 0, 550) . ' ...' !!}
                        <div class="text-right">
                            <a class="btn btn-red" href="{{ route('post.show', ['id' => $post->id]) }}"
                               title="{{ $post->post_title }}">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    @endforeach

    {{ $posts->links() }}

@endsection