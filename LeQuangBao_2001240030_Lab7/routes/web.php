<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
// Bài 1: Route có tham số động
Route::get('/articles/page/{page}', function ($page) {
    return "Trang bài viết số: " . (int)$page;
})->whereNumber('page')->name('articles.page');
// Bài 1: Route có tham số tùy chọn
Route::get('/articles/slug/{slug?}', function ($slug = 'khong-co-slug') {
    return "Slug: " . $slug;
})->where('slug', '[a-z0-9-]+');
// Bài 1: Route group
Route::prefix('admin')->group(function () {
    Route::get('/articles', fn() => 'Quản trị bài viết')->name('admin.articles.index');
});
// Bài 2: RESTful Resource Routes
Route::resource('articles', ArticleController::class); 

Route::get('/', fn() => redirect()->route('articles.index'));