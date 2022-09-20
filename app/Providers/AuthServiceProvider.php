<?php

namespace App\Providers;

use App\Models\BlogPost;
use App\Policies\BlogPostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Models\Model' => 'App\Policies\ModelPolicy',
        BlogPost::class => BlogPostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Gate::define('update-post', function ($user, $post){
//            return $user->id == $post->user_id;
//        });
//
//        Gate::define('delete-post', function ($user, $post){
//            return $user->id == $post->user_id;
//        });

//        Gate::define('posts.update', [BlogPostPolicy::class, 'update']);
//        Gate::define('posts.delete', [BlogPostPolicy::class, 'delete']);

//        Gate::resource('posts', BlogPostPolicy::class);
        // posts.create, posts.view, posts.update, posts.delete,

//        Gate::before(function ($user, $ability){
//            return $user->is_admin && in_array($ability, ['posts.update']);
//        });

    //        Gate::after(function ($user, $ability, $result){
    //            return $user->is_admin;
    //        });
    }
}
