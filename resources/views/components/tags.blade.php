<p>
    @foreach($tags as $tag)
        <a href="{{ route('posts.tags.index', ['id' => $tag->id]) }}"
           class="badge bg-success badge-lg">{{ $tag->name }}</a>
    @endforeach
</p>
