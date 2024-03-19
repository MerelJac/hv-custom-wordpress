<?php
get_header();

while (have_posts()) : the_post();
?>
<article <?php post_class(); ?>>
    <div class="post-content">
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
            <div class="book-details">
                <?php if ($book_image) : ?>
                    <img class="book-image" style="width: 100%;" src="<?php the_field($book_image); ?>" alt="book-image" />
                <?php endif; ?>
                <div class="book-text title"><?php the_field($book_title); ?></div>
                <div class="book-text author"><?php the_field($book_author); ?></div>
                <?php if ($book_illustrator) : ?>
                    <div class="book-text illustrator"><?php the_field($book_illustrator); ?></div>
                <?php endif; ?>
                <p><?php echo the_field($book_details); ?></p>
                <?php if ($library_link) : ?>
                    <a href="<?php the_field($library_link); ?>"><button class="book-button-library">Check Availability</button></a>
                <?php endif; ?>
            </div>
        <?php } else {
            // Fallback to default content
            the_content();
        }
        ?>
    </div>
</article>
<?php endwhile;

get_footer();
?>
