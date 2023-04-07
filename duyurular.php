<?php
/*
Plugin Name: Duyurular
Plugin URI: 
Description: Duyuruları görüntülemek için özel bir post türü ve shortcode oluşturur.
Version: 1.0
Author: Gürkan Şahinbaş
Author URI: https://gurkansahinbas.com.tr/
License: GPLv2 or later
*/

function register_custom_post_type() {
    $args = array(
        'public' => true,
        'label' => 'Duyurular',
        'menu_icon' => 'dashicons-megaphone',
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'has_archive' => true,
    );
    register_post_type( 'duyurular', $args );
}
add_action( 'init', 'register_custom_post_type' );




function custom_duyurular_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'number' => -1,
    ), $atts );
    $args = array(
        'post_type' => 'duyurular',
        'posts_per_page' => $atts['number'],
    );
    $query = new WP_Query( $args );
    $output = '<ul class="custom-duyurular">';
    while ( $query->have_posts() ) {
        $query->the_post();
        $output .= '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
    }
    wp_reset_postdata();
    $output .= '</ul>';
    return $output;
}
add_shortcode( 'duyurular', 'custom_duyurular_shortcode' );

?>
