<?php
    /**
     * Template Name: Quotes
     */
    get_header();
    ?>
    <h2 style="text-align:center">Quotes from kanye</h2>
<?php
    for ($i = 1; $i <= 5; $i++) {
        //Make the api call
        $response = wp_remote_request(KANYE_REST);
        $body = $response['body'];
        $myJSON = json_decode($body, true);
        ?>
        <table>
            <tr>
                <th><?= $i . ": " . $myJSON['quote']; ?></th>
            </tr>
        </table>
        <?php
    }
    get_footer();