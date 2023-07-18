<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Gate;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('comment-delete', function(User $user, Comment $comment){
            return $user->id == $comment->user_id;
        });

        Gate::define('article-delete', function(User $user, Article $article){
            return $user->id == $article->user_id;
        });
    }
}
