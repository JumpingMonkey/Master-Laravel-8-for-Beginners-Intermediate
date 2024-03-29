<?php

namespace App\Providers;

use App\Contracts\CounterContract;
use App\Http\ViewComposers\ActivityComposer;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Observers\BlogPostObserver;
use App\Observers\CommentObserver;
use App\Services\Counter;
use App\Services\DummyCounter;
use App\View\Components\Badge;
use App\View\Components\Card;
use App\View\Components\CommentForm;
use App\View\Components\CommentList;
use App\View\Components\Error;
use App\View\Components\Errors;
use App\View\Components\Tags;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

use App\Http\Resources\Comment as CommentResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Blade::component('components.badge', 'badge');
        Blade::component('components.updated', 'updated');
        Blade::component(Card::class, 'card');
        Blade::component(Tags::class, 'tags');
        Blade::component(Errors::class, 'errors');
        Blade::component(Error::class, 'error');
        Blade::component(CommentForm::class, 'commentForm');
        Blade::component(CommentList::class, 'commentList');

//        view()->composer(['*'], ActivityComposer::class);
        view()->composer(['posts.index', 'posts.show'], ActivityComposer::class);

        BlogPost::observe(BlogPostObserver::class);
        Comment::observe(CommentObserver::class);

        $this->app->singleton(Counter::class, function($app){
            return new Counter(
                $app->make(Factory::class),
                $app->make(Session::class),
                env("COUNTER_TIMEOUT")
            );
        });

        $this->app->bind(
            CounterContract::class,
            Counter::class);

//        CommentResource::withoutWrapping();
        JsonResource::withoutWrapping();

//        $this->app->bind(
//            CounterContract::class,
//            DummyCounter::class);

//        $this->app->when(Counter::class)
//            ->needs('$timeout')
//            ->give(env("COUNTER_TIMEOUT"));
    }
}
