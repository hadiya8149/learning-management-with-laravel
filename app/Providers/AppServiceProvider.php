<?php

namespace App\Providers;

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

		$this->app->bind(
			\App\Interfaces\UserServiceInterface::class,
			\App\Services\UserService::class
		);

		$this->app->bind(
			\App\Interfaces\StudentServiceInterface::class,
			\App\Services\StudentService::class
		);

		$this->app->bind(
			\App\Interfaces\ManagerServiceInterface::class,
			\App\Services\ManagerService::class
		);

		$this->app->bind(
			\App\Interfaces\QuizServiceInterface::class,
			\App\Services\QuizService::class
		);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
