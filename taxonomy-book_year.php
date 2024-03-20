<?php
get_header();

$term = get_queried_object();
?>

<div class="page-title" style="color: white !important; padding-top: 70px !important; padding-bottom: 70px !important; background-color: #197eab !important;">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Happy Valley Library</h1>
            </div>
        </div>
    </div>
</div>

<div class="books-container-padding" style="display: flex; flex-direction: row;">


        <div class="col">
            <h1 class="genre-text" style="border-bottom: 1px solid #197AA5;">Genres</h1>
            <div class="tag-cloud-column" style="display: flex;
        flex-direction: column; padding-top: 10px !important;">
                <?php
                // Display Genres Tag Cloud
                wp_tag_cloud(array('taxonomy' => 'book-tags'));
                ?>
            </div>
            <button class="print-button" style="position: absolute; bottom: 0;" onclick="PrintDiv()">Print Page</button>
        </div>
<div id="container-years" class="container">
        <div class="col">
            <div class="tag-cloud-row" style="display: flex;
        flex-direction: row; gap: 10px;">
                <?php
                // Display Year Tag Cloud
                wp_tag_cloud(array(
                    'taxonomy' => 'book_year',
                    'order' => 'DESC',
                ));
                ?>
            </div>
            
        </div>

    <div class="row">
        <div id="print-section" class="col masonry-grid">
            <?php
            // Display Masonry Grid
            $args = array(
                'post_type'      => 'all_books', // Replace with your actual post type
                'posts_per_page' => 100,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'book_year', // Replace with your actual taxonomy
                        'field'    => 'slug',
                        'terms'    => $term->slug,
                    ),
                ),
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    ?>
                    <article <?php post_class(); ?>>
                        <div class="post-content">
                            <?php 
                            // Check if ACF fields exist
                            if (function_exists('get_field')) {
                                // Check if book image field exists
                                $book_image = get_field('book_image');
                                if ($book_image) { ?>
                                    <div class="book-container">
                                        <img class="book-image" style="width: 100%;" src="<?php the_field('book_image'); ?>" alt="book-image" />
                                        <div class="book-middle">
                                            <div class="book-text title"><?php the_field('book_title'); ?></div>
                                            <div class="book-text author"><?php the_field('book_author'); ?></div>
                                            <?php 
                                            // Check if illustrator field exists before displaying
                                            $illustrator = get_field('book_illustrator');
                                            if ($illustrator) { ?>
                                                <div class="book-text illustrator"><?php the_field('book_illustrator'); ?></div>
                                            <?php } ?>
                                            <a href="<?php the_permalink(); ?>"><button class="book-button">Read More</button></a>
                                        </div>
                                    </div>
                                    <div class="book-details">
                                        <div>Title: <span><?php the_field('book_title'); ?></span></div>
                                        <div>Author: <span><?php the_field('book_author'); ?></span></div>
                                        <p><?php the_field('book_details'); ?></p>
                                        <a href="<?php the_field('library_link'); ?>"><button class="book-button-library">Check Availability</button></a>
                                    </div>
                                <?php } else {
                                    // Render default content if book image field doesn't exist
                                    the_content();
                                }
                            } else {
                                // Render default content if ACF plugin is not active
                                the_content();
                            }
                            ?>
                        </div>
                    </article>
                    <?php
                endwhile;
            else :
                echo 'No posts found.';
            endif;
            ?>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    function PrintDiv() {
        const content = document.getElementById('print-section').innerHTML;
        const printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Print</title><style>img, .book-button, .book-details { display: none; }</style></head><body>');
        printWindow.document.write(content);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>


<?php
get_footer();
?>
