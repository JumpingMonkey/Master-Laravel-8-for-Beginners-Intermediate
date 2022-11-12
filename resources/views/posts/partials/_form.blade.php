<div class=" mb-3">
    <label for="title">Title</label>
    <input id="title" class="form-control" type="text" name="title" value="{{ old('title', optional($post ?? null)->title) }}">
</div>
{{--@component('components.error', ['fieldName' => 'title'])--}}
{{--@endcomponent--}}
<x-error fieldName="title"></x-error>
<div class=" mb-3">
    <label for="content">Content</label>
    <textarea id="content" class="form-control" name="content">{{  old('content', optional($post ?? null)->content) }}</textarea>
</div>
@component('components.errors')
@endcomponent