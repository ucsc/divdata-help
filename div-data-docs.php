<?php
/*
Plugin Name: Div Data Docs API
Description: Exposes relavent posts via a custom REST API endpoint.
Version: 0.0.1
Author: Sammy Slug
*/

// Register the API route
add_action('rest_api_init', function () {
    register_rest_route('divdata/v1', '/posts', [
        'methods' => 'GET',
        'callback' => 'get_relavent_posts',
    ]);
});


// Fetch and return private posts
function get_relavent_posts($request) {
    $role_param  = sanitize_text_field($request->get_param('role'));
    $route_param = sanitize_text_field($request->get_param('route'));

    $meta_query = [];

    if ($role_param) {
        $meta_query[] = [
            'key'     => 'role',
            'value'   => $role_param,
            'compare' => '='
        ];
    }

    if ($route_param !== null) {
        $meta_query[] = [
            'key'     => 'route',
            'value'   => $route_param,
            'compare' => '='
        ];
    }

    $args = [
        'post_type'   => 'divdata-help-doc',
        'post_status' => 'publish',
        'numberposts' => -1,
        'meta_query'  => $meta_query
    ];

    $posts = get_posts($args);

    $data = array_map(function ($post) use ($role_param, $route_param) {
        return [
            'id'      => $post->ID,
            'title'   => get_the_title($post),
            'content' => apply_filters('the_content', $post->post_content),
            'role'    => $role_param,
            'route'   => $route_param,
        ];
    }, $posts);

    return rest_ensure_response($data);
}

