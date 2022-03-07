<?php

namespace App\Providers;

use App\Http\Controllers\CarController;
use App\Http\Controllers\TripController;
use App\Repositories\CarRepository;
use App\Repositories\Repository;
use App\Repositories\TripRepository;
use App\Transformers\CarTransformer;
use App\Transformers\Transformer;
use App\Transformers\TripTransformer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(TripController::class)->needs(Repository::class)->give(TripRepository::class);
        $this->app->when(TripController::class)->needs(Transformer::class)->give(TripTransformer::class);
        $this->app->when(TripTransformer::class)->needs(Transformer::class)->give(CarTransformer::class);

        $this->app->when(CarController::class)->needs(Repository::class)->give(CarRepository::class);
        $this->app->when(CarController::class)->needs(Transformer::class)->give(CarTransformer::class);
    }
}
