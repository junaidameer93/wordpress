<?php
    // Rest API route, endpoint: http://localhost/wordpress/wp-json/secureapis/v1/coffee-api/

    add_action('rest_api_init', function () {
        $version = '1';
        $namespace = 'secureapis/v' . $version;

        register_rest_route($namespace, '/coffee-api/', array(
                'methods' => 'GET',
                'callback' => 'give_me_coffee',
                'permission_callback' => '__return_true'
            )
        );

    });


    function give_me_coffee($request)
    {
        //Make the call and get quotes
        $response = wp_remote_request(RANDOM_COFFEE);

        $body = $response['body'];
        $myJSON = json_decode($body, true);

        $coffee_cup = $myJSON['file'];
        wp_redirect($coffee_cup);
        die();
    }