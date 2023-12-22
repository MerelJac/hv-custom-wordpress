<?php
add_filter('default_content', 'my_editor_content', 10, 2);

function my_editor_content($content, $post) {
    switch ($post->post_type) {
        case 'all_books':
            $content = '<div class="book-container"><img class="book-image" style="width: 100%;" src="LINK-OF-IMAGE" alt="book-image" />
            <div class="book-middle">
            <div class="book-text title">BOOK TITLE</div>
            <div class="book-text author">BOOK AUTHOR</div>
            <div class="book-text illustrator">BOOK ILLUSTRATOR (optional)</div>
            <a href="PERMALINK UNDER TITLE (whole link)"><button class="book-button">Read More</button></a>
            </div>
            </div>
            
            <div class="book-details">
            <div>Title: <span>BOOK TITLE</span></div>
            <div>Author: <span>BOOK AUTHOR</span></div>
            <p>DETAILS OF BOOK</p>
            <a href="LINK TO LIBRARY"><button class="book-button-library">Check Availability</button></a>
            </div>';
            break;
        default:
            $content = '';
            break;
    }

    return $content;
}

