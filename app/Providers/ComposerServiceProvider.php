<?php

namespace App\Providers;

use App\Models\Paste;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     * Adding public pastes and user pastes block to place it throughout the app
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $date = Carbon::now();
            $recent_pastes = Paste::latest()->whereNull('expires_at')
                ->orWhere(function($query) use ($date) {
                    $query->where('expires_at', '>=',$date);
                })->where('access_type', '=','public')->take(10)->get();
            $view->with('recent_pastes', $recent_pastes);
            if (Auth::check()){
                $recent_user_pastes = Paste::latest()->whereNull('expires_at')
                    ->orWhere(function($query) use ($date) {
                        $query->where('expires_at', '>=',$date);
                    })->where('user_id',Auth::id())->take(10)->get();
                $view->with('recent_user_pastes', $recent_user_pastes);
            }
        });
    }
}
