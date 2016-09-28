<?php
    $url = $router->generate(
        'client-knowledgebase-article',
        array(
            'slug' => $Article->slug
        )
    );
?>

<a class="list-group-item" href="<?php echo $url; ?>">
    <span class="text-muted pull-right">
        <?php
            $date = \Carbon\Carbon::parse(
                $Article->updated_at,
                $timezone
            );
            echo $date->format($date_format);
        ?>
    </span>
    <h4 class="list-group-item-heading"><?php echo $Article->title; ?></h4>
    <p class="list-group-item-text">
        <?php $stripped_body = strip_tags(html_entity_decode($Article->body)); ?>
        <?php echo \Illuminate\Support\Str::limit($stripped_body, 100); ?>
    </p>
</a>