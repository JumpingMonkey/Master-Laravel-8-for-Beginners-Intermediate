@if(!isset($show) OR $show)
    <span class="badge text-bg-{{$type ?? 'success'}}">
        {{ $slot }}
    </span>
@endif
