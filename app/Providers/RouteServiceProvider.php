<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();
        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
            Route::group(['prefix' => LaravelLocalization::setLocale(),
                    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ],
                 ],function () {
                Route::prefix('dashboard')->as('dashboard.')->group(function () {
                    Route::get('/toggle-locale', function () {
                        // Toggle between 'en' and 'ar'
                        $currentLocale = LaravelLocalization::getCurrentLocale();
                        $newLocale = $currentLocale === 'en' ? 'ar' : 'en';
                        $url = LaravelLocalization::getLocalizedURL($newLocale, URL::previous());
                        // Redirect to the new locale's URL
                        return redirect($url);
                    })->name('toggle-locale');
                    Route::middleware('web')->group(base_path('routes/admin.php'));

                    Route::middleware('web')->group(base_path('routes/student.php'));

                    Route::middleware('web')->group(base_path('routes/guardian.php'));

                    Route::middleware('web')->group(base_path('routes/teacher.php'));

                });
            });
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
