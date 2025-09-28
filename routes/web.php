<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterController;

// 🌿 Public Pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/events', [PageController::class, 'events'])->name('events');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'submitContactForm'])->name('contact.submit');

// 👤 Member Registration (Fixed route name)
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

// 🔐 Combined Login (Member + Admin)
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'combinedLogin'])->name('login.submit');

// 🚪 Logout (for both)
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/logout', function () { Auth::logout(); return redirect('/login');})->name('logout.user');

// 👤 Member Profile & Join Event
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/events/join/{id}', [EventController::class, 'join'])->name('events.join');
});

// 🔐 Admin Panel Routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // 👥 Member Management
    Route::get('/members', [AdminController::class, 'members'])->name('admin.members');
    Route::get('/members/edit/{id}', [AdminController::class, 'editMember'])->name('admin.members.edit');
    Route::post('/members/update/{id}', [AdminController::class, 'updateMember'])->name('admin.members.update');
    Route::delete('/members/delete/{id}', [AdminController::class, 'deleteMember'])->name('admin.members.delete');

    // 📅 Event Management
    Route::get('/events', [AdminController::class, 'events'])->name('admin.events');
    Route::post('/events/store', [AdminController::class, 'storeEvent'])->name('admin.events.store');
    Route::get('/events/edit/{id}', [AdminController::class, 'editEvent'])->name('admin.events.edit');
    Route::match(['POST', 'PUT'], '/events/update/{id}', [AdminController::class, 'updateEvent'])->name('admin.events.update');
    Route::delete('/events/delete/{id}', [AdminController::class, 'deleteEvent'])->name('admin.events.delete');

    // 👀 View Members per Event
    Route::get('/event-members', [AdminController::class, 'viewEventMembers'])->name('admin.event.members');
});

// 🧠 Super Admin (Optional)
Route::get('/superadmin/dashboard', function () {
    return view('superadmin.dashboard');
})->name('superadmin.dashboard');

// ⚠️ DEV: Create Initial Admin
Route::get('/create-admin', function () {
    if (!Admin::where('email', 'admin@admin.com')->exists()) {
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'role' => 'super_admin'
        ]);
        return '✅ Admin created successfully!';
    } else {
        return '⚠️ Admin already exists.';
    }
});

// ⚠️ DEV: Reset Admin Password
Route::get('/reset-admin-password', function () {
    $updated = Admin::where('email', 'admin@admin.com')->update([
        'password' => Hash::make('admin123')
    ]);

    return $updated
        ? '✅ Admin password reset to <strong>admin123</strong>'
        : '❌ Admin not found.';
});
