<?php echo $view->fetch('elements/header.php'); ?>

<?php echo $view->fetch('knowledge_base::elements/search-box.php'); ?>

<div class="row">
    <div class="col-md-9">
        <h3 class="nomargin"><?php echo $lang->get('search_results'); ?></h3>
        <div class="list-group">

            <?php if (isset($data) && ! empty($data)): ?>

                <?php
                    $timezone = \App::get('configs')->get('settings.localization.timezone');
                    $date_format = \App::get('configs')->get('settings.localization.short_date_format');
                ?>

                <?php foreach ($data as $Article): ?>

                    <?php
                        echo $view->fetch(
                            'knowledge_base::elements/listing-item.php',
                            array(
                                'Article' => $Article,
                                'timezone' => $timezone,
                                'date_format' => $date_format
                            )
                        );
                    ?>

                <?php endforeach; ?>

            <?php else: ?>

                <p class="list-group-item-text">
                    <?php echo $lang->get('no_results_found'); ?>
                </p>

            <?php endif; ?>

        </div>
        <div class="text-center">

            <?php echo $pagination; ?>

        </div>
    </div>

    <?php echo $view->fetch('knowledge_base::elements/sidebar.php'); ?>

</div>

<?php echo $view->fetch('elements/footer.php'); ?>