jQuery(document).ready(function ($) {

    jQuery("#load-projects").on("click", function () {
        get_ajax_data();
    });

});

function get_ajax_data() {

    jQuery.ajax({
        url: ajax_object.ajax_url,
        type: 'post',
        data: {
            action: 'get_projects'
        },
        success: function (result) {
            jQuery("#response").html(result);
        }


    });
}