<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $adminNamespace = 'App\\Http\\Controllers\\Admin';
    protected $apiNamespace = 'App\\Http\\Controllers\\Api';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $studentNamespace = 'App\\Http\\Controllers\\Frontend\\Student';
    protected $teacherNamespace = 'App\\Http\\Controllers\\Frontend\\Teacher';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->namespace($this->apiNamespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')->namespace($this->adminNamespace)->prefix('admin')->as('admin.')
                ->group(base_path('routes/admin.php'));

            Route::middleware('web')->namespace($this->studentNamespace)->prefix('student')->as('student.')
                ->group(base_path('routes/student.php'));

            Route::middleware('web')->namespace($this->teacherNamespace)->prefix('teacher')->as('teacher.')
                ->group(base_path('routes/teacher.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
