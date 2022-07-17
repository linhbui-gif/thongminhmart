<?php
/* === User === */
$prefix = "auth";
$controllerName = "auth";
Route::prefix($prefix)->name($controllerName . ".")->middleware("locale")->group(function () use ($controllerName) {
    $controller = ucfirst($controllerName) . "Controller@";
    Route::get("/login", $controller . "login")->name("login");
    Route::post("/postLogin", $controller . "postLogin")->name("login.post");
    Route::get("/logout", $controller . "logout")->name("logout");
    Route::get("/change-lang/{lang}", $controller . "changeLang")->name("changeLang");
});

Route::namespace('Admin')->middleware("locale")->middleware("checkloginadmin")->prefix('admin')->name('admin.')->group(function () {
    Route::group(['prefix' => 'laravel-filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
    /* === welcome === */
    $prefix = "welcome";
    $controllerName = "welcome";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->name("index");
    });
    /* === User === */
    $prefix = "user";
    $controllerName = "user";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::get("{id}/change-password", $controller . "changePassword")->name("changePassword");
        Route::post("{id}/change-password", $controller . "updatePassword")->name("updatePassword");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}/sendResetPassword", $controller . "sendResetPassword")->middleware('can:' . $controllerName . '.edit')->name("sendResetPassword");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === Size product === */
    $prefix = "size";
    $controllerName = "size";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::get("{id}/change-password", $controller . "changePassword")->name("changePassword");
        Route::post("{id}/change-password", $controller . "updatePassword")->name("updatePassword");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}/sendResetPassword", $controller . "sendResetPassword")->middleware('can:' . $controllerName . '.edit')->name("sendResetPassword");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === Color product === */
    $prefix = "color";
    $controllerName = "color";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::get("{id}/change-password", $controller . "changePassword")->name("changePassword");
        Route::post("{id}/change-password", $controller . "updatePassword")->name("updatePassword");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}/sendResetPassword", $controller . "sendResetPassword")->middleware('can:' . $controllerName . '.edit')->name("sendResetPassword");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === Config ship fee all district === */
    $prefix = "ship_fee_district";
    $controllerName = "ship_fee_district";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::get("{id}/change-password", $controller . "changePassword")->name("changePassword");
        Route::post("{id}/change-password", $controller . "updatePassword")->name("updatePassword");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}/sendResetPassword", $controller . "sendResetPassword")->middleware('can:' . $controllerName . '.edit')->name("sendResetPassword");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === customer === */
    $prefix = "customer";
    $controllerName = "customer";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:'.$controllerName.'.index')->name("index");
        Route::get("/list-course/{id_customer}", $controller . "listCourse")->middleware('can:'.$controllerName.'.index')->name("list_course");
        Route::get("/remove/{id_customer}/{id_course}", $controller . "removeCourse")->middleware('can:'.$controllerName.'.index')->name("removeCourse");
    });
    /* === role === */
    $prefix = "role";
    $controllerName = "role";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === banner === */
    $prefix = "banner";
    $controllerName = "banner";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === discount === */
    $prefix = "discount";
    $controllerName = "discount";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === pages === */
    $prefix = "page";
    $controllerName = "page";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === blog tags === */
    $prefix = "blog_tags";
    $controllerName = "blog_tags";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === widgets === */
    $prefix = "widget";
    $controllerName = "widget";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === address === */
    $prefix = "address";
    $controllerName = "address";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === blog posts === */
    $prefix = "blog_posts";
    $controllerName = "blog_posts";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === product tags === */
    $prefix = "product tags";
    $controllerName = "product_tags";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === product products === */
    $prefix = "product_products";
    $controllerName = "product_products";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === menu === */
    $prefix = "menu";
    $controllerName = "menu";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->name("index");
    });
    /* === product category === */
    $prefix = "product_category";
    $controllerName = "product_category";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === categories === */
    $prefix = "blog_categories";
    $controllerName = "blog_categories";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === contact === */
    $prefix = "contact";
    $controllerName = "contact";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });

    /* === Question === */
    $prefix = "qa_question";
    $controllerName = "qa_question";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });

    /* === Translate === */
    $prefix = "translate";
    $controllerName = "translate";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
    });
    /* === Event === */
    $prefix = "event";
    $controllerName = "event";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::post("edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/update", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === Answer === */
    $prefix = "qa_answer";
    $controllerName = "qa_answer";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === course_category === */
    $prefix = "course_category";
    $controllerName = "course_category";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === course === */
    $prefix = "course_courses";
    $controllerName = "course_courses";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === compo === */
    $prefix = "compo";
    $controllerName = "compo";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::post("/", $controller . "store")->name("store");
        Route::get("/delete/{id}", $controller . "delete")->name("delete");
        Route::post("/add-compo", $controller . "addToCompo")->name("addToCompo");
        Route::post("/ordering", $controller . "changeOrdering")->name("changeOrdering");
        Route::get("/delete-item-in-compo", $controller . "deleteItemInCompo")->name("deleteItemInCompo");
    });
    /* === comment === */
    $prefix = "comment";
    $controllerName = "comment";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/delete/{id}", $controller . "delete")->name("delete");
        Route::get("/change-show/{id}/{show}", $controller . "changeShow")->name("changeShow");
    });
    /* === lesson === */
    $prefix = "lesson";
    $controllerName = "lesson";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("edit/{lesson_id}", $controller . "editLesson")->name("editLesson");
        Route::post("upload-video", $controller . "uploadVideo")->name("uploadVideo");
    });
    /* === Notification === */
    $prefix = "notification";
    $controllerName = "notification";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === chapter === */
    $prefix = "chapter";
    $controllerName = "chapter";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/{course_id}", $controller . "index_chapter")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("{course_id}/create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("{course_id}/store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
        Route::post("ordering", $controller . "ordering")->middleware('can:' . $controllerName . '.edit')->name("ordering");
    });
    /* === lesson === */
    $prefix = "lesson";
    $controllerName = "lesson";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === Bank === */
    $prefix = "bank";
    $controllerName = "bank";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === Coupon === */
    $prefix = "coupon";
    $controllerName = "coupon";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === Partner === */
    $prefix = "partner";
    $controllerName = "partner";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === Rank === */
    $prefix = "rank";
    $controllerName = "rank";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
    });
    /* === order === */
    $prefix = "order";
    $controllerName = "order";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("/thong-ke", $controller . "thongke")->middleware('can:' . $controllerName . '.index')->name("thongke");
        Route::get("get-data-statistic", $controller . "getDataStatistic")->name("getDataStatistic");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::get("{id}/detail", $controller . "detail")->middleware('can:' . $controllerName . '.edit')->name("detail");
        Route::post("{id}/update-status", $controller . "changeStatus")->middleware('can:' . $controllerName . '.edit')->name("changeStatus");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::get("{order_detail}/changeStatusCourse", $controller . "changeStatusCourse")->middleware('can:' . $controllerName . '.status_course')->name("status_course");

        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
        Route::get("{order_id}/{warehouse_id}/postGHTK", $controller . "postGHTK")->middleware('can:' . $controllerName . '.destroy')->name("postGHTK");
    });
    /* === tracnghiem === */
    $prefix = "tracnghiem";
    $controllerName = "tracnghiem";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::post("store", $controller . "store")->name("store");
        Route::post("update", $controller . "update")->name("update");
        Route::get("delete/{id}", $controller . "delete")->name("delete");
        Route::get("sort/{lesson_id}", $controller . "sort")->name("sort");
    });
    /* === warehouse === */
    $prefix = "warehouse";
    $controllerName = "warehouse";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("input-product", $controller . "inputProduct")->middleware('can:' . $controllerName . '.create')->name("inputProduct");
        Route::post("store-input-product", $controller . "storeInput")->middleware('can:' . $controllerName . '.create')->name("storeInput");
        Route::get("get-quantity", $controller . "getQuantity")->name("getQuantity");


        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === blog pages === */
    $prefix = "pages_dynamic";
    $controllerName = "pages_dynamic";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("create", $controller . "create")->middleware('can:' . $controllerName . '.create')->name("create");
        Route::post("store", $controller . "store")->middleware('can:' . $controllerName . '.create')->name("store");
        Route::get("{id}/edit", $controller . "edit")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
        Route::get("{id}", $controller . "destroy")->middleware('can:' . $controllerName . '.destroy')->name("destroy");
        Route::post("multiDestroy", $controller . "multiDestroy")->middleware('can:' . $controllerName . '.destroy')->name("multiDestroy");
    });
    /* === config === */
    $prefix = "config";
    $controllerName = "config";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("edit", $controller . "editAction")->middleware('can:' . $controllerName . '.edit')->name("edit");
        Route::post("{id}/edit", $controller . "update")->middleware('can:' . $controllerName . '.edit')->name("update");
    });

    /* === logs === */
    $prefix = "logs";
    $controllerName = "logs";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "indexLogs")->middleware('can:' . $controllerName . '.index')->name("index");
        Route::get("/check", $controller . "checkLogs")->middleware('can:' . $controllerName . '.checkLogs')->name("checkLogs");
    });
});
