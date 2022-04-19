<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');

Route::get('/posts/create',[PostController::class, 'create'])->name('posts.create')->middleware('auth');

Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');


//show route after posts accept any params .. dynamic routes 

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show')->middleware('auth');   

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
Route::patch('/posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware('auth');



Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');


//comments

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');

Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//  github 
Route::get('/auth/github/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/github/callback', function () {

    $githubUser = Socialite::driver('github')->user();
 
    $user = User::where('github_id', $githubUser->id)->first();
 
    if ($user) {
        $user->update([
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    } else {
        $user = User::create([
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'github_id' => $githubUser->id,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    }
 
    Auth::login($user);
 
    return redirect('/posts');
});

//google
Route::get('/auth/google/redirect', function () {

    return Socialite::driver('google')->redirect();

});

Route::get('/auth/google/callback', function () {

    $googleUser = Socialite::driver('google')->user();
    $user = User::where('google_id', $googleUser->id)->first();
    if ($user) {
    $user->update([
    'google_token' => $googleUser->token,
    'google_refresh_token' => $googleUser->refreshToken,
    ]);
    } else {
    $user = User::create([
    'name' => $googleUser->name,
    'email' => $googleUser->email,
    'google_id' => $googleUser->id,
    'google_token' => $googleUser->token,
    'google_refresh_token' => $googleUser->refreshToken,
    ]);
    }
    Auth::login($user);
    return redirect('/posts');
});
    

