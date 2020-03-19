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

    /* Rate Pan */

    /* Reservation */
