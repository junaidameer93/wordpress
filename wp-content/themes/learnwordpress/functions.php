<?php

    //static variables declaration
    define('THEME_URI', get_template_directory_uri());
    define('THEME_DIR', get_template_directory());
    define('LIBS_DIR', THEME_DIR . '/functions');
    define('TEMP_DIR', THEME_DIR . '/templates');
    define('API_DIR', THEME_DIR . '/RestAPI');

    //Defining api urls
    define('KANYE_REST', 'https://api.kanye.rest/');
    define('RANDOM_COFFEE', 'https://coffee.alexflipnote.dev/random.json');

    // including files
    require_once(API_DIR . '/rest-api.php');
    require_once(LIBS_DIR . '/ajax-calls.php');

    // This theme uses post thumbnails
    add_theme_support('post-thumbnails');

    function filter_ip_address()
    {
        $ip_address = $_SERVER['REMOTE_ADDR'];
            $ip_array = explode(".", $ip_address);
            if ($ip_array[0] == '77') {
                if ($ip_array[1] == '29') {
                    exit;
                }
            }
    }

    add_action('wp_head', 'filter_ip_address');

    //scripts loading
    function my_enqueue()
    {
        wp_enqueue_script('jquery-js', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), '1.0', true);
        wp_register_script('ajaxscript', THEME_URI . "/js/myscript.js", array('jquery'), '1.0.0', false);
        wp_enqueue_script('ajaxscript');
        wp_localize_script(
            'ajaxscript',
            'ajax_object',
            array('ajax_url' => admin_url('admin-ajax.php')));

    }

    add_action('wp_enqueue_scripts', 'my_enqueue');
    do_action('wp_enqueue_scripts');


?>