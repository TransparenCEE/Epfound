<?php

$options = ['namespace' => 'Hazzard\Comments\Http\Controllers'];

if (version_compare(app()->version(), '5.2.0') >= 0) {
    $options['middleware'] = 'web';
}

Route::group($options, function ($router) {
    // Admin routes.

    $router->get('comments/admin/settings', [
        'as' => 'comments.admin.settings',
        'uses' => 'AdminSettingsController@index',
    ]);

    $router->put('comments/admin/settings', [
        'as' => 'comments.admin.settings',
        'uses' => 'AdminSettingsController@update',
    ]);

    $router->get('comments/admin', [
        'as' => 'comments.admin.index',
        'uses' => 'AdminDashboardController@index',
    ]);

    $router->get('comments/admin/{id}', [
        'as' => 'comments.admin.show',
        'uses' => 'AdminDashboardController@show',
    ]);

    $router->put('comments/admin/{id?}', [
        'as' => 'comments.admin.update',
        'uses' => 'AdminDashboardController@update',
    ]);

    $router->delete('comments/admin/{id}', [
        'as' => 'comments.admin.destroy',
        'uses' => 'AdminDashboardController@destroy',
    ]);

    // Comments routes.

    Route::resource('comments', 'CommentsController', ['only' => ['index', 'store', 'update']]);

    $router->post('comments/{id}/vote', [
        'as' => 'comments.vote',
        'uses' => 'CommentsController@vote',
    ]);
});
