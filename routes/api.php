<?php

    $router->get('/ping', ['uses' => 'PingController@ping',]);

    $router->post('/auth/register', ['uses' => 'AuthController@register']);

    $router->post('/auth/login', ['uses' => 'AuthController@login']);

    /* Users */

    $router->get('/user/me', ['uses' => 'UserController@profile']);

    /* Room Inventory */

    $router->post('/{property_id}/roominventory', ['uses' => 'RoomInventoryController@create']);
    $router->get('/{property_id}/roominventory', ['uses' => 'RoomInventoryController@get']);
    $router->put('/{property_id}/roominventory/{id}', ['uses' => 'RoomInventoryController@update']);
    $router->get('/{property_id}/roominventory/{id}', ['uses' => 'RoomInventoryController@get']);
    $router->delete('/{property_id}/roominventory/{id}', ['uses' => 'RoomInventoryController@destroy']);

    /* Room */

    $router->post('/{property_id}/room', ['uses' => 'RoomController@create']);
    $router->get('/{property_id}/room', ['uses' => 'RoomController@get']);
    $router->put('/{property_id}/room/{id}', ['uses' => 'RoomController@update']);
    $router->get('/{property_id}/room/{id}', ['uses' => 'RoomController@get']);
    $router->delete('/{property_id}/room/{id}', ['uses' => 'RoomController@destroy']);

    /* Rate Plan */
    $router->post('/{property_id}/rateplan', ['uses' => 'RatePlanController@create']);
    $router->get('/{property_id}/rateplan', ['uses' => 'RatePlanController@get']);
    $router->put('/{property_id}/rateplan/{id}', ['uses' => 'RatePlanController@update']);
    $router->get('/{property_id}/rateplan/{id}', ['uses' => 'RatePlanController@get']);
    $router->delete('/{property_id}/rateplan/{id}', ['uses' => 'RatePlanController@destroy']);
