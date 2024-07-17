<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive();
        Gate::define('mustadmin', function(User $user) {
            return $user->isadmin;
        });

        Gate::define('creator', function(User $user, Comment $comment) {
            return $user->id === $comment->user_id;
        });
    }
}
