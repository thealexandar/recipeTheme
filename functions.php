<?php

// Load styles
function load_css(){
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all');
    wp_enqueue_style('bootstrap');

    wp_register_style('main', get_template_directory_uri() . '/css/main.css', array(), false, 'all');
    wp_enqueue_style('main');
}
add_action('wp_enqueue_scripts', 'load_css');

// Load scripts
function load_js(){
    wp_enqueue_script('jquery');
    wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery', false, true);
    wp_enqueue_script('bootstrap');
    wp_register_script('custom', get_template_directory_uri() . '/js/custom.js', 'jquery', false, true);
    wp_enqueue_script('custom');

}
add_action('wp_enqueue_scripts', 'load_js');

// Theme options
add_theme_support('menus');
add_theme_support( 'post-thumbnails' );


// Menus
register_nav_menus(
    array(
        'top-menu' => 'Top Menu Location',
        'mobile-menu' => 'Mobile Menu Location'

    )
);

// Add custom post type
function recipe_post_type(){
    $args = array(
        'labels' => array(
            'name' => 'Recipes',
            'singular_name' => 'Recipe'
        ),
        'hierarchical' => true,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-carrot',
        'taxonomies' => array('category'),
        'supports' => array('title', 'editor', 'thumbnail', 'revisions')
    );
    register_post_type('recipes', $args);
}
add_action('init', 'recipe_post_type');


// Custom image sizes
add_image_size('blog-large', 800, 400, true);
add_image_size('blog-small', 300, 200, true);



// Add new recipe
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == "front_post") {

    $title     = $_POST['title'];
    $content   = $_POST['content'];
    $post_type = 'recipes';

    $new_post = array(
    'post_title'    => $title,
    'post_content'  => $content,
    'post_status'   => 'pending',
    'post_type'     => $post_type
    );

     $pid=wp_insert_post($new_post);

    if(!function_exists('wp_generate_attachment_metadata')){
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
        require_once(ABSPATH . "wp-admin" . '/includes/media.php');
    }
        if($_FILES) {
            foreach ($_FILES as $file => $array){
                if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                return "upload error : " . $_FILES[$file]['error'];
                }
                $attach_id = media_handle_upload($file, $pid);
            }
        }
        if($attach_id > 0){
            update_post_meta($pid, '_thumbnail_id', $attach_id);
        }

    //we now use $pid (post id) to help add out post meta data
    add_post_meta($pid, 'cust_key', $custom_field);


}


// Add recipes to homepage
// add_action("pre_get_posts", "custom_front_page");
// function custom_front_page($wp_query){
//     //Ensure this filter isn't applied to the admin area
//     if(is_admin()) {
//         return;
//     }

//     if($wp_query->get('page_id') == get_option('page_on_front')):

//         $wp_query->set('post_type', 'recipes');
//         $wp_query->set('page_id', ''); //Empty

//         //Set properties that describe the page to reflect that
//         //we aren't really displaying a static page
//         $wp_query->is_page = 0;
//         $wp_query->is_singular = 0;
//         $wp_query->is_post_type_archive = 1;
//         $wp_query->is_archive = 1;

//     endif;

// }
