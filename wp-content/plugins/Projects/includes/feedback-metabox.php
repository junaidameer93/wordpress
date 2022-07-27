<?php

    add_action( 'add_meta_boxes', 'feedback_action_meta_box' );
    function feedback_action_meta_box()
    {
        add_meta_box( 'feedback-action-meta-box-id', 'Feedback Action', 'add_feedback_action_meta_box', 'feedbacks', 'side', 'high' );
    }


    function add_feedback_action_meta_box(){

        global $post;
        $post_id = $post->ID;
        ?>

        <ul id="feedback_action_checklist" class="list:feedback_action_checklist categorychecklist form-no-clear">

            <li id="feedback_show_this" class="wpseo-term-unchecked">
                <label class="selectit">
                    <input type="checkbox" id="feedback_show_this"  name="Feedback_Action[]" value="showthis">Show on Front End<br>
                </label>
            </li>

            <li id="feedback_email_this" class="wpseo-term-unchecked">
                <label class="selectit">
                    <input type="checkbox" id="feedback_email_this"  name="Feedback_Action[]" value="emailthis">Send Email<br>
                </label>
            </li>
        </ul>

        <?php
    }


    add_action( 'add_meta_boxes', 'campaign_feedback_meta_box_add' );
    function campaign_feedback_meta_box_add()
    {
        add_meta_box( 'campaign-feedback-meta-box-id', 'Beneficiary Personal Information', 'campaign_feedback_meta_box', 'feedbacks', 'normal', 'high' );
    }

    function campaign_feedback_meta_box(){
        global $post;
        $post_id = $post->ID;
        $post_data = get_post_meta($post_id);
        $today          = date('d-m-Y');

        //Patient Data
        $FirstName  = $post_data['FirstName'][0];
        $LastName   = $post_data['LastName'][0];
        wp_nonce_field( 'save_campaign_nonce', 'meta_box_nonce' );
    ?>

        <div class="rwmb-field rwmb-text-wrapper">
            <div class="rwmb-label">
                <label for="">First name<span style="color:red;">*</span></label>
            </div>
            <div class="rwmb-input">
                <input required type="text" class="rwmb-text validate[required]" name="FirstName" id="FirstName" value="<?=$FirstName;?>">
                <p id="first_name" class="description"></p>
            </div>
        </div>

        <div class="rwmb-field rwmb-text-wrapper">
            <div class="rwmb-label">
                <label for="">Last name<span style="color:red;">*</span></label>
            </div>
            <div class="rwmb-input">
                <input required type="text" class="rwmb-text validate[required]" name="LastName" id="LastName" value="<?=$LastName;?>">
                <p id="" class="description"></p>
            </div>
        </div>
    <?php
    }





// updated columns in listing
    add_filter( 'manage_feedbacks_posts_columns', 'th_feedbacks_columns' );
    function th_feedbacks_columns( $defaults ) {
        $defaults['FeedID'] = __( 'FeedID' );
        $defaults['ColName'] = __( 'Name' );
        $defaults['CampaignID'] = __( 'ID' );
        $defaults['Email Status'] = __( 'Email Status' );

        return $defaults;
    }


add_action( 'manage_feedbacks_posts_custom_column', 'th_feedbacks_column_values', 5, 2 );
function th_feedbacks_column_values( $column_name, $post_id ) {
    switch ( $column_name ) {

        case 'FeedID':
            echo $post_id;
            break;

        case 'ColName':
            echo "Running";
            break;

        case 'Email Status':
            echo 'xyz@yahoo.com';
            break;

        case 'CampaignID':
            echo $post_id.'test';
            break;
    }
}


