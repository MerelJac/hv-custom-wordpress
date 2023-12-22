<?php

add_action( 'wp_enqueue_scripts', 'books_custom_style' );

function books_custom_style() {
    $url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

    if ( false !== strpos( $url, 'all_books' ) ) {
        wp_enqueue_style( 'allbooks', get_stylesheet_directory_uri() . '/allbooks.css' );
    } else {
        wp_enqueue_style( 'books', get_stylesheet_directory_uri() . '/books.css' );
    }
}


