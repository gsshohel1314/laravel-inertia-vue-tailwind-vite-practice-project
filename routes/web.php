<?php

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware('auth')->group(function() {
    Route::get('/home', function (Request $request) {

        return Inertia::render('Backend/Home', [
            'users' => User::when($request->search, function($query) use ($request){
                $query->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('email', 'like', '%'.$request->search.'%');
            })->paginate($request->limit ?? 5)->withQueryString(),

            'searchTerm' => $request->search,
            'paginationLimit' => (int) $request->limit,

            'can' => [
                'edit_user' => Auth::user() ? Auth::user()->can('edit', User::class) : null,
                'delete_user' => Auth::user() ? Auth::user()->can('delete', User::class) : null,
            ]
        ]);
    })->name('home');
    
    Route::get('/about', function() {
        return Inertia::render('Backend/About', [
            'user' => [
                'name' => 'Shohel',
                'age' => 29,
                'isStudent' => false
            ]
        ]);
    })->name('about');

    Route::post('/test-toastr', function() {
        return redirect()->back()->with('message', 'Registration successfully. Welcome to our dashboard.');
    })->name('test_toastr');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function() {
    Route::get('/', function () {
        return Inertia::render('Frontend/Welcome');
    })->name('welcome');

    Route::get('/register', [AuthController::class, 'registerShow'])->name('register.show');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    
    Route::get('/login', [AuthController::class, 'loginShow'])->name('login.show');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    
});


