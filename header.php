<?php
/**
 * Theme Name: Printemps
 * Theme URI: https://wordpress.org/themes/Printemps/
 * Author: the printemps team
 * Author URI: https://wordpress.org/
 * Description: Built on a solidly designed foundation,
 * Requires at least: 5.9
 * Tested up to: 5.9
 * Requires PHP: 5.6
 * Version: 1.1
 * License: GNU General Public License v2 or later
 * License URI:
 * Text Domain:
 */

?>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-white printemps-nav">
    <?php printemps_title() ?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse content-align-right " id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto nav-flex-icons bg-white" >
            <?php
            //            wp_list_pages();
            $pages = get_pages();
            foreach ($pages as $page) {
                if ($page->post_title=="Contact Us"
                    ||$page->post_title=="Publications"
                    ||$page->post_title=="Career"
                    ||$page->post_title=="Company"
                    ||$page->post_title=="Solution"
                    ||$page->post_title=="Products"
                ){
                    echo "<li class='nav-item'><a class='nav-link' href='?page_id=".$page->ID."'>".$page->post_title."</a></li>";
                }
            }
            ?>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="/bussiness/platform" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Lan
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">中文</a>
                    <a class="dropdown-item" href="#">English</a>
                    <a class="dropdown-item" href="#">French</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
