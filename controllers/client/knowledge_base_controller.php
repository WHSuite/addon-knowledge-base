<?php

use \Whsuite\Inputs\Post as PostInput;

class KnowledgeBaseController extends ClientController
{
    public function onLoad()
    {
        parent::onLoad();

        $this->view->set(
            'kb_categories',
            KbCategory::where('is_active', '=', 1)
                ->orderBy('sort', 'asc')
                ->get()
        );
    }

    /**
     * main knowledge base page
     *
     */
    public function index($page = 1, $per_page = null)
    {
        $page_title = $this->lang->get('knowledgebase');
        $this->view->set('title', $page_title);

        // build the breadcrumb
        $this->indexBreadcrumb('KbArticle', $page_title);

        $KbArticles = KbArticle::where('is_active', '=', 1)
            ->orderBy('sort', 'asc')
            ->limit(
                App::get('configs')->get('settings.general.results_per_page')
            )
            ->get();

        $this->view->set('latest_articles', $KbArticles);
        $this->view->display('knowledge_base::client/listing.php');
    }

    /**
     * category page, lists all articles in the given category
     */
    public function category($slug, $page = 1)
    {
        // Load the category details
        $Category = KbCategory::where('slug', '=', $slug)
            ->where('is_active', '=', 1)
            ->first();

        if (! $Category || empty($Category->id)) {

            // nothing fits, redirect to error
            App::get('session')->setFlash('error', $this->lang->get('item_not_found'));
            return header("Location: ".App::get('router')->generate('client-knowledgebase'));
        }

        $page_title = $Category->name;

        // Load the breadcrumbs
        $breadcrumb = App::get('breadcrumbs');
        $breadcrumb->add($this->lang->get('dashboard'), 'client-home');
        $breadcrumb->add($this->lang->get('knowledgebase'), 'client-knowledgebase');
        $breadcrumb->add($page_title);
        $breadcrumb->build();

        $per_page = App::get('configs')->get('settings.general.results_per_page');

        // Load the paginated articles
        $data = KbArticle::paginate(
            $per_page,
            $page,
            array(
                array(
                    'column' => 'is_active',
                    'operator' => '=',
                    'value' => 1
                )
            ),
            'sort',
            'asc',
            'client-knowledgebase-category-paging'
        );

        // set the data to the template
        $this->view->set(
            array(
                'Category' => $Category,
                'data' => $data,
                'title' => $page_title
            )
        );

        $this->view->display('knowledge_base::client/category.php');
    }

    /**
     * display the article
     */
    public function article($slug)
    {
        // Load the category details
        $Article = KbArticle::where('slug', '=', $slug)
            ->where('is_active', '=', 1)
            ->with('KbCategory')
            ->first();

        if (! $Article || empty($Article->id)) {

            // nothing fits, redirect to error
            App::get('session')->setFlash('error', $this->lang->get('item_not_found'));
            return header("Location: ".App::get('router')->generate('client-knowledgebase'));
        }

        $page_title = $Article->title;

        // Load the breadcrumbs
        $breadcrumb = App::get('breadcrumbs');
        $breadcrumb->add($this->lang->get('dashboard'), 'client-home');
        $breadcrumb->add($this->lang->get('knowledgebase'), 'client-knowledgebase');
        $breadcrumb->add(
            $Article->KbCategory->name,
            'client-knowledgebase-category',
            array(
                'slug' => $Article->KbCategory->slug
            )
        );
        $breadcrumb->add($page_title);
        $breadcrumb->build();

        $this->view->set(
            array(
                'Article' => $Article,
                'Category' => $Article->KbCategory,
                'title' => $page_title
            )
        );

        $this->view->display('knowledge_base::client/article.php');
    }

    /**
     * handle the knowledge base search
     */
    public function search($search_get = '', $page = 1)
    {
        $search_post = PostInput::get('data.Search.search_term');

        if (isset($search_post) && ! empty($search_post)) {

            $search = $search_post;
        } elseif (isset($search_get) && ! empty($search_get)) {

            $search = $search_get;
            PostInput::set('data.Search.search_term', $search);
        } else {

            // nothing fits, redirect to error
            App::get('session')->setFlash('error', $this->lang->get('item_not_found'));
            return header("Location: ".App::get('router')->generate('client-knowledgebase'));
        }

        $page_title = $this->lang->get('search_results');

        // Load the breadcrumbs
        $breadcrumb = App::get('breadcrumbs');
        $breadcrumb->add($this->lang->get('dashboard'), 'client-home');
        $breadcrumb->add($this->lang->get('knowledgebase'), 'client-knowledgebase');
        $breadcrumb->add($page_title);
        $breadcrumb->build();

        $per_page = App::get('configs')->get('settings.general.results_per_page');

         // Load the paginated articles
        $data = KbArticle::paginate(
            $per_page,
            $page,
            array(
                array(
                    'column' => 'is_active',
                    'operator' => '=',
                    'value' => 1
                ),
                array(
                    'column' => 'title',
                    'operator' => 'LIKE',
                    'value' => '%' . $search . '%'
                ),
                array(
                    'type' => 'or',
                    'column' => 'body',
                    'operator' => 'LIKE',
                    'value' => '%' . $search . '%'
                )
            ),
            'sort',
            'asc',
            'client-knowledgebase-search-paging',
            array(
                'search_get' => $search
            )
        );

        $this->view->set(
            array(
                'title' => $page_title,
                'data' => $data
            )
        );

        $this->view->display('knowledge_base::client/search.php');
    }


    /**
     * handle the rating of an article
     */
    public function rating()
    {
        $data = PostInput::get('data');

        if (
            ! empty($data) &&
            isset($data['Rating']['article_id']) &&
            ! empty($data['Rating']['article_id']) &&
            (
                isset($data['Rating']['rating_up']) ||
                isset($data['Rating']['rating_down'])
            )
        ) {
            $Article = KbArticle::find($data['Rating']['article_id']);

            if (isset($data['Rating']['rating_up'])) {

                $Article->increment('rating_up');

            } elseif (isset($data['Rating']['rating_down'])) {

                $Article->increment('rating_down');
            }

            $redirect = App::get('router')->generate(
                'client-knowledgebase-article',
                array(
                    'slug' => $Article->slug
                )
            );
        }


        if (! isset($redirect)) {

            $redirect = App::get('router')->generate('client-knowledgebase');
        }

        return header("Location: " . $redirect);
    }

}
