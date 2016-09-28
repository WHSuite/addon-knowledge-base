<?php

$routes = array(

    /* Knowledge Base main page */
    'knowledgebase' => array(
        'path' => '/knowledge-base/',
        'values' => array(
            'controller' => 'KnowledgeBaseController',
            'action' => 'index'
        )
    ),

    /* Knowledge Base category page */
    'knowledgebase-category' => array(
        'path' => '/knowledge-base/category/{:slug}/',
        'params' => array(
            'slug' => '([a-zA-Z0-9-]+)'
        ),
        'values' => array(
            'controller' => 'KnowledgeBaseController',
            'action' => 'category'
        )
    ),

    'knowledgebase-category-paging' => array(
        'path' => '/knowledge-base/category/{:slug}/{:page}/',
        'params' => array(
            'slug' => '([a-zA-Z0-9-]+)',
            'page' => '(\d+)'
        ),
        'values' => array(
            'controller' => 'KnowledgeBaseController',
            'action' => 'category'
        )
    ),

    /* Knowledge Base article page */
    'knowledgebase-article' => array(
        'path' => '/knowledge-base/article/{:slug}/',
        'params' => array(
            'slug' => '([a-zA-Z0-9-]+)'
        ),
        'values' => array(
            'controller' => 'KnowledgeBaseController',
            'action' => 'article'
        )
    ),

    /* Knowledge Base article rating */
    'knowledgebase-rating' => array(
        'path' => '/knowledge-base/rating/',
        'values' => array(
            'controller' => 'KnowledgeBaseController',
            'action' => 'rating'
        )
    ),

    /* Knowledge Base search page */
    'knowledgebase-search' => array(
        'path' => '/knowledge-base/search/',
        'values' => array(
            'controller' => 'KnowledgeBaseController',
            'action' => 'search'
        )
    ),

    'knowledgebase-search-paging' => array(
        'path' => '/knowledge-base/search/{:search_get}/{:page}/',
        'params' => array(
            'search_get' => '([a-zA-Z0-9-]+)',
            'page' => '(\d+)'
        ),
        'values' => array(
            'controller' => 'KnowledgeBaseController',
            'action' => 'search'
        )
    )

);
