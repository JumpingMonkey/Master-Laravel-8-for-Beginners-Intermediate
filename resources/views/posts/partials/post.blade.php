
<h3>
    @if($post->trashed())
        <del>
            @endif
    <a class="{{ $post->trashed() ? 'text-muted' : '' }}"
       href="{{ route('posts.show', ['post' => $post->id]) }}">{{$post->title}}</a>
            @if($post->trashed())
                </del>
    @endif
</h3>

@component('components.updated', ['date' => $post->created_at, 'name' => $post->user->name, 'userId' => $post->user->id])

@endcomponent

{{--@component('components.tags', ['tags' => $post->tags]) @endcomponent--}}
    <x-tags :tags="$post->tags"></x-tags>

{{--@if($post->comments_count)--}}
{{--    <p>{{ $post->comments_count }} comments</p>--}}
{{--@else--}}
{{--    <p>No comments yet!</p>--}}
{{--@endif--}}

{{ trans_choice('messages.comments', $post->comments_count) }}

<div class="mb-3">
@auth()
    @can('update', $post)
        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit</a>
    @endcan
@endauth
{{--    @cannot('delete', $post)--}}
{{--        <p>You can't delete this post!</p>--}}
{{--    @endcannot--}}

@auth()
    @if(!$post->trashed())
        @can('delete', $post)
            <form class="d-inline" method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                @csrf
                @method('DELETE')
                <input class="btn btn-primary" type="submit" value="Delete!">
            </form>
        @endcan
    @endif
@endauth
</div>
