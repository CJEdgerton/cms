<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if( env('DB_CONNECTION') == 'mysql' )
            \Schema::defaultStringLength(191);

        // Hack to allow pagination on normal collections, not just Eloquent collection instances.
            Collection::macro('paginate', function( $perPage, $total = null, $page = null, $pageName = 'page' ) {
              $page = $page ?: LengthAwarePaginator::resolveCurrentPage( $pageName );

              return new LengthAwarePaginator( $this->forPage( $page, $perPage ), $total ?: $this->count(), $perPage, $page, [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'pageName' => $pageName,
                ]);
          });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
