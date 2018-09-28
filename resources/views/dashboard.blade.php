@extends('layouts.profile')

@section('content')
    <div class="well">
        <div class="widget">
            <h3>Posts ( {{ $posts->count() }} )</h3>
            <table class="table table-borderless">
                <tbody>
                @foreach ($posts as $post)
                    <tr class="border-bottom">
                        <td>
                            <div class="post-content">
                                <a href="{{ route('post.show', $post->id) }}" target="_blank"
                                   class="">{{ $post->post_title }}</a>
                            </div>
                        </td>
                        <td class="text-right">
                            <div class="btn-group-sm">
                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-dark">
                                    <i class="material-icons small">edit</i>
                                </a>
                                <a href="#" class="btn btn-danger">
                                    <i class="material-icons small">delete</i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="well mt-4">
        <div class="widget">
            <h3>Comments ( {{ $comments->count() }} )</h3>
            <table class="table table-borderless">
                <tbody>
                @foreach($comments as $comment)
                    <tr class="border-bottom">
                        <td>
                            <div class="post-content">
                                <p class="text-dark">
                                    {{ $comment->comment }}
                                </p>
                                <p>
                                    In post
                                    <a class="small" href="{{ route('post.show', $comment->post_id) }}">
                                        {{ $comment->comment }}
                                    </a>
                                    on {{ $comment->created_at }}
                                </p>
                            </div>
                        </td>
                        <td class="text-right">
                            <div class="btn-group-sm">
                                <a href="#" class="btn btn-dark"><i class="material-icons small">edit</i></a>
                                <a href="#" class="btn btn-danger"><i class="material-icons small">delete</i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection