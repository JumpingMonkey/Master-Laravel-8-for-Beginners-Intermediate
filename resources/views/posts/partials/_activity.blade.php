<div class="container">
    <div class="row">
        @component('components.card', [
            'title' => 'Most active users',
            'subTitle' => 'Users with most posts written'])
            @slot('items')
                @foreach($mostCommented as $key => $post)
                    <li class="list-group-item">
                        <a href="{{ route('posts.show', ['post' => $post->id])}}">
                            {{ $post->title }}
                        </a>
                    </li>
                @endforeach
            @endslot
        @endcomponent
    </div>
    <div class="row mt-4">
        {{--                @component('components.card', [--}}
        {{--                    'title' => 'Most active users',--}}
        {{--                    'subtitle' => 'Users with most posts written',--}}
        {{--                    'items' => collect($mostActive)->pluck('name')])--}}
        {{--                @endcomponent--}}
        <x-card title="Most active users"
                sub-title="Users with most posts written"
                :items="collect($mostActive)->pluck('name')"
        ></x-card>
    </div>
    <div class="row mt-4">
        <x-card
            title="Most active users last month"
            sub-title="Users with most posts written last month"
            :items="collect($mostActiveLastMonth)->pluck('name')">
        </x-card>
    </div>
</div>
