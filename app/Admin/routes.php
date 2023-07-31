<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.as'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('material','MaterialController');
    $router->resource('sku','SkuController');
    $router->resource('inbound','InboundController');
    $router->resource('outbound','OutboundController');
    $router->resource('inventory','InventoryController');
    $router->get('inbound/items/{inbound_id}','InboundController@items')->name('inbound.items');
    $router->put('inbound/items/{inbound_id}/{item_id}','InboundController@itemUpdate')->name('inbound.items');

});
