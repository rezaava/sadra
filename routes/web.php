<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ServiceCategoryController as AdminServiceCategoryController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\AdminBrandController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IntroController;
use App\Http\Controllers\JoinController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SubmitPortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IntroController::class, 'index'])->name('intro');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/services/{id}', [ServicesController::class, 'index'])->name('services');
Route::get('/products', [ProductsController::class, 'index'])->name('products');
Route::get('/product/{id}', [ProductController::class, 'index'])->name('product');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{id}', [BlogPostController::class, 'index'])->name('blog.post');
Route::get('/quote', [QuoteController::class, 'index'])->name('quote');
Route::post('/quote', [QuoteController::class, 'store'])->name('quote.store');
Route::get('/join', [JoinController::class, 'index'])->name('join');
Route::post('/join', [JoinController::class, 'store'])->name('join.store');
Route::get('/representative', [RepresentativeController::class, 'index'])->name('representative');
Route::post('/representative', [RepresentativeController::class, 'store'])->name('representative.store');
Route::get('/submit-portfolio', [SubmitPortfolioController::class, 'index'])->name('submit-portfolio');
Route::post('/submit-portfolio', [SubmitPortfolioController::class, 'store'])->name('submit-portfolio.store');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::prefix('requests')->name('requests.')->group(function () {
        Route::get('/join', [AdminController::class, 'joinRequests'])->name('join');
        Route::get('/join/{joinSubmission}', [AdminController::class, 'showJoinRequest'])->name('join.show');
        Route::get('/quote', [AdminController::class, 'quoteRequests'])->name('quote');
        Route::get('/representative', [AdminController::class, 'representativeRequests'])->name('representative');
        Route::get('/portfolio', [AdminController::class, 'portfolioRequests'])->name('portfolio');
    });

    Route::prefix('blogs')->name('blogs.')->group(function () {
        Route::get('/', [AdminBlogController::class, 'index'])->name('index');
        Route::get('/create', [AdminBlogController::class, 'create'])->name('create');
        Route::post('/', [AdminBlogController::class, 'store'])->name('store');
        Route::get('/{blog}/edit', [AdminBlogController::class, 'edit'])->name('edit');
        Route::put('/{blog}', [AdminBlogController::class, 'update'])->name('update');
        Route::delete('/{blog}', [AdminBlogController::class, 'destroy'])->name('destroy');
        Route::patch('/{blog}/toggle', [AdminBlogController::class, 'toggle'])->name('toggle');
    });

    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [AdminProductController::class, 'index'])->name('index');
        Route::get('/create', [AdminProductController::class, 'create'])->name('create');
        Route::post('/', [AdminProductController::class, 'store'])->name('store');
        Route::get('/{product}/edit', [AdminProductController::class, 'edit'])->name('edit');
        Route::put('/{product}', [AdminProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [AdminProductController::class, 'destroy'])->name('destroy');
        Route::patch('/{product}/toggle', [AdminProductController::class, 'toggle'])->name('toggle');
    });

    Route::prefix('service-categories')->name('service-categories.')->group(function () {
        Route::get('/', [AdminServiceCategoryController::class, 'index'])->name('index');
        Route::get('/create', [AdminServiceCategoryController::class, 'create'])->name('create');
        Route::post('/', [AdminServiceCategoryController::class, 'store'])->name('store');
        Route::get('/{serviceCategory}/edit', [AdminServiceCategoryController::class, 'edit'])->name('edit');
        Route::put('/{serviceCategory}', [AdminServiceCategoryController::class, 'update'])->name('update');
        Route::delete('/{serviceCategory}', [AdminServiceCategoryController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', [AdminServiceController::class, 'index'])->name('index');
        Route::get('/create', [AdminServiceController::class, 'create'])->name('create');
        Route::post('/', [AdminServiceController::class, 'store'])->name('store');
        Route::get('/{service}/edit', [AdminServiceController::class, 'edit'])->name('edit');
        Route::put('/{service}', [AdminServiceController::class, 'update'])->name('update');
        Route::delete('/{service}', [AdminServiceController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('brands')->name('brands.')->group(function () {
        Route::get('/', [AdminBrandController::class, 'index'])->name('index');
        Route::post('/', [AdminBrandController::class, 'store'])->name('store');
        Route::post('/{brand}', [AdminBrandController::class, 'update'])->name('update');
        Route::delete('/{brand}', [AdminBrandController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [AdminCategoryController::class, 'index'])->name('index');
        Route::post('/', [AdminCategoryController::class, 'store'])->name('store');
        Route::post('/{category}', [AdminCategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [AdminCategoryController::class, 'destroy'])->name('destroy');
    });
    Route::post('/video', [AdminController::class, 'uploadVideo'])->name('video.upload');
    Route::delete('/video', [AdminController::class, 'deleteVideo'])->name('video.delete');
});
