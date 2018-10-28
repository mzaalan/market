<?php
use Illuminate\Routing\Router;
Route::group(['middleware' => ['web', 'auth']], function (Router $router) {
    $router->resource('notifications', 'NotificationsController');
    $router->resource('points', 'PointsMagazineController');
    $router->resource('slider', 'SliderController');
    $router->resource('offers', 'OffersController');
    $router->resource('user', 'UserController');
    $router->post('magazine/activate/{id}','MagazineController@activate');
    $router->resource('magazine', 'MagazineController');
    $router->resource('magazine-images', 'MagazineImageController');
    $router->resource('magazine-bg', 'MagazineBGController',
        [
            'only' => ['index'],
        ]
    );

    $router->post('magazine-bg/upload/{id}', [
            'as' => 'upload',
            'uses' => 'MagazineBGController@upload'
        ]
    );

    $router->resource('photos', 'PhotoController',
        [
            'only' => ['store'],
        ]
    );
    $router->resource('contact', 'ContactController',
        [
            'only' => ['index', 'destroy', 'update'],
        ]
    );
});
