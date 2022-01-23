<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\View;
use App\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        View::composer('*', function ($view) {            
            $locale = config('app.locale');
            
            if (file_exists(resource_path('lang/' . $locale . '.json')))
                $translations = file_get_contents(resource_path('lang/' . $locale . '.json'));
            else
                $translations = '[]';

            $view->with([
                'locale' => $locale,
                'dir' => $locale == 'ar' || $locale == 'he' ? 'rtl' : 'ltr',
                'translations' => json_decode($translations, true),
            ]);
        });


        View::composer('*', function ($view) {            
            $view->with([
                'brands' => [],
                'categories' => [],
            ]);
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Relation::morphMap([
        //     'brand' => \App\Models\Brand::class,
        //     'category' => \App\Models\Category::class,
        //     'blog' => \App\Models\Blog::class,
        //     'product' => \App\Models\Product::class,
        //     'user' => \App\Models\User::class,
        // ]);
    }
}
