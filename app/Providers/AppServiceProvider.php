<?php

namespace Seasonofjubilee\Providers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Seasonofjubilee\Models\Comment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(!Collection::hasMacro('paginate')){
            Collection::macro('paginate',
                function($perPage = 15,$page = null, $options = []){
                    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
                    return (new LengthAwarePaginator(
                        $this->forPage($page, $perPage), $this->count(), $perPage,$page, $options
                    ))->withPath('');
                });
        }
        Relation::morphMap([
            'sermons' => 'Seasonofjubilee\Models\Sermon',
            'posts' => 'Seasonofjubilee\Models\Post',
            'testimonies' => 'Seasonofjubilee\Models\Testimony'
        ]);
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
