<?php
// This theme called printemps because we meet in spring
get_header();

?>

<main id="content">
    <?php printemps_get_carousel();?>
<?php //if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("printemps-navi") ) : ?>
<?php //dynamic_sidebar('printemps-navi'); ?>
<?php //endif;?>

    <div id="printemps-indestries">
        <div class="printemps-indestries-line">
            <div class="printemps-indestries-item printemps-indestries-item-img">
                <img src="<?php echo get_template_directory_uri().'/assets/images/industrie-1.jpeg' ?>" />
                <h3>Industries 1</h3>
            </div>
            <div class="printemps-indestries-item printemps-indestries-item-text">
                <h3>Industries 2</h3>
                <p>
                    Le concept d’industrie 4.0 correspond à une nouvelle façon d’organiser les moyens de production.
                    Cette nouvelle industrie s'affirme comme la convergence du monde virtuel,
                    de la conception numérique, de la gestion avec les produits et objets du monde réel.
                </p>
            </div>
        </div>
        <div class="printemps-indestries-line">
            <div class="printemps-indestries-item printemps-indestries-item-img">
                <img src="<?php echo get_template_directory_uri().'/assets/images/industrie-2.jpeg' ?>" />
                <h3>Industries 3</h3>
            </div>
            <div class="printemps-indestries-item printemps-indestries-item-img">
                <img src="<?php echo get_template_directory_uri().'/assets/images/industrie-3.jpeg' ?>" />
                <h3>Industries 4</h3>
            </div>
            <div class="printemps-indestries-item printemps-indestries-item-img">
                <img src="<?php echo get_template_directory_uri().'/assets/images/industrie-4.jpeg' ?>" />
                <h3>Industries 5</h3>
            </div>
        </div>
    </div>

    <div id="printemps-partners">
        <h1>Our partners</h1>
        <div class="printemps-partners-items">
            <div class="printemps-partners-item">
                <img src="<?php echo get_template_directory_uri().'/assets/images/partner-2.png' ?>" />
            </div>
            <div class="printemps-partners-item">
                <img src="<?php echo get_template_directory_uri().'/assets/images/partner-3.jpeg' ?>" />
            </div>
            <div class="printemps-partners-item">
                <img src="<?php echo get_template_directory_uri().'/assets/images/partner-4.png' ?>" />
            </div>
            <div class="printemps-partners-item">
                <img src="<?php echo get_template_directory_uri().'/assets/images/partner-5.png' ?>" />
            </div>
        </div>
    </div>

    <style>

        body{
            background-color: whitesmoke;
        }


    </style>
    <script>
        $("#carouselExampleCaptions").on("click",".btn-carousel",function () {

            const link = $(this).attr("data-href");
            if (link && link.length>4){
                window.open(link);
            }
        });
    </script>
</main>
<?php //if ( is_active_sidebar( 'printemps-footer' ) ) { ?>
<?php //dynamic_sidebar('printemps-footer'); ?>
<?php //} ?>
<?php
get_footer();
?>
