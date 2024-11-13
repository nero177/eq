<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localizationRedirect', 'localeViewPath'],
], function () {
    Route::get('/', [FrontController::class, 'index']);
    Route::get('adaptation', [FrontController::class, 'adaptation']);
    Route::get('blog', [ArticlesController::class, 'index']);
    Route::get('article/{id}', [ArticlesController::class, 'show']);
    Route::get('faq', [FaqController::class, 'index']);
    Route::get('about', [FrontController::class, 'about']);

    Route::group([
        'prefix' => 'cabinet',
    ], function () {
        Route::get('/', CabinetController::class)->name('cabinet');
        Route::get('/auth', [CabinetController::class, 'auth'])->name('auth');
        Route::get('/edit', [CabinetController::class, 'editView']);

        Route::get('/master-classes', [LessonController::class, 'masterClasses']);
        Route::get('/videocourses', [LessonController::class, 'videoCourses']);
        Route::get('/fundamental-theory', [LessonController::class, 'fundamentalTheory']);
        Route::get('/adaptation', [LessonController::class, 'adaptation']);
        Route::get('/film', [LessonController::class, 'film']);
        Route::get('/lesson/{id}', [LessonController::class, 'lesson']);
        Route::get('/favorites', [FavoritesController::class, 'index']);
        Route::get('/new-forms', [LessonController::class, 'newForms']);
        Route::get('/collection/{slug}', [LessonController::class, 'collectionLessons']);

        Route::get('/orders', [OrderController::class, 'lastOrders']);
        Route::get('/order/{order_number}', [OrderController::class, 'show']);
    });

    Route::post('/to-favorites', [FavoritesController::class, 'add'])->name('favorites.add');
    Route::post('/delete-favorites', [FavoritesController::class, 'removeAll'])->name('favorites.remove-all');
    Route::post('/delete-favorite', [FavoritesController::class, 'remove'])->name('favorites.remove');
    Route::post('/edit-user', [UserController::class, 'edit'])->name('user.edit');

    Route::group([
        'prefix' => 'auth',
    ], function () {
        Route::post('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('/new-password', [PasswordController::class, 'newPassword'])->name('password.new');
        Route::post('/forgot-password', [PasswordController::class, 'forgotPassword'])->name('forgot-password');
        Route::post('/reset-password', [PasswordController::class, 'resetPassword'])->name('password.update');
        
        Route::view('/new-password', 'auth.password.new-password')->name('new-password')->middleware('signed');
        Route::view('/forgot-password', 'auth.password.forgot-password');
        Route::view('/reset-password-sended', 'auth.password.reset-password-sended');

        Route::get('/reset-password/{token}', function (string $token) {
            return view('auth.password.reset-password', ['token' => $token]);
        })->middleware('guest')->name('password.reset');
    });

    Route::group([
        'prefix' => 'cart',
    ], function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.view');
        Route::post('/store', [CartController::class, 'store'])->name('cart.store');
        Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
        Route::post('/remove-all', [CartController::class, 'removeAll'])->name('cart.remove-all');
        Route::post('/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.update-quantity');
    });

    Route::group([
        'prefix' => 'payment',
        'middleware' => ['auth']
    ], function () {
        Route::get('/checkout', [PaymentController::class, 'checkout']);
        Route::post('/purchase', [PaymentController::class, 'purchase'])->name('purchase');
    });

    Route::get('/collection/{slug}', [CollectionController::class, 'show']);
    Route::get('/fundamental-theory', [CollectionController::class, 'fundamentalTheory']);
    Route::get('/master-classes', [CollectionController::class, 'masterClasses']);
    Route::get('/videocourse', [CollectionController::class, 'videocourse']);
    Route::get('/theory', [FrontController::class, 'theory']);

    Route::get('/author/{slug}', [AuthorController::class, 'show']);
    Route::get('/payment-success', [FrontController::class, 'paymentSuccess'])->name('order.success');

    Route::get('/{slug}', [FrontController::class, 'showPageBySlug']);

    // Route::view('contract-offer', 'pages.contract-offer');
});
