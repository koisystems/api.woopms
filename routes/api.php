<?php

    $router->get('/ping', ['uses' => 'PingController@ping',]);

    $router->post('/auth/register', ['uses' => 'AuthController@register']);

    $router->post('/auth/login', ['uses' => 'AuthController@login']);

    /* Users */

    $router->get('/user/me', ['uses' => 'UserController@profile']);

    /* Room Types */

    $router->post('/{property_id}/roomtype', ['uses' => 'RoomTypeController@create']);
    $router->get('/{property_id}/roomtype', ['uses' => 'RoomTypeController@get']);
    $router->put('/{property_id}/roomtype/{id}', ['uses' => 'RoomTypeController@update']);
    $router->get('/{property_id}/roomtype/{id}', ['uses' => 'RoomTypeController@get']);
    $router->delete('/{property_id}/roomtype/{id}', ['uses' => 'RoomTypeController@destroy']);

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

    /* Policies */
    $router->post('/{property_id}/policy', ['uses' => 'PolicyController@create']);
    $router->get('/{property_id}/policy', ['uses' => 'PolicyController@get']);
    $router->put('/{property_id}/policy/{id}', ['uses' => 'PolicyController@update']);
    $router->get('/{property_id}/policy/{id}', ['uses' => 'PolicyController@get']);
    $router->delete('/{property_id}/policy/{id}', ['uses' => 'PolicyController@destroy']);

    /* Policy Rules */
    $router->post('/{property_id}/policy/{policy_id}/policyrule', ['uses' => 'PolicyRuleController@create']);
    $router->get('/{property_id}/policy/{policy_id}/policyrule', ['uses' => 'PolicyRuleController@get']);
    $router->put('/{property_id}/policy/{policy_id}/policyrule/{id}', ['uses' => 'PolicyRuleController@update']);
    $router->get('/{property_id}/policy/{policy_id}/policyrule/{id}', ['uses' => 'PolicyRuleController@get']);
    $router->delete('/{property_id}/policy/{policy_id}/policyrule/{id}', ['uses' => 'PolicyRuleController@destroy']);

    /* Room Rates */
    $router->post('/{property_id}/roomrate', ['uses' => 'RoomRateController@create']);
    $router->get('{property_id}/roomrate', ['uses' => 'RoomRateController@get']);
    $router->put('/{property_id}/roomrate/{id}', ['uses' => 'RoomRateController@update']);
    $router->get('/{property_id}/roomrate/{id}', ['uses' => 'RoomRateController@get']);
    $router->delete('/{property_id}/roomrate/{id}', ['uses' => 'RoomRateController@destroy']);

    $router->post('/{property_id}/roomrate/bulk', ['uses' => 'RoomRateController@bulkUpdate']);
