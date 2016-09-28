<?php

class KbCategoriesController extends \AdminController
{
    protected function indexToolbar()
    {
        return array(
            array(
                'url_route' => 'admin-kbcategory',
                'link_class' => '',
                'icon' => 'fa fa-list-ul',
                'label' => 'kbcategory_management'
            ),
            array(
                'url_route' => 'admin-kbcategory-add',
                'link_class' => '',
                'icon' => 'fa fa-plus',
                'label' => 'kbcategory_add'
            )
        );
    }

    protected function indexActions()
    {
        return array(
            'edit' => array(
                'url_route' => 'admin-kbcategory-edit',
                'link_class' => 'btn btn-primary btn-small pull-right',
                'icon' => 'fa fa-pencil',
                'label' => 'edit',
                'params' => array('id')
            ),
            'delete' => array(
                'url_route' => 'admin-kbcategory-delete',
                'link_class' => 'btn btn-danger btn-small pull-right',
                'icon' => 'fa fa-remove',
                'label' => 'delete',
                'params' => array('id')
            )
        );
    }

    protected function indexColumns()
    {
        return array(
            array(
                'field' => 'name'
            ),
            array(
                'action' => 'edit',
                'label' => null
            ),
            array(
                'action' => 'delete',
                'label' => null
            )
        );
    }

    protected function formFields()
    {
        return array(
            'KbCategory.id',
            'KbCategory.name',
            'KbCategory.description',
            'KbCategory.sort',
            'KbCategory.is_active' => array(
                'label' => 'active'
            )
        );
    }



}
