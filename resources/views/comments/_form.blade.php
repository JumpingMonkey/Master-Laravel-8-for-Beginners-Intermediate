<div class="mb-2 mt-3">
@auth
<form action="#" method="POST">
    @csrf

    <div class=" mb-3">
        <textarea id="content" class="form-control" name="content"></textarea>
    </div>

    <div class="d-grid gap-2">
        <input class="btn btn-primary mb-3" type="submit" value="Add comment">
    </div>
</form>
@else
    <a href="{{ route('login') }}"> Sign-in</a> to post comments!
@endauth
<hr/>
</div>
