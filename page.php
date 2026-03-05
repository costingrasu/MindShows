<?php get_header(); ?>

<div class="legal-page-wrapper">
    <div class="legal-page-container">
        <?php while ( have_posts() ) : the_post(); ?>
            <h1 class="legal-title"><?php the_title(); ?></h1>
            
            <div class="legal-content-editor">
                <?php the_content(); ?>
            </div>
            
        <?php endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>