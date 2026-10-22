<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\HeroSlideController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WebsiteSettingController;
use App\Http\Controllers\AboutPageController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\CompanyContactController;
use App\Http\Controllers\PublicContactController;
use App\Http\Controllers\ContactEnquiryController;
use App\Http\Controllers\Admin\ContactEnquiry1Controller;
use App\Http\Controllers\Admin\SaleProductController;
use App\Http\Controllers\PublicSalesController;
use App\Http\Controllers\Admin\WebsiteAnalyticsController;


/*
|--------------------------------------------------------------------------
| PUBLIC WEBSITE
|--------------------------------------------------------------------------
*/

Route::get('/', [
    HomeController::class,
    'index',
])->name('home');
Route::get('/about', [AboutController::class, 'index'])
    ->name('about');

/*
|--------------------------------------------------------------------------
| ADMIN AUTHENTICATION
|--------------------------------------------------------------------------
|
| Login:
| GET  /admin
| POST /admin
|
*/

Route::middleware('guest')->group(function () {

    Route::get('/admin', [
        AuthController::class,
        'showLogin',
    ])->name('login');

    Route::post('/admin', [
        AuthController::class,
        'login',
    ])->name('login.authenticate');

});


/*
|--------------------------------------------------------------------------
| WEBSITE SETTINGS
|--------------------------------------------------------------------------
|
| No auth middleware intentionally.
|
*/

Route::prefix('admin')
    ->group(function () {

        Route::get('/website/settings', [
            WebsiteSettingController::class,
            'edit',
        ])->name('admin.website.settings.edit');

        Route::put('/website/settings', [
            WebsiteSettingController::class,
            'update',
        ])->name('admin.website.settings.update');

    });

    Route::get('/analytics', [
        WebsiteAnalyticsController::class,
        'index',
    ])->name('admin.analytics.index');


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
|
| These routes require authentication.
|
*/

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [
        DashboardController::class,
        'index',
    ])->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [
        AuthController::class,
        'logout',
    ])->name('admin.logout');


    /*
    |--------------------------------------------------------------------------
    | WEBSITE - HERO SLIDES
    |--------------------------------------------------------------------------
    */

    Route::prefix('website/hero-slides')
        ->group(function () {

            Route::get('/', [
                HeroSlideController::class,
                'index',
            ])->name('admin.hero-slides.index');


            Route::get('/create', [
                HeroSlideController::class,
                'create',
            ])->name('admin.hero-slides.create');


            Route::post('/', [
                HeroSlideController::class,
                'store',
            ])->name('admin.hero-slides.store');


            Route::get('/{heroSlide}/edit', [
                HeroSlideController::class,
                'edit',
            ])->name('admin.hero-slides.edit');


            Route::put('/{heroSlide}', [
                HeroSlideController::class,
                'update',
            ])->name('admin.hero-slides.update');


            Route::patch('/{heroSlide}/toggle-status', [
                HeroSlideController::class,
                'toggleStatus',
            ])->name('admin.hero-slides.toggle-status');


            Route::delete('/{heroSlide}', [
                HeroSlideController::class,
                'destroy',
            ])->name('admin.hero-slides.destroy');

        });


    /*
    |--------------------------------------------------------------------------
    | USERS
    |--------------------------------------------------------------------------
    */

    Route::middleware('permission:view users')->group(function () {

        Route::get('/users', [
            UserController::class,
            'index',
        ])->name('users.index');


        Route::get('/users/{user}', [
            UserController::class,
            'show',
        ])->name('users.show');

    });


    Route::middleware('permission:create users')->group(function () {

        Route::get('/users/create', [
            UserController::class,
            'create',
        ])->name('users.create');


        Route::post('/users', [
            UserController::class,
            'store',
        ])->name('users.store');

    });


    Route::middleware('permission:edit users')->group(function () {

        Route::get('/users/{user}/edit', [
            UserController::class,
            'edit',
        ])->name('users.edit');


        Route::put('/users/{user}', [
            UserController::class,
            'update',
        ])->name('users.update');


        Route::patch('/users/{user}/toggle-status', [
            UserController::class,
            'toggleStatus',
        ])->name('users.toggle-status');

    });


    Route::middleware('permission:delete users')->group(function () {

        Route::delete('/users/{user}', [
            UserController::class,
            'destroy',
        ])->name('users.destroy');

    });


    /*
    |--------------------------------------------------------------------------
    | STAFF
    |--------------------------------------------------------------------------
    */

    Route::prefix('staff')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | CREATE STAFF
        |--------------------------------------------------------------------------
        */

        Route::middleware('permission:create staff')->group(function () {

            Route::get('/create', [
                StaffController::class,
                'create',
            ])->name('staff.create');


            Route::post('/', [
                StaffController::class,
                'store',
            ])->name('staff.store');

        });


        /*
        |--------------------------------------------------------------------------
        | VIEW STAFF
        |--------------------------------------------------------------------------
        */

        Route::middleware('permission:view staff')->group(function () {

            Route::get('/', [
                StaffController::class,
                'index',
            ])->name('staff.index');


            Route::get('/{staff}', [
                StaffController::class,
                'show',
            ])->name('staff.show');

        });


        /*
        |--------------------------------------------------------------------------
        | EDIT STAFF
        |--------------------------------------------------------------------------
        */

        Route::middleware('permission:edit staff')->group(function () {

            Route::get('/{staff}/edit', [
                StaffController::class,
                'edit',
            ])->name('staff.edit');


            Route::put('/{staff}', [
                StaffController::class,
                'update',
            ])->name('staff.update');


            Route::patch('/{staff}/toggle-status', [
                StaffController::class,
                'toggleStatus',
            ])->name('staff.toggle-status');

        });


        /*
        |--------------------------------------------------------------------------
        | DELETE STAFF
        |--------------------------------------------------------------------------
        */

        Route::middleware('permission:delete staff')->group(function () {

            Route::delete('/{staff}', [
                StaffController::class,
                'destroy',
            ])->name('staff.destroy');

        });

    });

        // Company Contact Management
    Route::resource('company-contacts', CompanyContactController::class);

    Route::patch(
        '/company-contacts/{companyContact}/toggle-publication',
        [CompanyContactController::class, 'togglePublication']
    )->name('admin.company-contacts.toggle-publication');

    /*
    |--------------------------------------------------------------------------
    | DEPARTMENTS
    |--------------------------------------------------------------------------
    */

    Route::middleware('permission:view departments')->group(function () {

        Route::get('/departments', [
            DepartmentController::class,
            'index',
        ])->name('departments.index');


        Route::get('/departments/{department}', [
            DepartmentController::class,
            'show',
        ])->name('departments.show');

    });


