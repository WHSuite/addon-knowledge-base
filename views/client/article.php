<?php echo $view->fetch('elements/header.php'); ?>

<?php echo $assets->style('knowledge_base::articles.css'); ?>

<?php echo $view->fetch('knowledge_base::elements/search-box.php'); ?>

<div class="row">
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $Article->title; ?>
            </div>
            <div class="panel-body">
                <?php echo html_entity_decode($Article->body); ?>

                <?php
                    if (\App::checkInstalledAddon('uploader')):

                        // load the uploader plugin form
                        echo $this->fetch(
                            'uploader::elements/listing.php',
                            array(
                                'model_name' => 'KbArticle',
                                'model_id' => $Article->id
                            )
                        );

                    endif;
                ?>

                <div class="row">
                    <br>
                    <div class="col-md-3 text-muted small find-useful">
                        <b><?php echo $lang->get('find_useful'); ?></b>
                    </div>

                    <div class="col-md-2 text-muted small">
                        <?php
                            echo $forms->open(
                                array(
                                    'action' => $router->generate('client-knowledgebase-rating'),
                                    'class' => 'form-inline'
                                )
                            );

                                echo $forms->hidden('data.Rating.article_id', array(
                                    'value' => $Article->id
                                ));

                                echo $forms->submit(
                                    'data.Rating.rating_up',
                                    '<i class="fa fa-thumbs-up"></i>',
                                    array(
                                        'class' => 'btn rating rating--up',
                                        'type' => 'submit'
                                    )
                                );

                                echo $forms->submit(
                                    'data.Rating.rating_down',
                                    '<i class="fa fa-thumbs-down"></i>',
                                    array(
                                        'class' => 'btn rating rating--down',
                                        'type' => 'submit'
                                    )
                                );

                            echo $forms->close();
                        ?>
                    </div>
                    <div class="col-md-12 text-muted small rating-display">
                        <b>
                            <?php
                                $total = $Article->rating_up + $Article->rating_down;

                                $helpful = $lang->get('rating_display');

                                $helpful = str_replace('{{rating-up}}', $Article->rating_up, $helpful);
                                $helpful = str_replace('{{rating-total}}', $total, $helpful);

                                echo $helpful;
                            ?>
                        </b>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 text-muted small">
                        <b><?php echo $lang->get('kbcategory'); ?>:</b>

                        <?php
                            $category_url = $router->generate(
                                'client-knowledgebase-category',
                                array(
                                    'slug' => $Category->slug
                                )
                            );
                        ?>
                        <a href="<?php echo $category_url; ?>">
                            <?php echo $Category->name . ' ' . $lang->get('kbarticles'); ?>
                        </a>
                    </div>
                    <div class="col-md-6 text-right text-muted small">
                        <b><?php echo $lang->get('updated_at'); ?>:</b>
                        <?php
                            $date = \Carbon\Carbon::parse(
                                $Article->updated_at,
                                \App::get('configs')->get('settings.localization.timezone')
                            );
                            echo $date->format(\App::get('configs')->get('settings.localization.short_datetime_format'));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $view->fetch('knowledge_base::elements/sidebar.php'); ?>

</div>

<?php echo $view->fetch('elements/footer.php'); ?>