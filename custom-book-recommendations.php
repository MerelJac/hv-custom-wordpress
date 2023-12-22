<?php
/*
Template Name: Book Recommendations Page
*/

get_header();

$args = array(
    'post_type' => 'all_books', // Replace with your actual post type
    'tax_query' => array(
        array(
            'taxonomy' => 'book-tags', // Replace with your actual taxonomy
            'field'    => 'slug',
            'terms'    => 'desired-tag-slug', // Replace with the slug of the desired tag
        ),
    ),
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
        ?>
        <article <?php post_class(); ?>>
            <h2><?php the_title(); ?></h2>
            <div class="post-content">
                <?php the_content(); ?>
            </div>
        </article>
        <?php
    endwhile;

    // Additional content or Visual Composer shortcodes can be added here.

else :
    echo 'No posts found.';
endif;

get_footer();
?>