@forelse($comments as $comment)
    <p>
        {{ $comment->content }}
    </p>
    <x-tags :tags="$comment->tags"></x-tags>
    @component('components.updated', ['date' => $comment->created_at, 'name' => $comment->user->name, 'userId' => $comment->user->id])
    @endcomponent
@empty
    <a>No comments yes!</a>
@endforelse
