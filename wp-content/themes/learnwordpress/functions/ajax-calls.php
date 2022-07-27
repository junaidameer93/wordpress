<?php


    add_action( 'wp_ajax_nopriv_get_projects', 'get_projects_handler' );
    add_action( 'wp_ajax_get_projects', 'get_projects_handler' );

    function get_projects_handler() {
        $result['status']='success';
        if ( is_user_logged_in() ) {
            $ppp = 3;
        } else {
            $ppp = 6;
        }

        $args = array(
            'post_type'	=> CPT_PROJECTS,
            'orderby' => 'desc',
            'post_status'	=> 'publish',
            'posts_per_page' =>$ppp,
            'tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => PROJECT_TYPE,
                    'field' 	=> 'slug',
                    'terms' 	=> PROJECT_TYPE_TERM
                ),
            ),
        );

        $data = new WP_Query( $args );
        $myData = array();
        $jsonData = array();
        $myData['success'] = true;
        $result = array();
        if ( $data->have_posts() ) :
            while ( $data->have_posts() ) : $data->the_post();

                $post_id        = get_the_ID();
                $post_title 	= get_the_title($post_id);;

                // cycle through all the items
                array_push($result,['id'=>$post_id,'title'=>$post_title,'link'=>get_permalink()]);

            endwhile;
        endif;

        $myData['data'] = $result;
        //print_r($result);
        $response = json_encode($myData);
        echo wp_send_json($response);

        die();
    }