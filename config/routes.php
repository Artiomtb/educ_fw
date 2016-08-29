<?php

return [
    'index' => [
        'pattern' => '/',
        'action' => 'IndexController@index'
    ],
    'hello' => [
        'pattern' => '/hello/{name}:{times}',
        'action' => 'IndexController@hello',
        'method' => 'GET',
        'variables' => [
            'name' => '.+',
            'times' => '\d+'
        ]
    ],
    'api_get_all' => [
        'pattern' => '/api',
        'action' => 'ApiController@getAll'
    ],
    'api_get_item' => [
        'pattern' => '/api/{key}',
        'action' => 'ApiController@getItem'
    ],
    'api_create_item' => [
        'pattern' => '/api',
        'action' => 'ApiController@createItem',
        'method' => 'POST'
    ],
    'api_update_item' => [
        'pattern' => '/api/{key}',
        'action' => 'ApiController@updateItem',
        'method' => 'PUT'
    ]
];