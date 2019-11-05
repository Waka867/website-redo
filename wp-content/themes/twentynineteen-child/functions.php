<?php

//require_once(ABSPATH . 'wp-admin/includes/file.php');


add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
 
    $parent_style = 'parent-style'; // This is 'twentynineteen-style' for the Twenty Nineteen theme.
 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );

    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );

 
    // This should be changed so that the path to the github-calendar js file allows the file to stay in node_modules and not have to be copied over
    //wp_enqueue_script( 'github-calendar', get_site_url() . '/node_modules/github-calendar/dist/github-calendar.min.js', '', '', true);

    wp_enqueue_script( 'github-calendar', get_stylesheet_directory_uri() . '/github-calendar.min.js', '', '', true);
}

?>