/*
|--------------------------------------------------------------------------
| Project Management
|--------------------------------------------------------------------------
*/

Route::get('/projects', [ProjectController::class, 'index'])
->name('admin.projects.index');

Route::get('/projects/create', [ProjectController::class, 'create'])
->name('admin.projects.create');

Route::post('/projects', [ProjectController::class, 'store'])
->name('admin.projects.store');

Route::get('/projects/{project}', [ProjectController::class, 'show'])
->name('admin.projects.show');

Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])
->name('admin.projects.edit');

Route::put('/projects/{project}', [ProjectController::class, 'update'])
->name('admin.projects.update');

Route::patch('/projects/{project}/toggle-publication', [
ProjectController::class,
'togglePublication',
])->name('admin.projects.toggle-publication');

Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])
->name('admin.projects.destroy');
Route::resource('sales', SaleProductController::class)
->names('admin.sales');



    Route::middleware('permission:create departments')->group(function () {

        Route::get('/departments/create', [
            DepartmentController::class,
            'create',
        ])->name('departments.create');


        Route::post('/departments', [
            DepartmentController::class,
            'store',
        ])->name('departments.store');

    });


    Route::middleware('permission:edit departments')->group(function () {

        Route::get('/departments/{department}/edit', [
            DepartmentController::class,
            'edit',
        ])->name('departments.edit');


        Route::put('/departments/{department}', [
            DepartmentController::class,
            'update',
        ])->name('departments.update');


        Route::patch('/departments/{department}/toggle-status', [
            DepartmentController::class,
            'toggleStatus',
        ])->name('departments.toggle-status');

    });


    Route::middleware('permission:delete departments')->group(function () {

        Route::delete('/departments/{department}', [
            DepartmentController::class,
            'destroy',
        ])->name('departments.destroy');

    });

    //aboutpage routes
    Route::get(
        '/website/about',
        [AboutPageController::class, 'edit']
    )->name('admin.about.edit');
    
    Route::put(
        '/website/about',
        [AboutPageController::class, 'update']
    )->name('admin.about.update');


    // Team Members routes
    Route::get(
        '/website/team',
        [TeamMemberController::class, 'index']
    )->name('admin.team.index');
    
    Route::get(
        '/website/team/create',
        [TeamMemberController::class, 'create']
    )->name('admin.team.create');
    
    Route::post(
        '/website/team',
        [TeamMemberController::class, 'store']
    )->name('admin.team.store');
    
    Route::get(
        '/website/team/{teamMember}',
        [TeamMemberController::class, 'show']
    )->name('admin.team.show');
    
    Route::get(
        '/website/team/{teamMember}/edit',
        [TeamMemberController::class, 'edit']
    )->name('admin.team.edit');
    
    Route::put(
        '/website/team/{teamMember}',
        [TeamMemberController::class, 'update']
    )->name('admin.team.update');
    
    Route::patch(
        '/website/team/{teamMember}/toggle-status',
        [TeamMemberController::class, 'toggleStatus']
    )->name('admin.team.toggle-status');
    
    Route::delete(
        '/website/team/{teamMember}',
        [TeamMemberController::class, 'destroy']
    )->name('admin.team.destroy');
    

});

    /*
|--------------------------------------------------------------------------
| PUBLIC PROJECT PORTFOLIO
|--------------------------------------------------------------------------
*/

Route::get('/projects', [
    ProjectsController::class,
    'index',
])->name('projects.index');

Route::get('/projects/{project:slug}', [
    ProjectsController::class,
    'show',
])->name('projects.show');

// Public Contact Us page
Route::get('/contact', [PublicContactController::class, 'index'])
    ->name('contact.index');
Route::post('/contact', [ContactEnquiryController::class, 'store'])
    ->name('contact.store');

    // Contact Enquiry Management
Route::get('/contact-enquiries', [
    ContactEnquiry1Controller::class,
    'index',
])->name('admin.contact-enquiries.index');

Route::get('/contact-enquiries/{contactEnquiry}', [
    ContactEnquiry1Controller::class,
    'show',
])->name('admin.contact-enquiries.show');

Route::patch('/contact-enquiries/{contactEnquiry}/status', [
    ContactEnquiry1Controller::class,
    'updateStatus',
])->name('admin.contact-enquiries.status');

Route::delete('/contact-enquiries/{contactEnquiry}', [
    ContactEnquiry1Controller::class,
    'destroy',
])->name('admin.contact-enquiries.destroy');

Route::get('/sales', [PublicSalesController::class, 'index'])
    ->name('sales.index');

Route::get('/sales/{slug}', [PublicSalesController::class, 'show'])
    ->name('sales.show');




/*
|--------------------------------------------------------------------------
| FALLBACK
|--------------------------------------------------------------------------
*/

Route::fallback(function () {

    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('home');

});