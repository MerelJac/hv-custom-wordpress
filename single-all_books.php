<?php
get_header();

$post_id = get_the_ID(); // Get the ID of the current post
$args = array(
    'post_type'      => 'all_books', // Replace with your actual post type
    'p'              => $post_id, // Specify the post ID
);

$query = new WP_Query($args);

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
?>
        <article <?php post_class(); ?>>
            <div class="post-content">
                <style>
                    .book-details { 
                        display: flex; 
                        flex-direction: column; 
                    } 

                    .book-text, .detail-text {
                        color: #197AA5;
                        font-weight: normal;
                        font-size: 16px;
                        padding: 5px 0px;
                        font-family: 'Boston-Regular';
                    }

                    .content-padding {
                        padding-left: 3rem;
                        padding-right: 3rem;
                        padding-bottom: 3rem;
                    }

                    .book-button { display: none; }

                    .page-header {
                        display: none;
                    }
                    .title {
                        border-bottom: none;
                        text-transform: none;
                    }
                    .book-image {
                        padding-bottom: 10px;
                        padding-top: 20px;
                    }

                    .book-button-padding {
                        padding-bottom: 10px;
                        padding-top: 10px;
                    }
                    .page-title-custom { 
                        width: 100vw;
                    }

                    .info {
                        display: flex;
                        flex-direction: row;
                    }

                    .col-text {
                        padding-left: 2rem;
                    }


    
                    @media only screen and (max-width: 1100px) {
                        .book-image {
                            width: 250px;
                        }
                    }

                    @media only screen and (max-width: 768px) {
                    .info {
                            flex-direction: column;
                        }
                    .col-text {
                        padding-left: 0px;
                    }

                    }
                </style>
                <?php 
                // Check if ACF fields exist
                if (function_exists('get_field')) {
                    // Display book details using ACF fields
                    $book_image = get_field('book_image');
                    $book_title = get_field('book_title');
                    $book_author = get_field('book_author');
                    $book_illustrator = get_field('book_illustrator');
                    $book_details = get_field('book_details');
                    $library_link = get_field('library_link');
                    
                    // Output book details
                ?>
                <div class="page-title-custom" style="color: white !important; padding-top: 70px !important; padding-bottom: 70px !important; background-color: #197eab !important;">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h1><?php echo esc_html($book_title); ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="content-padding">
                    <div class="book-button-padding">
                        <a href="<?php echo site_url('/book_year/2022'); ?>"><button class="book-button-library">Back to Library</button></a>
                    </div>
                    <div class="info">
                        <div>
                            <?php if ($book_image) : ?>
                                <img class="book-image" style="width: 100%;" src="<?php echo esc_url($book_image); ?>" alt="book-image" />
                            <?php endif; ?>
                        </div>
                        <section class="col-text">
                            <div>
                                <div class="book-text author">Author: <?php echo esc_html($book_author); ?></div>
                                <?php if ($book_illustrator) : ?>
                                    <div class="book-text illustrator">Illustrator: <?php echo esc_html($book_illustrator); ?></div>
                                <?php endif; ?>
                                <p class="detail-text"> Details: <?php echo wp_kses_post($book_details); ?></p>
                            </div>
                            <div class="book-details">
                                <?php if ($library_link) : ?>
                                    <a href="<?php echo esc_url($library_link); ?>"><button class="book-button-library">Check Availability</button></a>
                                <?php endif; ?>
                            </div>
                        </section>
                    </div>
                    <?php
                    } else {
                        // Fallback to default content if ACF fields are not available
                        the_content();
                    }
                    ?>
                </section>
            </div>
        </article>
<?php
    }
} else {
    // No posts found
}
wp_reset_postdata(); // Reset post data

while (have_posts()) : the_post();
?>

<?php endwhile;

get_footer();
?>
