<?php
get_header();

while (have_posts()) {
    the_post(); ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>)"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php the_title() ?></h1>
            <div class="page-banner__intro">
                <p>Replace me later! DON'T FORGET!</p>
            </div>
        </div>
    </div>

    <div class="container container--narrow page-section">

        <?php
            $parentPageId = wp_get_post_parent_id();
            $parentPageTitle = get_the_title($parentPageId);
            $parentPageLink = get_permalink($parentPageId);
            $isChildPage = $parentPageId > 0;
            $pageId = get_the_ID();

            if ($isChildPage) { 
        ?>
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                    <a 
                        class="metabox__blog-home-link" 
                        href="<?php echo $parentPageLink ?>">
                        <i class="fa fa-home" aria-hidden="true"></i> 
                        Back to <?php echo $parentPageTitle ?>
                    </a>
                    <span class="metabox__main"><?php the_title() ?></span>
                </p>
            </div>
        <?php } ?>

        <?php 
            $childPagesArray = get_pages([
                'child_of' => $pageId
            ]);


            if ($isChildPage || $childPagesArray) { 
        ?>
            <div class="page-links">
                <h2 class="page-links__title"><a href="<?php echo $parentPageLink ?>"><?php echo $parentPageTitle ?></a></h2>
                <ul class="min-list">
                    <?php 
                        wp_list_pages([
                            'title_li' => null,
                            'child_of' => $isChildPage ? $parentPageId : $pageId,
                            'sort_column' => 'menu_order'
                        ]);
                    ?>
                </ul>
            </div>
        <?php } ?>

        <div class="generic-content">
            <?php the_content() ?>
        </div>
    </div>

<?php }

get_footer();
?>