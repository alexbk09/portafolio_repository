<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SocialAuthController;

// Página principal
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rutas de autenticación
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Rutas del portfolio
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{project}', [PortfolioController::class, 'show'])->name('portfolio.show');

// Rutas públicas de freelancers
Route::get('/freelancers', [FreelancerController::class, 'index'])->name('freelancers.index');
Route::get('/freelancers/{freelancer}', [FreelancerController::class, 'show'])->name('freelancers.show');

// Rutas de contacto
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Rutas de testimonios (públicas)
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');

// Ruta para refrescar captcha
Route::get('/refresh-captcha', function () {
    $captcha = \App\Helpers\CaptchaHelper::generateCaptcha();
    session([config('captcha.session_key', 'captcha_answer') => $captcha['answer']]);
    return response()->json($captcha);
})->name('refresh.captcha');

// Rutas de autenticación social
Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirect'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])->name('social.callback');
Route::get('/auth/select-role', [SocialAuthController::class, 'selectRole'])->name('social.select-role');
Route::post('/auth/save-role', [SocialAuthController::class, 'saveRole'])->name('social.save-role');

// Dashboard (protegido por autenticación)
Route::middleware(['auth'])->group(function () {
    // Dashboard administrativo (solo admin)
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });
    
    // Rutas de freelancers autenticados
    Route::middleware(['auth', 'role:freelancer'])->group(function () {
        Route::get('/freelancer/dashboard', [FreelancerController::class, 'dashboard'])->name('freelancer.dashboard');
        Route::get('/freelancer/profile', [FreelancerController::class, 'profile'])->name('freelancer.profile');
        Route::get('/freelancer/edit', [FreelancerController::class, 'edit'])->name('freelancer.edit');
        Route::put('/freelancer/update', [FreelancerController::class, 'update'])->name('freelancer.update');
    });
    

    
    // Rutas de clientes
    Route::middleware(['auth', 'role:client'])->group(function () {
        Route::get('/client/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
        Route::get('/client/profile', [ClientController::class, 'profile'])->name('client.profile');
        Route::put('/client/profile', [ClientController::class, 'updateProfile'])->name('client.profile.update');
        Route::get('/client/quotes', [ClientController::class, 'quotes'])->name('client.quotes');
        Route::get('/client/testimonials', [ClientController::class, 'testimonials'])->name('client.testimonials');
        Route::get('/client/notifications', [ClientController::class, 'notifications'])->name('client.notifications');
        Route::post('/client/notifications/{id}/read', [ClientController::class, 'markNotificationAsRead'])->name('client.notifications.read');
        Route::post('/client/notifications/read-all', [ClientController::class, 'markAllNotificationsAsRead'])->name('client.notifications.read-all');
    });
    
    // Rutas de testimonios (autenticadas)
    Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
    Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
    Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');
    
    // Rutas de cotizaciones (autenticadas)
    Route::get('/quotes', [QuoteController::class, 'index'])->name('quotes.index');
    Route::get('/quotes/create', [QuoteController::class, 'create'])->name('quotes.create');
    Route::post('/quotes', [QuoteController::class, 'store'])->name('quotes.store');
    Route::get('/quotes/{quote}', [QuoteController::class, 'show'])->name('quotes.show');
    Route::delete('/quotes/{quote}', [QuoteController::class, 'destroy'])->name('quotes.destroy');
    
    // Rutas de notificaciones
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/notifications', [NotificationController::class, 'clearAll'])->name('notifications.clear-all');
    
    // Rutas administrativas (solo admin)
    Route::middleware(['auth', 'role:admin'])->group(function () {
        // Portfolio Admin Routes
        Route::get('/admin/portfolio', [PortfolioController::class, 'admin'])->name('admin.portfolio');
        Route::post('/admin/portfolio', [PortfolioController::class, 'store'])->name('admin.portfolio.store');
        Route::put('/admin/portfolio/{project}', [PortfolioController::class, 'update'])->name('admin.portfolio.update');
        Route::delete('/admin/portfolio/{project}', [PortfolioController::class, 'destroy'])->name('admin.portfolio.destroy');
        
        // Contact Admin Routes
        Route::get('/admin/contact', [ContactController::class, 'admin'])->name('admin.contact');
        Route::post('/admin/contact/{contact}/mark-read', [ContactController::class, 'markAsRead'])->name('admin.contact.mark-read');
        Route::delete('/admin/contact/{contact}', [ContactController::class, 'destroy'])->name('admin.contact.destroy');
        
        // Skills Admin Routes
        Route::get('/admin/skills', [SkillController::class, 'admin'])->name('admin.skills');
        Route::post('/admin/skills', [SkillController::class, 'store'])->name('admin.skills.store');
        Route::get('/admin/skills/{skill}/edit', [SkillController::class, 'edit'])->name('admin.skills.edit');
        Route::put('/admin/skills/{skill}', [SkillController::class, 'update'])->name('admin.skills.update');
        Route::delete('/admin/skills/{skill}', [SkillController::class, 'destroy'])->name('admin.skills.destroy');
        
        // Freelancers Admin Routes
        Route::get('/admin/freelancers', [FreelancerController::class, 'admin'])->name('admin.freelancers');
        Route::delete('/admin/freelancers/{freelancer}', [FreelancerController::class, 'destroy'])->name('admin.freelancers.destroy');
        
        // Testimonios admin
        Route::get('/admin/testimonials', [TestimonialController::class, 'admin'])->name('admin.testimonials');
        Route::post('/admin/testimonials/{testimonial}/approve', [TestimonialController::class, 'approve'])->name('admin.testimonials.approve');
        Route::post('/admin/testimonials/{testimonial}/reject', [TestimonialController::class, 'reject'])->name('admin.testimonials.reject');
        Route::post('/admin/testimonials/{testimonial}/toggle-featured', [TestimonialController::class, 'toggleFeatured'])->name('admin.testimonials.toggle-featured');
        Route::delete('/admin/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('admin.testimonials.destroy');
        
        // Cotizaciones admin
        Route::get('/admin/quotes', [QuoteController::class, 'admin'])->name('admin.quotes');
        Route::post('/admin/quotes/{quote}/status', [QuoteController::class, 'updateStatus'])->name('admin.quotes.update-status');
        Route::delete('/admin/quotes/{quote}', [QuoteController::class, 'adminDestroy'])->name('admin.quotes.destroy');
        
        // Notificaciones admin
        Route::get('/admin/notifications', [NotificationController::class, 'admin'])->name('admin.notifications');
        Route::post('/admin/notifications/mark-all-read', [NotificationController::class, 'adminMarkAllAsRead'])->name('admin.notifications.mark-all-read');
        Route::delete('/admin/notifications/clear-all', [NotificationController::class, 'adminClearAll'])->name('admin.notifications.clear-all');
        Route::post('/admin/notifications/{notification}/mark-read', [NotificationController::class, 'adminMarkAsRead'])->name('admin.notifications.mark-read');
        Route::delete('/admin/notifications/{id}', [NotificationController::class, 'adminDestroy'])->name('admin.notifications.destroy');
    });
});
