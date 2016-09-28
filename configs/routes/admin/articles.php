<?php

$routes = array(

    /* Knowledge Base Categories */
    'kbarticle' => array(
        'path' => '/knowledge-base/articles/',
        'values' => array(
            'controller' => 'KbArticlesController',
            'action' => 'index'
        )
    ),
    'kbarticle-paging' => array(
        'params' => array(
            'page' => '(\d+)'
        ),
        'path' => '/knowledge-base/articles/{:page}/',
        'values' => array(
            'controller' => 'KbArticlesController',
            'action' => 'index'
        )
    ),
    'kbarticle-edit' => array(
        'path' => '/knowledge-base/articles/edit/{:id}/',
        'values' => array(
            'controller' => 'KbArticlesController',
            'action' => 'form'
        )
    ),
    'kbarticle-add' => array(
        'path' => '/knowledge-base/articles/add/',
        'values' => array(
            'controller' => 'KbArticlesController',
            'action' => 'form'
        )
    ),
    'kbarticle-delete' => array(
        'path' => '/knowledge-base/articles/delete/{:id}/',
        'values' => array(
            'controller' => 'KbArticlesController',
            'action' => 'delete'
        )
    )
);