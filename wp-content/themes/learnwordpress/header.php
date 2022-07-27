<!DOCTYPE html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .header {
            overflow: hidden;
            background-color: #f1f1f1;
            padding: 20px 10px;
        }

        .header a {
            float: left;
            color: black;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            line-height: 25px;
            border-radius: 4px;
        }

        .header a.logo {
            font-size: 25px;
            font-weight: bold;
        }

        .header a:hover {
            background-color: #ddd;
            color: black;
        }

        .header a.active {
            background-color: dodgerblue;
            color: white;
        }

        .header-right {
            float: right;
        }

        @media screen and (max-width: 500px) {
            .header a {
                float: none;
                display: block;
                text-align: left;
            }

            .header-right {
                float: none;
            }
        }
    </style>
    <?php wp_head(); ?>
</head>
<body>

<div class="header">
    <h1><a href="<?php bloginfo('url'); ?>"><?php strtoupper(bloginfo('name')); ?></a></h1>
    <div class="header-right">
        <a href="#home">Home</a>
        <a href="http://127.0.0.1/wordpress/projects/">Archive Page</a>
        <a href="http://127.0.0.1/wordpress/ajax-call/">Ajax Page</a>
        <a href="http://127.0.0.1/wordpress/quotes/">Quotes</a>
        <a href="http://127.0.0.1/wordpress/quotes/">API Page</a>
    </div>
</div>


