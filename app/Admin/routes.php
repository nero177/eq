<?php

use App\Admin\Controllers\HomeController;
use Illuminate\Routing\Router;
use App\Admin\Controllers\LessonController;
use App\Admin\Controllers\AuthorController;
use App\Admin\Controllers\BannerController;
use App\Admin\Controllers\SubscriptionController;
use App\Admin\Controllers\CollectionController;
use App\Admin\Controllers\ArticlesController;
use App\Admin\Controllers\OptionController;
use App\Admin\Controllers\FaqController;
use App\Admin\Controllers\OrderController;
use App\Admin\Controllers\PageController;
use App\Admin\Controllers\SiteFilesController;
use App\Admin\Controllers\TheoryItemController;
use App\Admin\Controllers\UserController;
use App\Admin\Controllers\UtmController;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    $router->post('/delete-media/{uuid}', function($uuid) {
        return response()->json([
            'success' => Media::where('uuid', $uuid)->delete(),
        ]);
    })->name('delete_media');

    $router->get('/', 'HomeController@index')->name('home');
    $router->get('/options', 'OptionController@index');
    $router->get('/utm-data', 'UtmController@index');
    $router->resource('authors', AuthorController::class);
    $router->resource('lessons', LessonController::class);
    $router->resource('banners', BannerController::class);
    $router->resource('subscriptions', SubscriptionController::class);
    $router->resource('collections', CollectionController::class);
    $router->resource('articles', ArticlesController::class);
    $router->resource('faqs', FaqController::class);
    $router->resource('orders', OrderController::class);
    $router->resource('pages', PageController::class);
    $router->resource('site-files', SiteFilesController::class);
    $router->resource('theory-items', TheoryItemController::class);
    $router->resource('users', UserController::class);

    $router->post('/option-group-save', [OptionController::class, 'optionGroupSave'])->name('option-group-save');
});
