<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Content;
use App\Models\Country;
use App\Models\Grade;
use App\Models\Menu;
use App\Models\Module;
use App\Models\ModulePermission;
use App\Models\Permission;
use App\Models\Province;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\OtpList;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use App\Models\UserRole;
use App\Observers\BannerObserver;
use App\Observers\ContentObserver;
use App\Observers\CountryObserver;
use App\Observers\GradeObserver;
use App\Observers\MenuObserver;
use App\Observers\ModuleObserver;
use App\Observers\ModulePermissionObserver;
use App\Observers\PermissionObserver;
use App\Observers\ProvinceObserver;
use App\Observers\RoleObserver;
use App\Observers\RolePermissionObserver;
use App\Observers\OtpListObserver;
use App\Observers\StudentObserver;
use App\Observers\SubjectObserver;
use App\Observers\TeacherObserver;
use App\Observers\UserObserver;
use App\Observers\UserRoleObserver;
use Illuminate\Support\ServiceProvider;

use URL;

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
        //
        User::observe(UserObserver::class);
        Role::observe(RoleObserver::class);
        Permission::observe(PermissionObserver::class);
        Module::observe(ModuleObserver::class);
        ModulePermission::observe(ModulePermissionObserver::class);
        UserRole::observe(UserRoleObserver::class);
        RolePermission::observe(RolePermissionObserver::class);
        Country::observe(CountryObserver::class);
        Province::observe(ProvinceObserver::class);
        Banner::observe(BannerObserver::class);
        OtpList::observe(OtpListObserver::class);
        Content::observe(ContentObserver::class);
        Menu::observe(MenuObserver::class);
        Grade::observe(GradeObserver::class);
        Subject::observe(SubjectObserver::class);
        Student::observe(StudentObserver::class);
        Teacher::observe(TeacherObserver::class);

        if ($this->app->environment('production') || $this->app->environment('uat')) {
            URL::forceScheme('https');
        }

        view()->composer(
            ['frontend.layout.partials.header', 'frontend.layout.partials.footer', 'frontend.student.layouts.header','frontend.teacher.layouts.header'],
            'App\Http\ViewComposers\Frontend\AppComposer'
        );
    }
}
