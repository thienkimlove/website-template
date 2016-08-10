<?php

return [
    1 => [
        'label' => 'Manager',
        'permission' => [
            'HomeController@index',

            'CategoriesController@index',
            'CategoriesController@create',
            'CategoriesController@edit',
            'CategoriesController@destroy',
            'CategoriesController@update',
            'CategoriesController@store',

            'PostsController@index',
            'PostsController@create',
            'PostsController@edit',
            'PostsController@destroy',
            'PostsController@update',
            'PostsController@store',

        ]
    ],

    2 => [
        'label' => 'Editor',
        'permission' => [
            'HomeController@index',

            'CategoriesController@index',
            'CategoriesController@create',
            'CategoriesController@edit',
            'CategoriesController@destroy',
            'CategoriesController@update',
            'CategoriesController@store',

            'PostsController@index',
            'PostsController@create',
            'PostsController@edit',
            'PostsController@destroy',
            'PostsController@update',
            'PostsController@store',
        ]
    ]
];