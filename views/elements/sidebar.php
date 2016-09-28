<div class="col-md-3">

    <?php echo $view->fetch('knowledge_base::elements/categories-sidebar.php'); ?>

    <?php if (\App::checkInstalledAddon('support_desk')): ?>

        <div class="alert alert-info text-center">
            <?php echo $lang->get('cant_find_answer'); ?>

            <?php $create_ticket = $router->generate('client-supportticket-add'); ?>

            <a href="<?php echo $create_ticket; ?>" class="btn btn-primary btn-lg">
                <?php echo $lang->get('supportticket_add'); ?>
            </a>
        </div>

    <?php endif; ?>

</div>