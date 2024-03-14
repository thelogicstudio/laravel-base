<?php

    use App\Http\Controllers\AuditController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\RoleController;
    use App\Http\Controllers\UserController;
    use Illuminate\Support\Facades\Route;

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
@include_once('admin_web.php');

Route::get('/', function () {
    return redirect()->route('login');
})->name('/');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('audit', AuditController::class);
    Route::get('roles/destroy/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('auditLog/{model}/{id}', [AuditController::class, 'auditLog'])->name('auditLog');
});

require __DIR__.'/auth.php';
