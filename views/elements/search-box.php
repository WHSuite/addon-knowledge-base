<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php
                    echo $forms->open(
                        array(
                            'class' => 'form-inline',
                            'action' => $router->generate(
                                'client-knowledgebase-search',
                                array(
                                    'search' => (isset($search) ? $search : null)
                                )
                            )
                        )
                    );

                    $button = $forms->submit(
                        'search',
                        $lang->get('search'),
                        array(
                            'class' => 'btn btn-primary',
                            'wrap' => 'span',
                            'wrap_class' => 'input-group-btn'
                        )
                    );

                    echo $forms->input(
                        'data.Search.search_term',
                        false,
                        array(
                            'wrap_class' => 'input-group',
                            'placeholder' => $lang->get('search_articles'),
                            'after' => $button
                        )
                    );

                    echo $forms->close();
                ?>
            </div>
        </div>
    </div>
</div>