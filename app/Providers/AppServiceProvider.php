<?php

namespace App\Providers;

use App\Models\Message;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

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
        


        View::composer('*', function($view) {

            $checkCount = Message::where('get_id',Auth::id())
            ->where('check',0)->count();

            $view->with('checkCount',$checkCount);
          });
    }
}