// Register Custom Taxonomy
    function custom_feedback_taxonomy() {

        $labels = array(
            'name'                       => _x( 'feed-categories', 'Taxonomy General Name', 'text_domain' ),
            'singular_name'              => _x( 'feed-category', 'Taxonomy Singular Name', 'text_domain' ),
            'menu_name'                  => __( 'feeds', 'text_domain' ),
            'all_items'                  => __( 'All feeds', 'text_domain' ),
            'parent_item'                => __( 'Parent feed', 'text_domain' ),
            'parent_item_colon'          => __( 'Parent feed:', 'text_domain' ),
            'new_item_name'              => __( 'New Item feed', 'text_domain' ),
            'add_new_item'               => __( 'Add New feed', 'text_domain' ),
            'edit_item'                  => __( 'Edit feed', 'text_domain' ),
            'update_item'                => __( 'Update feed', 'text_domain' ),
            'view_item'                  => __( 'View feed', 'text_domain' ),
            'separate_items_with_commas' => __( 'Separate feeds with commas', 'text_domain' ),
            'add_or_remove_items'        => __( 'Add or remove feeds', 'text_domain' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
            'popular_items'              => __( 'Popular feeds', 'text_domain' ),
            'search_items'               => __( 'Search feeds', 'text_domain' ),
            'not_found'                  => __( 'Not Found', 'text_domain' ),
            'no_terms'                   => __( 'No feeds', 'text_domain' ),
            'items_list'                 => __( 'feeds list', 'text_domain' ),
            'items_list_navigation'      => __( 'feeds list navigation', 'text_domain' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'feed-category', array( 'feedbacks' ), $args );

    }
    add_action( 'init', 'custom_feedback_taxonomy', 0 );


    function add_medicalcamp_meta_box() {
        add_meta_box( 'th-feedbacks-category-meta-box', 'Feed Category','display_medicalcamp_category_metabox', 'feedbacks','side','core');
    }


    function display_medicalcamp_category_metabox( $post )
    {

        //Get taxonomy and terms
        $taxonomy = 'feed-category';
        //Set up the taxonomy object and get terms
        $tax = get_taxonomy($taxonomy);
        $terms = get_terms($taxonomy,array('hide_empty' => 0));

        //Name of the form
        $name = 'tax_input[' . $taxonomy . ']';

        //Get current and popular terms
        $popular = get_terms( $taxonomy, array( 'orderby' => 'count', 'order' => 'DESC', 'number' => 10, 'hierarchical' => false ) );
        $postterms = get_the_terms( $post->ID,$taxonomy );
        $current = ($postterms ? array_pop($postterms) : false);
        $current = $current->term_id;
        ?>

        <div id="taxonomy-<?php echo $taxonomy; ?>" class="categorydiv">


            <!-- Display taxonomy terms -->
            <div id="<?php echo $taxonomy; ?>-all" class="tabs-panel">
                <ul id="<?php echo $taxonomy; ?>checklist" class="list:<?php echo $taxonomy?> categorychecklist form-no-clear">
                    <?php   foreach($terms as $term){
                        $id = $taxonomy.'-'.$term->term_id;
                        echo "<li id='$id'><label class='selectit'>";
                        echo "<input type='radio' id='in-$id' name='{$name}'".checked($current,$term->term_id,false)."value='$term->term_id' />$term->name<br />";
                        echo "</label></li>";
                    }?>
                </ul>
            </div>


        </div>
        <?php
    }

    //---------------------------- SAVE post function --------------------------------//
    add_action( 'save_post', 'campaign_meta_box_save' );
    function campaign_meta_box_save( $post_id )
    {
        global $wpdb;
        error_log('save_post called!');
        // Bail if we're doing an auto save
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        // if our nonce isn't there, or we can't verify it, bail
        if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'save_campaign_nonce' ) ) return;

        // if our current user can't edit this post, bail
        //if( !current_user_can( 'edit_post' ) ) return;

        // now we can actually save the data
        if( isset( $_POST['FirstName'] ) ){
            $FirstName = $_POST['FirstName'];
            update_post_meta( $post_id, 'FirstName', $_POST['FirstName']);
        }


        if( isset( $_POST['LastName'] ) ) {
            $LastName = $_POST['LastName'];
            update_post_meta($post_id, 'LastName', $_POST['LastName']);
        }

    }