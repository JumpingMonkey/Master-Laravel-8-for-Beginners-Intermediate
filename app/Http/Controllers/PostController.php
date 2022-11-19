<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            'create',
            'store',
            'edit',
            'destroy',
            'update'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return array[]|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => BlogPost::latestWithRelations()
                ->get(),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
//        $this->authorize('posts.create');
//        $this->authorize('create', BlogPost::class);


        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePost $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;
        $post = BlogPost::create($validated);

        if($request->hasFile('thumbnail'))
        {
            $path = $request->file('thumbnail')->store('thumbnails');
            $post->image()->save(
                Image::create([
                    'path' => $path,
                ])
            );
        }

        $request->session()->flash('status', 'The blog post was created!');

        return redirect()->route('posts.show', ['post' => $post->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $blogPost = Cache::tags(['blog-post'])->remember("blog-post-{$id}", now()->addSeconds(10), function () use($id){
            return BlogPost::with('comments', 'tags', 'user', 'comments.user')
                ->findOrFail($id);
        });

        $sessionId = session()->getId();
        $counterKey = "blog-post-{$id}-counter";
        $userKey = "blog-post-{$id}-users";

        $users = Cache::tags(['blog-post'])->get($userKey, []);
        $usersUpdate = [];
        $difference = 0;
        $now = now();

        foreach ($users as $session => $lastVisit){
            if($now->diffInMinutes($lastVisit) >= 1){
                $difference--;
            } else {
                $usersUpdate[$session] = $lastVisit;
            }
        }

        if (!array_key_exists($sessionId, $users)
        OR now()->diffInMinutes($users[$sessionId]) >= 1
        ){
            $difference++;
        }

        $usersUpdate[$sessionId] = $now;
        Cache::tags(['blog-post'])->forever($userKey, $usersUpdate);

        if (!Cache::tags(['blog-post'])->has($counterKey)) {
            Cache::tags(['blog-post'])->forever($counterKey, 1);
        } else {
            Cache::tags(['blog-post'])->increment($counterKey, $difference);
        }

        $counter = Cache::tags(['blog-post'])->get($counterKey);

        return view('posts.show', [
            'post' => $blogPost,
            'counter' => $counter,
        ]);
//        return view('posts.show', ['post' => BlogPost::with(['comments'=> function($q){
//            $q->latest();
//        }])->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);

//        if(Gate::denies('update-post', $post)){
//            abort(403);
//        }

//        $this->authorize('posts.update', $post);
        $this->authorize('update', $post);

        return view('posts.edit', ['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrFail($id);

//        if(Gate::denies('update-post', $post)){
//            abort(403);
//        }

//        $this->authorize('posts.update', $post);
        $this->authorize('update', $post);

        $validated = $request->validated();
        $post->fill($validated);

        if($request->hasFile('thumbnail'))
        {
            $path = $request->file('thumbnail')->store('thumbnails');

            if ($post->image){
                Storage::delete($post->image->path);
                $post->image->path = $path;
                $post->image->save();
            } else {
                $post->image()->save(
                    Image::create([
                        'path' => $path,
                    ])
                );
            }
        }

        $post->save();

        $request->session()->flash('status', 'Blog post was updated!');

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);

//        if(Gate::denies('delete-post', $post)){
//            abort(403, "You can't delete this post!");
//        }

//        $this->authorize('posts.delete', $post);
        $this->authorize('delete', $post);

        $post->delete();

        session()->flash('status', 'Post was deleted!');

        return redirect()->route('posts.index', ['posts' => BlogPost::all()]);
    }
}
