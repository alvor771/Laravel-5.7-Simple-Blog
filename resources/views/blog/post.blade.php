@extends('layouts.blog')

@section('content')
    <article id="post-{{ $post->id }}" class="mb-4">
        <div class="blog-item-wrap">
            <img src="{{ asset('storage/' . $post->image) }}" alt="" title="" style="height: auto; max-width: 100%;"/>
            <div class="post-inner-content">
                <header class="entry-header page-header">
                    <h1 class="entry-title">{{ $post->post_title }}</h1>
                    <div class="entry-meta">
                            <span class="text-secondary">
                                <i class="material-icons align-middle">date_range</i>
                                <span class="d-inline-block align-middle">{{ date('M d, Y', strtotime($post->created_at)) }}</span>
                                <i class="material-icons align-middle">account_box</i>
                                <span class="d-inline-block align-middle">{{ $post->user->name }}</span>
                                <i class="material-icons align-middle">remove_red_eye</i>
                                <span class="d-inline-block align-middle">{{ $post->views }}</span>
                            </span>
                    </div>
                </header>

                <div class="entry-content">
                    <p>{!! $post->post_data !!} </p>
                </div>
            </div>
        </div>
    </article>


    <h2 class="comments-title">{{ $post->comments->count() }} comments to “{{ $post->post_title }}”</h2>

    <ol class="comment-list">

        @foreach($post->comments as $comment)


            <li id="comment-{{ $comment->id }}" class="comment even thread-even depth-1 parent">
                <article id="div-comment-1435" class="comment-body">
                    <footer class="comment-meta">
                        <div class="comment-metadata">
                            {{ date('M d, Y at  H:i', strtotime($comment->created_at)) }}
                        </div><!-- .comment-metadata -->

                        <div class="comment-author vcard">
                            <img alt=""
                                 src="https://secure.gravatar.com/avatar/b642b4217b34b1e8d3bd915fc65c4452?s=60&amp;d=mm&amp;r=g"
                                 class="avatar avatar-60 photo grav-hashed grav-hijack" height="60" width="60">
                            <b class="fn">{{ $comment->user->name }}</b>
                        </div><!-- .comment-author -->
                    </footer><!-- .comment-meta -->

                    <div class="comment-content">
                        <p>{{ $comment->comment }}</p>
                    </div><!-- .comment-content -->

                    <div class="reply">
                        <a rel="nofollow" class="comment-reply-link btn btn-sm btn-default"
                           href="#comment-1435">Reply</a>
                        @if (Auth::check() && Auth::user()->id == $comment->user->id)
                            <a rel="nofollow" class="comment-reply-link btn btn-sm btn-default"
                               href="#comment-1435">Edit</a>
                            <a rel="nofollow" class="comment-reply-link btn btn-sm btn-default"
                               href="#comment-1435">Delete</a>
                        @endif
                    </div>
                </article>

            </li>
        @endforeach
    </ol>

    @if (Auth::check())
    <div class="well">
        <form action="{{ route('comment.store') }}" method="post" id="comment_form"
              class="comment-form">
            <div class="form-row">
                @csrf
                <textarea class="form-control border-0" name="comment" rows="8" required="required"
                      placeholder="Enter Your comment here"></textarea>
            </div>

            <div class="form-row mt-3">
                <input name="submit" type="submit" id="submit" class="btn btn-default float-right" value="Post Comment">
            </div>

            <input type="hidden" name="comment_post_id" value="{{ $post->id }}" id="comment_post_id">
        </form>
    </div>
    @endif

@endsection