<?php

$routes = array(

    /* Knowledge Base Categories */
    'kbcategory' => array(
        'path' => '/knowledge-base/categories/',
        'values' => array(
            'controller' => 'KbCategoriesController',
            'action' => 'index'
        )
    ),
    'kbcategory-paging' => array(
        'params' => array(
            'page' => '(\d+)'
        ),
        'path' => '/knowledge-base/categories/{:page}/',
        'values' => array(
            'controller' => 'KbCategoriesController',
            'action' => 'index'
        )
    ),
    'kbcategory-edit' => array(
        'path' => '/knowledge-base/categories/edit/{:id}/',
        'values' => array(
            'controller' => 'KbCategoriesController',
            'action' => 'form'
        )
    ),
    'kbcategory-add' => array(
        'path' => '/knowledge-base/categories/add/',
        'values' => array(
            'controller' => 'KbCategoriesController',
            'action' => 'form'
        )
    ),
    'kbcategory-delete' => array(
        'path' => '/knowledge-base/categories/delete/{:id}/',
        'values' => array(
            'controller' => 'KbCategoriesController',
            'action' => 'delete'
        )
    )
);