<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since
 */

get_header();
?>

<main id="content">

	<?php
    if (get_post_type()=="page"){
        get_template_part( 'template-parts/content', get_post_type());
    }else{
        if ( have_posts() ) {

            while ( have_posts() ) {
                the_post();
			    get_template_part( 'template-parts/content', get_post_type() );
            }
        }
    }
	?>

</main><!-- #site-content -->

<?php //get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
