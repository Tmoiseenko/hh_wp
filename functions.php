<?php

// Enqueue scripts and styles.
function hh_scripts()
{
    wp_enqueue_style('hh-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    wp_enqueue_style('hh-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css');
    wp_enqueue_style('hh-style-theme', get_stylesheet_uri());

    wp_enqueue_script('hh-jquery', 'https://code.jquery.com/jquery-3.2.1.min.js', [], true);
    wp_enqueue_script('hh-popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', [], true);
    wp_enqueue_script('hh-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', [], true);
    wp_enqueue_script('hh-js', get_stylesheet_directory_uri() . '/js/index.js', [], true);
}
add_action('wp_enqueue_scripts', 'hh_scripts');

// Register Custom Post Type
function hh_post_type()
{
    $labels_product = array(
        'name' => _x('HH коментарии', 'Post Type General Name', 'text_domain'),
        'singular_name' => _x('HH коментарии', 'Post Type Singular Name', 'text_domain'),
        'menu_name' => __('HH коментарий', 'text_domain'),
        'name_admin_bar' => __('HH коментарии', 'text_domain'),
        'archives' => __('Item Archives', 'text_domain'),
        'attributes' => __('Item Attributes', 'text_domain'),
        'parent_item_colon' => __('Родительский комментарий', 'text_domain'),
        'all_items' => __('Все HH коментарии', 'text_domain'),
        'add_new_item' => __('Добавить новый HH коментарии', 'text_domain'),
        'add_new' => __('Новый HH коментарии', 'text_domain'),
        'new_item' => __('HH коментарии', 'text_domain'),
        'edit_item' => __('Редактировать HH коментарии', 'text_domain'),
        'update_item' => __('Обновить HH коментарии', 'text_domain'),
        'view_item' => __('Посмотреть HH коментарии', 'text_domain'),
        'view_items' => __('Просмотреть HH коментарии', 'text_domain'),
        'search_items' => __('Найти HH коментарии', 'text_domain'),
        'not_found' => __('HH коментарии не найден', 'text_domain'),
        'not_found_in_trash' => __('No products found in Trash', 'text_domain'),
        'featured_image' => __('Рекомендуемые изображения', 'text_domain'),
        'set_featured_image' => __('Установить рекомендуемое изображение', 'text_domain'),
        'remove_featured_image' => __('Удалить рекомендуемое изображение', 'text_domain'),
        'use_featured_image' => __('Использовать как изображение', 'text_domain'),
        'insert_into_item' => __('Вставить в элемент', 'text_domain'),
        'uploaded_to_this_item' => __('Загружено для этого HH коментарии', 'text_domain'),
        'items_list' => __('Список HH коментарии', 'text_domain'),
        'items_list_navigation' => __('Навигация по списку HH коментарии', 'text_domain'),
        'filter_items_list' => __('Фильтр списка HH коментарии', 'text_domain'),
    );
    $args_product = array(
        'label' => __('HH коментарии', 'text_domain'),
        'description' => __('HH комментарии', 'text_domain'),
        'labels' => $labels_product,
        'supports' => array('title', 'editor', 'custom-fields'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 30,
        'menu_icon' => 'dashicons-screenoptions',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type('hh_comments', $args_product);
}
add_action('init', 'hh_post_type', 0);

add_action( 'wp_ajax_nopriv_add_hh_comment', 'add_hh_comment' );
add_action( 'wp_ajax_add_hh_comment', 'add_hh_comment' );
function add_hh_comment() {
    $my_post_id = wp_insert_post( [
        'post_type' => 'hh_comments',
        'post_title'    => $_POST['name'],
        'post_content'  => $_POST['comment'],
        'post_status'   => 'publish' // опубликованный пост
    ]);

    update_post_meta($my_post_id, 'email', $_POST['email']);

    $hh_posts = new WP_Query([
        'post_type' => 'hh_comments',
        'order' => 'ASC',
    ]);

    if ( $hh_posts->have_posts() ) {
        $i = 1;
        // Load posts loop.
        while ($hh_posts->have_posts()) {
            $odd = $i % 2 == 0 ? 'odd' : '';
            $hh_posts->the_post();
            ?>
            <div class="card text-center mb-5 <?= $odd ?>">
                <h5 class="card-title"><?php the_title(); ?></h5>
                <div class="card-body">
                    <h6 class="card-subtitle mb-5 mt-5">
                        <?= get_post_meta(get_the_ID(), 'email', true) ?>
                    </h6>
                    <?php the_content(); ?>
                </div>
            </div>
            <?php
            $i++;
        }
    }

    wp_die();
}

add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );
function myajax_data(){
    wp_localize_script( 'hh-jquery', 'myajax',
        array(
            'url' => admin_url('admin-ajax.php')
        )
    );

}
