<?php

use App\Http\Controllers\Admin\AdminBlogCategoryController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminCertificationCategoryController;
use App\Http\Controllers\Admin\AdminCertificationController;
use App\Http\Controllers\Admin\AdminEducationController;
use App\Http\Controllers\Admin\AdminExperienceController;
use App\Http\Controllers\Admin\AdminMessageController;
use App\Http\Controllers\Admin\AdminProjectCategoryController;
use App\Http\Controllers\Admin\AdminProjectController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminSkillController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicSite\AboutController;
use App\Http\Controllers\PublicSite\BlogController;
use App\Http\Controllers\PublicSite\CertificationController;
use App\Http\Controllers\PublicSite\ContactController;
use App\Http\Controllers\PublicSite\HomeController;
use App\Http\Controllers\PublicSite\ProjectController;
use App\Http\Controllers\PublicSite\PortfolioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/cv/download', [\App\Http\Controllers\PublicSite\PortfolioController::class, 'downloadCV'])->name('cv.public.download');
Route::get('/portfolios', [PortfolioController::class, 'index'])->name('portfolios.index');
Route::get('/portfolios/upload', [PortfolioController::class, 'create'])->middleware('auth')->name('portfolios.create');
Route::post('/portfolios', [PortfolioController::class, 'store'])->middleware('auth')->name('portfolios.store');
Route::get('/portfolios/{portfolio}/download', [PortfolioController::class, 'download'])->name('portfolios.download');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/certifications', [CertificationController::class, 'index'])->name('certifications.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Projects
    Route::resource('projects', AdminProjectController::class)->except('show');
    Route::get('projects/categories', [AdminProjectCategoryController::class, 'index'])->name('projects.categories.index');
    Route::post('projects/categories', [AdminProjectCategoryController::class, 'store'])->name('projects.categories.store');
    Route::put('projects/categories/{category}', [AdminProjectCategoryController::class, 'update'])->name('projects.categories.update');
    Route::delete('projects/categories/{category}', [AdminProjectCategoryController::class, 'destroy'])->name('projects.categories.destroy');

    // Blog
    Route::resource('blog', AdminBlogController::class)->except('show');
    Route::post('blog/upload-image', [AdminBlogController::class, 'uploadImage'])->name('blog.upload-image');
    Route::get('blog/categories', [AdminBlogCategoryController::class, 'index'])->name('blog.categories.index');
    Route::post('blog/categories', [AdminBlogCategoryController::class, 'store'])->name('blog.categories.store');
    Route::put('blog/categories/{category}', [AdminBlogCategoryController::class, 'update'])->name('blog.categories.update');
    Route::delete('blog/categories/{category}', [AdminBlogCategoryController::class, 'destroy'])->name('blog.categories.destroy');

    // Certifications
    Route::resource('certifications', AdminCertificationController::class)->except('show');
    Route::get('certifications/categories', [AdminCertificationCategoryController::class, 'index'])->name('certifications.categories.index');
    Route::post('certifications/categories', [AdminCertificationCategoryController::class, 'store'])->name('certifications.categories.store');
    Route::put('certifications/categories/{category}', [AdminCertificationCategoryController::class, 'update'])->name('certifications.categories.update');
    Route::delete('certifications/categories/{category}', [AdminCertificationCategoryController::class, 'destroy'])->name('certifications.categories.destroy');

    // Skills
    Route::resource('skills', AdminSkillController::class)->except('show');
    Route::post('skills/reorder', [AdminSkillController::class, 'reorder'])->name('skills.reorder');

    // Experiences
    Route::resource('experiences', AdminExperienceController::class)->except('show');

    // Educations
    Route::resource('educations', AdminEducationController::class)->except('show');

    // Settings
    Route::get('settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [AdminSettingController::class, 'update'])->name('settings.update');

    // Messages
    Route::get('messages', [AdminMessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [AdminMessageController::class, 'show'])->name('messages.show');
    Route::delete('messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');
    
    // CV (single)
    Route::get('cv', [\App\Http\Controllers\Admin\AdminCVController::class, 'index'])->name('cv.index');
    Route::post('cv', [\App\Http\Controllers\Admin\AdminCVController::class, 'store'])->name('cv.store');
    Route::get('cv/download/{portfolio}', [\App\Http\Controllers\Admin\AdminCVController::class, 'download'])->name('cv.download');
    Route::delete('cv/{portfolio}', [\App\Http\Controllers\Admin\AdminCVController::class, 'destroy'])->name('cv.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
