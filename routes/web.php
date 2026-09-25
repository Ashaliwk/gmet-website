<?php

use Illuminate\Support\Facades\Route;

// Frontend Controllers
use App\Http\Controllers\frontend\FrontendController;

// Backend Controllers
use App\Http\Controllers\backend\AdminLoginController;
use App\Http\Controllers\backend\AdminHomeController;
use App\Http\Controllers\backend\AdminServicesController;
use App\Http\Controllers\backend\TeamMemberController;
use App\Http\Controllers\backend\AdminProjectsController;
use App\Http\Controllers\backend\AdminPartnersController;
use App\Http\Controllers\backend\AdminContactsController;
use App\Http\Controllers\backend\AdminFaqsController;
use App\Http\Controllers\backend\AdminReviewController;

/*
|--------------------------------------------------------------------------
| GMET Public Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontendController::class, 'index'])->name('frontend.home');
Route::get('/about', [FrontendController::class, 'about'])->name('frontend.about');
Route::get('/services', [FrontendController::class, 'services'])->name('frontend.services');
Route::get('/team', [FrontendController::class, 'team'])->name('frontend.team');
Route::get('/projects', [FrontendController::class, 'projects'])->name('frontend.projects');
Route::get('/partners', [FrontendController::class, 'partners'])->name('frontend.partners');
Route::get('/resources', [FrontendController::class, 'resources'])->name('frontend.resources');
Route::get('/contact', [FrontendController::class, 'contact'])->name('frontend.contact');
Route::post('/contact', [FrontendController::class, 'submitContact'])->name('frontend.contact.submit');

Route::redirect('/index.html', '/');
Route::redirect('/pages/about.html', '/about');
Route::redirect('/pages/services.html', '/services');
Route::redirect('/pages/team.html', '/team');
Route::redirect('/pages/projects.html', '/projects');
Route::redirect('/pages/partners.html', '/partners');
Route::redirect('/pages/resources.html', '/resources');
Route::redirect('/pages/contact.html', '/contact');

// API Endpoints for external or headless GMET consumption
Route::prefix('api')->group(function () {
    Route::get('/services', [FrontendController::class, 'apiServices']);
    Route::get('/team', [FrontendController::class, 'apiTeam']);
    Route::get('/projects', [FrontendController::class, 'apiProjects']);
    Route::get('/partners', [FrontendController::class, 'apiPartners']);
    Route::post('/contact', [FrontendController::class, 'submitContact']);
});

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', function () {
    if (session()->has('email')) {
        return redirect('/admin');
    }
    return view('backend.login');
})->name('admin.login');

Route::post('/admin/login', [AdminLoginController::class, 'onLogin']);
Route::get('/admin/logout', [AdminLoginController::class, 'logoutAdmin'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/
Route::get('/admin', [AdminHomeController::class, 'index'])->name('admin.dashboard');

// Admin Accounts
Route::get('/admin/register', [AdminHomeController::class, 'registerAdmin'])->name('admin.create');
Route::post('/admin/register', [AdminHomeController::class, 'submitAdminRecord']);
Route::get('/admin/admins-list', [AdminHomeController::class, 'showAdminRecord'])->name('admin.show');
Route::get('/admin/delete/{id}', [AdminHomeController::class, 'deleteAdminRecord'])->name('admin.delete');
Route::get('/admin/edit/{id}', [AdminHomeController::class, 'editAdminRecord'])->name('admin.edit');
Route::post('/admin/update/{id}', [AdminHomeController::class, 'updateAdminRecord'])->name('admin.update');

// GMET Services Management
Route::get('/admin/services', [AdminServicesController::class, 'index'])->name('service.show');
Route::get('/admin/service-add', [AdminServicesController::class, 'create'])->name('service.add');
Route::post('/admin/service-add', [AdminServicesController::class, 'store']);
Route::get('/admin/service-edit/{id}', [AdminServicesController::class, 'edit'])->name('service.edit');
Route::put('/admin/service-edit/{id}', [AdminServicesController::class, 'update'])->name('service.update');
Route::delete('/admin/service-delete/{id}', [AdminServicesController::class, 'destroy'])->name('service.delete');
Route::patch('/admin/service-status/{id}', [AdminServicesController::class, 'toggleStatus'])->name('service.status');

// GMET Team Management
Route::get('/admin/team', [TeamMemberController::class, 'index'])->name('team.show');
Route::get('/admin/team-add', [TeamMemberController::class, 'create'])->name('team.add');
Route::post('/admin/team-add', [TeamMemberController::class, 'store']);
Route::get('/admin/team-edit/{id}', [TeamMemberController::class, 'edit'])->name('team.edit');
Route::put('/admin/team-edit/{id}', [TeamMemberController::class, 'update'])->name('team.update');
Route::get('/admin/team-delete/{id}', [TeamMemberController::class, 'destroy']);
Route::delete('/admin/team-delete/{id}', [TeamMemberController::class, 'destroy'])->name('team.delete');
Route::patch('/admin/team-status/{id}', [TeamMemberController::class, 'toggleStatus'])->name('team.status');

// GMET Projects Management
Route::get('/admin/projects', [AdminProjectsController::class, 'index'])->name('project.show');
Route::get('/admin/project-add', [AdminProjectsController::class, 'addProject'])->name('project.add');
Route::post('/admin/project-add', [AdminProjectsController::class, 'submitProjectRecord']);
Route::get('/admin/project-edit/{id}', [AdminProjectsController::class, 'editProject'])->name('project.edit');
Route::put('/admin/project-edit/{id}', [AdminProjectsController::class, 'updateProject'])->name('project.update');
Route::delete('/admin/project-delete/{id}', [AdminProjectsController::class, 'deleteProject'])->name('project.delete');
Route::patch('/admin/project-status/{id}', [AdminProjectsController::class, 'toggleStatus'])->name('project.status');

// GMET Partners Management
Route::get('/admin/partners', [AdminPartnersController::class, 'index'])->name('partner.show');
Route::get('/admin/partner-add', [AdminPartnersController::class, 'create'])->name('partner.add');
Route::post('/admin/partner-add', [AdminPartnersController::class, 'store']);
Route::get('/admin/partner-edit/{id}', [AdminPartnersController::class, 'edit'])->name('partner.edit');
Route::put('/admin/partner-edit/{id}', [AdminPartnersController::class, 'update'])->name('partner.update');
Route::delete('/admin/partner-delete/{id}', [AdminPartnersController::class, 'destroy'])->name('partner.delete');
Route::patch('/admin/partner-status/{id}', [AdminPartnersController::class, 'toggleStatus'])->name('partner.status');

// GMET Contact Messages / Inquiries
Route::get('/admin/contacts', [AdminContactsController::class, 'index'])->name('contact.show');
Route::patch('/admin/contact-read/{id}', [AdminContactsController::class, 'markRead'])->name('contact.read');
Route::delete('/admin/contact-delete/{id}', [AdminContactsController::class, 'destroy'])->name('contact.delete');

// Legacy FAQs & Reviews (kept intact)
Route::get('/admin/faqs', [AdminFaqsController::class, 'index'])->name('faq.show');
Route::get('/admin/faq-add', [AdminFaqsController::class, 'addFAQ'])->name('faq.add');
Route::post('/admin/faq-add', [AdminFaqsController::class, 'submitFaqRecord']);
Route::get('/admin/faq-edit/{id}', [AdminFaqsController::class, 'editFAQ'])->name('faq.edit');
Route::put('/admin/faq-edit/{id}', [AdminFaqsController::class, 'updateFAQ'])->name('faq.update');
Route::delete('/admin/faq-delete/{id}', [AdminFaqsController::class, 'deleteFAQ'])->name('faq.delete');

Route::get('/admin/reviews', [AdminReviewController::class, 'index'])->name('review.show');
Route::get('/admin/review-add', [AdminReviewController::class, 'addReview'])->name('review.add');
Route::post('/admin/review-add', [AdminReviewController::class, 'submitReviewRecord']);
Route::get('/admin/review-edit/{id}', [AdminReviewController::class, 'editReview'])->name('review.edit');
Route::put('/admin/review-edit/{id}', [AdminReviewController::class, 'updateReview'])->name('review.update');
Route::patch('/admin/review-approve/{id}', [AdminReviewController::class, 'approveReview'])->name('review.approve');
Route::delete('/admin/review-delete/{id}', [AdminReviewController::class, 'deleteReview'])->name('review.delete');

// Blog management routes
use App\Http\Controllers\frontend\BlogController as FrontBlogController;
use App\Http\Controllers\backend\BlogController as AdminBlogController;

// Frontend blog page
Route::get('/blog', [FrontBlogController::class, 'index'])->name('frontend.blog');
Route::get('/blog/{id}', [FrontBlogController::class, 'show'])->name('frontend.blog.show');

// Admin blog CRUD
Route::get('/admin/blogs', [AdminBlogController::class, 'index'])->name('admin.blogs');
Route::get('/admin/blogs/create', [AdminBlogController::class, 'create'])->name('admin.blogs.create');
Route::post('/admin/blogs', [AdminBlogController::class, 'store'])->name('admin.blogs.store');
Route::get('/admin/blogs/{id}/edit', [AdminBlogController::class, 'edit'])->name('admin.blogs.edit');
Route::put('/admin/blogs/{id}', [AdminBlogController::class, 'update'])->name('admin.blogs.update');
Route::delete('/admin/blogs/{id}', [AdminBlogController::class, 'destroy'])->name('admin.blogs.destroy');