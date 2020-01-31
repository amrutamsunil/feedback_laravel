<?php

namespace App\Providers;

use App\Feedback;
use App\Classes;
use App\Department;
use App\User;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
       /* $feedbacks=Feedback::all();
        $classes=Classes::all();
        $students=User::all();
        $departments=Department::all();
        echo "<script>alert('entered')</script>";
        config(['feedbacks'=>$feedbacks,'classes'=>$classes,
            'students'=>$students,'departments'=>$departments]);
*/
    }
}
