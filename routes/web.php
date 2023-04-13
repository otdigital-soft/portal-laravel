<?php

use App\Http\Controllers\ReferralController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SubcategoryController;
use App\Models\Ad;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/home');
    } else {
        return view('auth.login');
    }
});

Route::get('/ref/{ref_code}', [IndexController::class, 'referrer'])->name('referrer');
Route::get('/privacy-policy', [IndexController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/term-of-service', [IndexController::class, 'termsOfUse'])->name('terms.service');

Route::middleware(['auth', 'invite.verification'])->group(
    function () {
        Route::post('/referrer-link', [ReferralController::class, 'generateCode'])->name('get.referrer.link');
        Route::get('/invitation/accept/{ref_code}', [ReferralController::class, 'acceptInvitation'])->name('invitation.accept');
        Route::get('/referrer', [ReferralController::class, 'index'])->name('referrer.index');
        Route::get('/marketplace', function (Request $request) {
            $categoryId = $request->input('category');
            $locationId = $request->input('location');

            $ads = Ad::filterByTitleCategorySubcategoryAndLocation(
                $request->input('title'),
                $request->input('category_id'),
                $request->input('location_id'),
                $request->input('subcategory_id')
            )->get();
            $categories = Category::all();
            $locations = Location::all();
            return view('marketplace', compact('ads', 'categories', 'locations'));
        })->name('marketplace');
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/project/{slug}', [App\Http\Controllers\HomeController::class, 'project'])->name('home.project');
        Route::get('/projects/blog-posts/{slug}', [App\Http\Controllers\HomeController::class, 'showBlogPostDetails'])->name('blog-posts.show');
        Route::get('/calendar', [App\Http\Controllers\HomeController::class, 'calendar'])->name('calendar');

        // User Management Route
        Route::get('user/profile', [App\Http\Controllers\UserController::class, 'index'])->name('user.profile');
        Route::put('user/profile', [App\Http\Controllers\UserController::class, 'update'])->name('user.profile.update');
        Route::put('user/profile/password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('user.profile.password');

        //Ads Route
        Route::get('/user/ads', [App\Http\Controllers\User\AdController::class, 'index'])->name('user.ads');
        Route::get('/user/ads/create', [App\Http\Controllers\User\AdController::class, 'create'])->name('ads.create');
        Route::post('/user/ads', [App\Http\Controllers\User\AdController::class, 'store'])->name('ads.store');
        Route::post('/user/ads/{ad}/favorite', [App\Http\Controllers\User\AdController::class, 'toggleFavorite'])->name('ads.favorite.toggle');
        Route::get('/user/ads/favorites', [App\Http\Controllers\User\AdController::class, 'getFavoriteAds'])->name('ads.favorites');
        Route::put('/user/ads', [App\Http\Controllers\User\AdController::class, 'update'])->name('user.ad.update');
        Route::delete('/user/ads/{ad_id}/delete', [App\Http\Controllers\User\AdController::class, 'delete'])->name('user.ad.delete');

        Route::get('/ads', [App\Http\Controllers\AdController::class, 'index'])->name('ads');
        Route::post('/ads', [App\Http\Controllers\AdController::class, 'index'])->name('ads.filter');
        Route::get('/ads/{ad}', [App\Http\Controllers\AdController::class, 'show'])->name('ads.show');

        //Categories Routes
        Route::get('subcategories/fetch', [SubcategoryController::class, 'fetchByCategoryId'])->name('subcategories.fetch');
        Route::get('/category', [App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');
        Route::get('/subcategory', [App\Http\Controllers\SubcategoryController::class, 'create'])->name('subcategory.create');
        Route::post('/category', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
        Route::post('/subcategory', [App\Http\Controllers\SubcategoryController::class, 'store'])->name('subcategory.store');

        Route::get('/api/subcategories', [App\Http\Controllers\CategoryController::class, 'getSubCategories']);

        //Messages and Conversations Routes
        Route::get('/conversations', [App\Http\Controllers\AdController::class, 'conversations'])->name('ads.conversations');
        Route::get('/ad-conversations/{ad}', [App\Http\Controllers\AdConversationController::class, 'showAdConversations'])->name('ad.conversations');
        Route::get('/conversations/{conversation}', [App\Http\Controllers\ConversationController::class, 'index'])->name('conversations.messages');
        Route::post('/ads/{ad}/messages', [App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');

        //Locations Route
        Route::get('/locations', [App\Http\Controllers\LocationController::class, 'index'])->name('location.index');
        Route::post('/locations', [App\Http\Controllers\LocationController::class, 'store'])->name('location.store');
        Route::delete('/locations/{location_id}', [App\Http\Controllers\LocationController::class, 'delete'])->name('location.delete');

        //Roles Route
        Route::get('/roles', [App\Http\Controllers\Admin\RolesController::class, 'index'])->name('role.index');
        Route::post('/roles', [App\Http\Controllers\Admin\RolesController::class, 'store'])->name('role.store');
        Route::delete('/roles/{role_id}', [App\Http\Controllers\Admin\RolesController::class, 'delete'])->name('role.delete');

        //User Management Route
        Route::get('/users/{type?}', [App\Http\Controllers\Admin\UsersController::class, 'index'])->where('type', 'verified|pending|admin|leader')->name('users.index');
        Route::delete('/users/{user_id}', [App\Http\Controllers\Admin\UsersController::class, 'delete'])->name('users.delete');
        Route::get('/users/user/{user_id}', [App\Http\Controllers\Admin\UsersController::class, 'show'])->name('users.show');
        Route::put('admin/update/user', [App\Http\Controllers\Admin\UsersController::class, 'update'])->name('users.update');

        //Project Route
        Route::resource('projects', App\Http\Controllers\Admin\ProjectController::class);
        Route::put('/projects', [App\Http\Controllers\Admin\ProjectController::class, 'update'])->name('project.update');
        Route::post('/projects/{project}/favorite', [App\Http\Controllers\Admin\ProjectController::class, 'toggleSubscription'])->name('projects.subscription.toggle');
        Route::get('users/projects', [App\Http\Controllers\User\ProjectController::class, 'index'])->name('users.projects.index');

        //BlogPost Route
        Route::get('/projects/{project}/blog-posts/create', [App\Http\Controllers\BlogPostController::class, 'create'])->name('blog-posts.create');
        Route::get('/blog-posts/{post}', [App\Http\Controllers\BlogPostController::class, 'edit'])->name('blog-posts.edit');
        Route::put('/blog-posts', [App\Http\Controllers\BlogPostController::class, 'update'])->name('blog-posts.update');
        Route::post('/projects/{project}/blog-posts', [App\Http\Controllers\BlogPostController::class, 'store'])->name('blog-posts.store');
        Route::delete('/projects/blog-posts/{post}', [App\Http\Controllers\BlogPostController::class, 'destroy'])->name('blog-posts.delete');

        //Event Route
        Route::get('/projects/{project}/events/create', [App\Http\Controllers\EventsController::class, 'create'])->name('events.create');
        Route::post('/projects/{project}/events', [App\Http\Controllers\EventsController::class, 'store'])->name('events.store');
        Route::put('/events', [App\Http\Controllers\EventsController::class, 'update'])->name('events.update');
        Route::delete('/projects/events/{event}', [App\Http\Controllers\EventsController::class, 'destroy'])->name('events.delete');
        Route::delete('/projects/events/{event}/cancel', [App\Http\Controllers\EventsController::class, 'cancel'])->name('events.cancel');
        Route::post('/projects/events{event}/signup', [App\Http\Controllers\EventsController::class, 'signup'])->name('events.signup');
        Route::get('/calendar/events/get-events', [App\Http\Controllers\EventsController::class, 'getEvents'])->name('events.getEvents');
        Route::get('/events/{event}', [App\Http\Controllers\EventsController::class, 'show'])->name('events.show');
        Route::get('/events/s/calendar', [App\Http\Controllers\HomeController::class, 'calendar'])->name('events.calendar');
    }
);

// Ads routes
// Route::get('/ads/{ad}/edit', [App\Http\Controllers\AdController::class, 'edit'])->name('ads.edit');
// Route::put('/ads/{ad}', [App\Http\Controllers\AdController::class, 'update'])->name('ads.update');
// Route::delete('/ads/{ad}', [App\Http\Controllers\AdController::class, 'destroy'])->name('ads.destroy');
// Route::get('/ads/category/{category}', [App\Http\Controllers\AdController::class, 'getByCategory'])->name('ads.byCategory');
// Route::get('/ads/category/{category}/sub-category/{subCategory}', [App\Http\Controllers\AdController::class, 'getBySubCategory'])->name('ads.bySubCategory');
// Route::get('/ads/location/{location}', [App\Http\Controllers\AdController::class, 'getByLocation'])->name('ads.byLocation');
// Route::get('/subcategory/{subcategory}', 'AdController@getAdsBySubcategory')->name('subcategory');

//Admin routes

require __DIR__ . '/auth.php';
