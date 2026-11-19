<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use App\Helpers\AssetHelper;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('header.gold_rates', function () {
            $market = \App\Models\Products::currentMarket();

            return \App\Models\GoldRateSetting::forMarket($market)
                ->where('is_active', true)
                ->where('gold_rate_per_gram', '>', 0)
                ->orderByDesc('karat')
                ->get(['karat', 'gold_rate_per_gram']);
        });
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

        View::composer('*', function ($view) {
            $market = session('market');
            if (! in_array($market, ['pk', 'uae'], true)) {
                $market = app()->getLocale() === 'ar' ? 'uae' : 'pk';
            }

            // Region phone: UAE / عربي uses +971 50 175 2234. Pakistan uses +92 307 0222666.
            $phone = $market === 'uae' ? '971501752234' : '923070222666';
            $phoneDisplay = $market === 'uae' ? '+971 50 175 2234' : '+92 307 0222666';
            $message = 'Hello Hanif Jewellers, I would like to book an appointment.';

            $view->with('siteMarket', $market);
            $view->with('appointmentWhatsappPhone', $phone);
            $view->with('appointmentPhoneDisplay', $phoneDisplay);
            $view->with('appointmentWhatsappUrl', 'https://api.whatsapp.com/send?phone='.$phone.'&text='.rawurlencode($message));
        });
    }
}
