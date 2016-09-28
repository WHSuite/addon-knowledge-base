<?php if (isset($kb_categories) && ! empty($kb_categories)): ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo $lang->get('kbcategory_management'); ?>
        </div>
        <div class="panel-content nopadding">
            <ul class="nav nav-pills nav-stacked">

                <?php foreach ($kb_categories as $kb_category): ?>
                    <?php
                        $url = $router->generate('client-knowledgebase-category', array(
                            'slug' => $kb_category->slug
                        ));

                        $activeClass = '';
                        if (isset($Category) && $Category->id == $kb_category->id) {

                            $activeClass = ' class="active"';
                        }
                    ?>
                    <li<?php echo $activeClass; ?>>
                        <a href="<?php echo $url; ?>">
                            <?php echo $kb_category->name; ?>
                        </a>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>
    </div>

<?php endif; ?>