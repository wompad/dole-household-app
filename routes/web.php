<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HouseholdController;
use App\Http\Controllers\HouseholdMemberController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    
    Route::get('/password/reset', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [PasswordResetController::class, 'reset'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // User Management Routes
    Route::resource('users', UserController::class);
    
    // Household Management Routes
    Route::resource('households', HouseholdController::class);
    
    // Household Member Management Routes
    Route::resource('household-members', HouseholdMemberController::class);
    Route::post('household-members/bulk', [HouseholdMemberController::class, 'storeBulk'])->name('household-members.bulk');
    
    // Dashboard
    Route::get('/dashboard', function () {
        $households = \App\Models\Household::with('members')->latest()->paginate(10);
        $totalHouseholds = \App\Models\Household::count();
        $totalMembers = \App\Models\HouseholdMember::count();
        $averageMembers = $totalHouseholds > 0 ? round($totalMembers / $totalHouseholds, 1) : 0;
        $recentRegistrations = \App\Models\Household::where('created_at', '>=', now()->subDays(30))->count();
        
        return view('dashboard', compact('households', 'totalHouseholds', 'totalMembers', 'averageMembers', 'recentRegistrations'));
    })->name('dashboard');
});
