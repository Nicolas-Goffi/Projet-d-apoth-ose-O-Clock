<?php

function opening_enqueue_scripts()
{
    wp_enqueue_style( 'main', get_template_directory_uri() . '/dist/main.css', [], false, 'all');
    wp_enqueue_script( 'main', get_template_directory_uri() . '/dist/main.js', [], false, true);
}
add_action( 'wp_enqueue_scripts', 'opening_enqueue_scripts' );

add_theme_support( 'post-thumbnails' );
add_theme_support('automatic-feed-links');

// On déclare les EMPLACEMENTS de menus de notre thème
// on crée un emplacement "header-menu" (attention, on ne crée pas un MENU header-menu)
// ainsi qu'un emplacement "footer-menu"
function register_my_menus() {
    register_nav_menus(
        [
            'organiser-menu' => __( 'Organiser Menu' ),
            'band-menu' => __( 'Band Menu' ),
        ]
    );
}

// fonctionne un peu comme un eventListener javascript
// on demande à WP de déclencher l'appel à register_my_menus()
// au moment du "init"
// 'init' => 
add_action( 'init', 'register_my_menus' );

function filter_band_query( $query ) {
    
    if ($query->is_main_query() && is_post_type_archive('band')) {

        $selectedDepartment = isset($_GET['department']) ? $_GET['department'] : null;
        $selectedStyle = isset($_GET['music-style']) ? $_GET['music-style'] : null;
        $filters = [];
        if ($selectedDepartment) {
            // variable + crochet = rajoute un element dans le tableau filters
            $filters[] = [
                'taxonomy' => 'location',
                'field' => 'slug',
                'terms' => $selectedDepartment
            ];
        } 
        if ($selectedStyle) {
            // variable + crochet = rajoute un element dans le tableau filters
            $filters[] = [
                'taxonomy' => 'style',
                'field' => 'slug',
                'terms' => $selectedStyle
            ];
        } 
    
        $query->set( 'tax_query', $filters );
    }
}
add_action( 'pre_get_posts', 'filter_band_query' );

function filter_event_query( $query ) {
    
    if ($query->is_main_query() && is_post_type_archive('event')) {

        $selectedDepartment = isset($_GET['department']) ? $_GET['department'] : null;
        $selectedStyle = isset($_GET['music-style']) ? $_GET['music-style'] : null;
       
        $filters = [];
        if ($selectedDepartment) {
            // variable + crochet = rajoute un element dans le tableau filters
            $filters[] = [
                'taxonomy' => 'location',
                'field' => 'slug',
                'terms' => $selectedDepartment
            ];
        } 
        if ($selectedStyle) {
            // variable + crochet = rajoute un element dans le tableau filters
            $filters[] = [
                'taxonomy' => 'style',
                'field' => 'slug',
                'terms' => $selectedStyle
            ];
        } 

        $query->set( 'tax_query', $filters );
    }
}

add_action( 'pre_get_posts', 'filter_event_query' );

function insert_event() {
    global $wpdb;

    if (isset($_POST['event-submit'])) {
        $data = array(
            'post_title' => $_POST['titre'],
            'post_content' => $_POST['annonce'],
            'department' => $_POST['concert-lieu'],
            'music_style' => $_POST['music-style'],
            'post_type' => 'event',
            'post_status' => 'publish'
        );

        $new_post_id = wp_insert_post($data);

        $location = 'location';
        $location_taxonomy = get_term_by('slug', $data['department'],  $location);
        $locationID = $location_taxonomy->term_id;
       
        wp_set_object_terms( $new_post_id, $locationID, $location );

        $style = 'style';
        $style_taxonomy = get_term_by('slug', $data['music_style'], $style);
        wp_set_object_terms( $new_post_id, $style_taxonomy->term_id, $style );

    }
    
    if (isset($_POST['event-submit'])) {
        $data = array(
            'date' => $_POST['concert-date'],
            'organiser_id' => $new_post_id
        );

        $table_name = 'opening_orga-event_date';

        $result = $wpdb->insert($table_name, $data, $format=null);

    }

}
add_action( 'init', 'insert_event');

function custom_login_redirect( $redirect_to, $request, $user ) {
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
    if ( in_array( 'administrator', $user->roles ) || in_array( 'editor', $user->roles ) || in_array( 'author', $user->roles ) ) {
    $redirect_to = admin_url('/');
    } else if ( in_array( 'band', $user->roles ) || in_array( 'organiser', $user->roles ) ) {
    $redirect_to = home_url( '/' );
    } else {
    $redirect_to = home_url('/');
    }
    }
    return $redirect_to;
    }
add_filter( 'login_redirect', 'custom_login_redirect', 10, 3 );


