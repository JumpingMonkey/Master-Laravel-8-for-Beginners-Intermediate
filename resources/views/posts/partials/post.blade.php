<h3><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{$post->title}}</a></h3>

<p class="text-muted">
    Added {{ $post->created_at->diffForHumans() }}
    by {{ $post->user->name }}
</p>

@if($post->comments_count)
    <p>{{ $post->comments_count }} comments</p>
@else
    <p>No comments yet!</p>
@endif
<div class="mb-3">
    <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit</a>
    <form class="d-inline" method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
        @csrf
        @method('DELETE')
        <input class="btn btn-primary" type="submit" value="Delete!">
    </form>
</div>
