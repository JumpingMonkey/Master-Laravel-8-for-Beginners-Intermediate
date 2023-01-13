<div class=" mb-3">
    <label for="title">Title</label>
    <input id="title" class="form-control" type="text" name="title" value="{{ old('title', optional($post ?? null)->title) }}">
</div>
<x-error fieldName="title"></x-error>
<div class=" mb-3">
    <label for="content">Content</label>
    <textarea id="content" class="form-control" name="content">{{  old('content', optional($post ?? null)->content) }}</textarea>
</div>

<div class="mb-3">
    <label for="file" class="form-label">Thumbnail</label>
    <input id="file" class="form-control" type="file" name="thumbnail"/>
</div>

@component('components.errors')
@endcomponent
