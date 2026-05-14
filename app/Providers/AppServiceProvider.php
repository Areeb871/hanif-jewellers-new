<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use App\Helpers\AssetHelper;


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
        Paginator::useBootstrap();
        
        // Register Blade directives for minified assets
        Blade::directive('minifiedCss', function ($expression) {
            return "<?php echo App\Helpers\AssetHelper::cssLink($expression); ?>";
        });
        
        Blade::directive('minifiedJs', function ($expression) {
            return "<?php echo App\Helpers\AssetHelper::jsScript($expression); ?>";
        });
        
        Blade::directive('minifiedAsset', function ($expression) {
            return "<?php echo App\Helpers\AssetHelper::minified($expression); ?>";
        });
    }
}
