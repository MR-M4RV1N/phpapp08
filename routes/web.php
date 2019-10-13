<?php

// MIDDLEWARE
$mw = function ($request, $response, $next) {
    session_start();
    if (!(isset($_SESSION['name']) && $_SESSION['name'] != '')) {
        return $response->withRedirect('/login', 301);
    }
    $response = $next($request, $response);
    return $response;
};

// START
$app->get('/', '\App\Controllers\HomeController:index');
// SIGN SYSTEM
$app->get('/register', '\App\Controllers\RegisterController:register');
$app->post('/register/post', '\App\Controllers\RegisterController:post');
$app->get('/login', '\App\Controllers\LoginController:login');
$app->post('/login/post', '\App\Controllers\LoginController:post');
$app->get('/logout', '\App\Controllers\LoginController:logout');
// ADMIN PANEL
$app->get('/admin', '\App\Controllers\AdminController:index')->add($mw);
// CAT-EDITOR
$app->get('/admin/editor/cat', '\App\Controllers\Editor\CatController:index')->add($mw);
$app->get('/admin/editor/cat/show/{id}', '\App\Controllers\Editor\CatController:show')->add($mw);
$app->get('/admin/editor/cat/edit/{id}', '\App\Controllers\Editor\CatController:edit')->add($mw);
$app->post('/admin/editor/cat/update/{id}', '\App\Controllers\Editor\CatController:update')->add($mw);
$app->get('/admin/editor/cat/create', '\App\Controllers\Editor\CatController:create')->add($mw);
$app->post('/admin/editor/cat/store', '\App\Controllers\Editor\CatController:store')->add($mw);
$app->post('/admin/editor/cat/delete/{id}', '\App\Controllers\Editor\CatController:delete')->add($mw);
//SUB-EDITOR
$app->get('/admin/editor/sub/create/{id}', '\App\Controllers\Editor\SubController:create')->add($mw);
$app->post('/admin/editor/sub/store/{id}', '\App\Controllers\Editor\SubController:store')->add($mw);
$app->get('/admin/editor/sub/{id}', '\App\Controllers\Editor\SubController:index')->add($mw);
$app->get('/admin/editor/sub/show/{id}', '\App\Controllers\Editor\SubController:show')->add($mw);
$app->get('/admin/editor/sub/edit/{id}', '\App\Controllers\Editor\SubController:edit')->add($mw);
$app->post('/admin/editor/sub/update/{id}', '\App\Controllers\Editor\SubController:update')->add($mw);
$app->post('/admin/editor/sub/delete/{id}', '\App\Controllers\Editor\SubController:delete')->add($mw);
//SUB-SUB-EDITOR
$app->get('/admin/editor/subsub/create/{id}', '\App\Controllers\Editor\SubSubController:create')->add($mw);
$app->post('/admin/editor/subsub/store/{id}', '\App\Controllers\Editor\SubSubController:store')->add($mw);
$app->get('/admin/editor/subsub/{id}', '\App\Controllers\Editor\SubSubController:index')->add($mw);
$app->get('/admin/editor/subsub/show/{id}', '\App\Controllers\Editor\SubSubController:show')->add($mw);
$app->get('/admin/editor/subsub/edit/{id}', '\App\Controllers\Editor\SubSubController:edit')->add($mw);
$app->post('/admin/editor/subsub/update/{id}', '\App\Controllers\Editor\SubSubController:update')->add($mw);
$app->post('/admin/editor/subsub/delete/{id}', '\App\Controllers\Editor\SubSubController:delete')->add($mw);
//CATEGORY
$app->get('/admin/categories', '\App\Controllers\CategoryController:index')->add($mw);
$app->get('/admin/cat_category/{id}', '\App\Controllers\CategoryController:cat')->add($mw);
$app->get('/admin/sub_category/{cat}/{id}', '\App\Controllers\CategoryController:sub')->add($mw);
$app->get('/admin/sub_sub_category/{cat}/{sub}/{id}', '\App\Controllers\CategoryController:subsub')->add($mw);

