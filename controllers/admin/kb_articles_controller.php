<?php

class KbArticlesController extends \AdminController
{
    protected function indexToolbar()
    {
        return array(
            array(
                'url_route' => 'admin-kbarticle',
                'link_class' => '',
                'icon' => 'fa fa-list-ul',
                'label' => 'kbarticle_management'
            ),
            array(
                'url_route' => 'admin-kbarticle-add',
                'link_class' => '',
                'icon' => 'fa fa-plus',
                'label' => 'kbarticle_add'
            )
        );
    }

    protected function indexActions()
    {
        return array(
            'edit' => array(
                'url_route' => 'admin-kbarticle-edit',
                'link_class' => 'btn btn-primary btn-small pull-right',
                'icon' => 'fa fa-pencil',
                'label' => 'edit',
                'params' => array('id')
            ),
            'delete' => array(
                'url_route' => 'admin-kbarticle-delete',
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
                'field' => 'title'
            ),
            array(
                'field' => 'KbCategory.name',
                'label' => 'kbcategory'
            ),
            array(
                'field' => 'rating_up'
            ),
            array(
                'field' => 'rating_down'
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
            'KbArticle.id',
            'KbArticle.title',
            'KbArticle.body' => array(
                'type' => 'wysiwyg'
            ),
            'KbArticle.kb_category_id' => array(
                'label' => 'kbcategory'
            ),
            'KbArticle.sort',
            'KbArticle.is_active' => array(
                'label' => 'active'
            )
        );
    }

    protected function getExtraData($model)
    {
        $this->view->set(
            'kb_category_id',
            KbCategory::formattedList(
                'id',
                'name',
                array(
                    array(
                        'column' => 'is_active',
                        'operator' => '=',
                        'value' => 1
                    )
                ),
                'sort',
                'asc'
            )
        );
    }

    public function form($id = null)
    {
        $this->render_view = 'knowledge_base::admin/articles/form.php';

        return parent::form($id);
    }

    protected function afterSave(&$main_model)
    {
        parent::afterSave($main_model);

        if (\App::checkInstalledAddon('uploader')) {

            // process any uploads
            \Addon\Uploader\Libraries\Process::uploads('KbArticle', $main_model);
        }
    }


}
