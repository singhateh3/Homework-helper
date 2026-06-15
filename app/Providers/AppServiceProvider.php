<?php

namespace App\Providers;

use App\Models\Question;
use App\Models\User;
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
        // Define gate for updating questions
        Gate::define('update-question', function (User $user, Question $question) {
            return $user->id === $question->user_id;
        });

        // Define gate for deleting questions
        Gate::define('delete-question', function (User $user, Question $question) {
            return $user->id === $question->user_id;
        });

        // Optional: Define gate for viewing questions (everyone can view)
        Gate::define('view-question', function (User $user, Question $question) {
            return true;
        });
    }
}
