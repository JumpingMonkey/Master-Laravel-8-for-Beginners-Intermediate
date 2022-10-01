<div class="card" style="width: 100%;">
    <div class="card-body">
        <h5 class="card-title">{{ $title }}</h5>
        <h6 class="card-subtitle m-2 text-muted">{{ $subTitle }}</h6>
    </div>
    <ul class="list-group list-group-flush">
        @if(is_a($items, \Illuminate\Support\Collection::class) )
            @forelse($items as $item)
                <li class="list-group-item">
                    {{ $item }}
                </li>
            @empty
                <div>No comments yet!</div>
            @endforelse
        @else
            {{ $items }}
        @endif
    </ul>
</div>
