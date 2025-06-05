<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UlasanController;

// Home route
Route::get('/', function () {
    return view('home');
})->name('home');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // User routes - hanya bisa menambah ulasan
    Route::middleware('user')->group(function () {
        Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan.index');
        Route::get('/ulasan/create', [UlasanController::class, 'create'])->name('ulasan.create');
        Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');
        Route::get('/ulasan/{ulasan}', [UlasanController::class, 'show'])->name('ulasan.show');
    });

    // Admin routes - hanya bisa edit dan hapus ulasan
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan.index');
        Route::get('/ulasan/{ulasan}', [UlasanController::class, 'show'])->name('ulasan.show');
        Route::get('/ulasan/{ulasan}/edit', [UlasanController::class, 'edit'])->name('ulasan.edit');
        Route::put('/ulasan/{ulasan}', [UlasanController::class, 'update'])->name('ulasan.update');
        Route::delete('/ulasan/{ulasan}', [UlasanController::class, 'destroy'])->name('ulasan.destroy');
    });
});
