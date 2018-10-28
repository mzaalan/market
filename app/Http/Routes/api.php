<?php
use Illuminate\Routing\Router;
Route::group(['prefix' => 'api/v1.0', 'middleware' => 'api'], function (Router $router) {

    $router->resource('device', 'MobileDevicesController',
        [
            'only' => ['store'],
        ]
    );

    $router->resource('notification', 'NotificationsController',
        [
            'only' => ['index', 'show'],
        ]
    );

    $router->resource('points_magazine', 'PointsMagazineController',
        [
            'only' => ['index', 'show'],
        ]
    );

    $router->resource('slide', 'SliderController',
        [
            'only' => ['index', 'show'],
        ]
    );

    $router->resource('offer', 'OffersController',
        [
            'only' => ['index', 'show'],
        ]
    );

    $router->resource('contact', 'ContactController',
        [
            'only' => ['store'],
        ]
    );

    $router->resource('magazine', 'MagazineController',
        [
            'only' => ['index', 'show'],
        ]
    );

    $router->resource('photo.size', 'PhotoController',
        [
            'only' => ['show'],
        ]
    );
});
