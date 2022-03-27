<?php

if ( ! function_exists( 'printemps_support' ) ) :

    function printemps_support() {

        // Add support for block styles.
        add_theme_support( 'wp-block-styles' );

        // Enqueue editor styles.
        add_editor_style( 'style.css' );

    }

endif;

add_action( 'after_setup_theme', 'printemps_support' );


function printemps_styles() {
    // Register theme stylesheet.
    wp_register_style(
        'printemps-style',
        get_template_directory_uri() . '/style.css'
    );

    // Enqueue theme stylesheet.
    wp_enqueue_style( 'printemps-style' );

}

add_action( 'after_setup_theme', 'printemps_styles' );


function printemps_getImage($content) {
    $count = substr_count($content, '<img');
    $start = 0;
    for($i=1;$i<=$count;$i++) {
        $imgBeg = strpos($content, '<img', $start);
        $post = substr($content, $imgBeg);
        $imgEnd = strpos($post, '>');
        $postOutput = substr($post, 0, $imgEnd+1);
        $postOutput = preg_replace('/width="([0-9]*)" height="([0-9]*)"/', '',$postOutput);;
        if(stristr($postOutput,'<img')) { return $postOutput; }
        $start=$imgEnd+1;
    }
    return null;
}


function printemps_get_featured_image($post){
     $image = get_the_post_thumbnail( $post->ID, 'thumbnail' );
     if (!$image){
         $image = printemps_getImage($post->post_content);
         if (!$image){
             $image = "<img src='".get_template_directory_uri()."/assets/images/post-no-image.png' />" ;
         }
     }
     echo $image;
}

function printemps_get_post_description($post_content){
    echo wp_strip_all_tags(apply_filters( 'the_content', $post_content ));
}

function printemps_auto_set_featured_image() {
    global $post;
    $featured_image_exists = has_post_thumbnail($post->ID);
    if (!$featured_image_exists)  {
        $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
        if ($attached_image) {
            foreach ($attached_image as $attachment_id => $attachment) {set_post_thumbnail($post->ID, $attachment_id);}
        }
    }
}
add_action('the_post', 'printemps_auto_set_featured_image');

function create_page($title_of_the_page,$content,$parent_id = NULL )
{
    $objPage = get_page_by_title($title_of_the_page, 'OBJECT', 'page');
    if( ! empty( $objPage ) )
    {
//        echo "Page already exists:" . $title_of_the_page . "<br/>";
        return $objPage->ID;
    }

    $page_id = wp_insert_post(
        array(
            'comment_status' => 'close',
            'ping_status'    => 'close',
            'post_author'    => 1,
            'post_title'     => ucwords($title_of_the_page),
            'post_name'      => strtolower(str_replace(' ', '-', trim($title_of_the_page))),
            'post_status'    => 'publish',
            'post_content'   => $content,
            'post_type'      => 'page',
            'post_parent'    =>  $parent_id //'id_of_the_parent_page_if_it_available'
        )
    );

    return $page_id;
}


function get_post_by_post_name( $slug = '', $post_type = '' )
{
    //Make sure that we have values set for $slug and $post_type
    if (!$slug || !$post_type)
        return false;

    // We will not sanitize the input as get_page_by_path() will handle that
    $post_object = get_page_by_path( $slug, OBJECT, $post_type );

    if ( !$post_object )
        return false;

    return $post_object;
}





//https://wordpress.stackexchange.com/questions/196289/is-there-a-way-to-change-the-default-page-template-selection
//change wordpress theme by page type

function init_category(){
    require_once( ABSPATH . '/wp-admin/includes/taxonomy.php');
    //定义分类数据
    $my_cat = array(
        'cat_name' => 'products',
        'category_description' => 'A Cool products',
        'category_nicename' => 'products-slug',
        'category_parent' => ''
    );
    $pid = create_page( 'Products', 'This is how it works');
    $cid = wp_insert_category($my_cat);
    wp_set_post_categories( $pid,$cid, true ); // set category
    wp_set_post_tags( $pid,"products", true );

    $my_cat = array(
        'cat_name' => 'solution',
        'category_description' => 'A Cool solution',
        'category_nicename' => 'solution-slug',
        'category_parent' => ''
    );
    $cid = wp_insert_category($my_cat);
    $pid = create_page( 'Solution', 'The contact us page');
    wp_set_post_categories( $pid,$cid, true ); // set category
    wp_set_post_tags( $pid,"solution", true );

    $my_cat = array(
        'cat_name' => 'company',
        'category_description' => 'A Cool company',
        'category_nicename' => 'company-slug',
        'category_parent' => ''
    );
    $cid = wp_insert_category($my_cat);
    $pid = create_page( 'Company', 'The about us page');
    wp_set_post_categories( $pid,$cid, true ); // set category
    wp_set_post_tags( $pid,"company", true );

    $my_cat = array(
        'cat_name' => 'career',
        'category_description' => 'A Cool career',
        'category_nicename' => 'career-slug',
        'category_parent' => ''
    );
    $cid = wp_insert_category($my_cat);
    $pid = create_page( 'Career', 'The team page');
    wp_set_post_categories( $pid,$cid, true ); // set category
    wp_set_post_tags( $pid,"career", true );

    $my_cat = array(
        'cat_name' => 'publications',
        'category_description' => 'A Cool publications',
        'category_nicename' => 'publications-slug',
        'category_parent' => ''
    );
    $cid = wp_insert_category($my_cat);
    $pid = create_page( 'Publications', 'The team page');
    wp_set_post_categories( $pid,$cid, true ); // set category
    wp_set_post_tags( $pid,"publications", true );

    $my_cat = array(
        'cat_name' => 'contact',
        'category_description' => 'A Cool contact',
        'category_nicename' => 'contact-slug',
        'category_parent' => ''
    );
    $cid = wp_insert_category($my_cat);
    $pid = create_page( 'Contact us', 'The team page');
    wp_set_post_categories( $pid,$cid, true ); // set category
    wp_set_post_tags( $pid,"contact", true );

}

add_action('after_setup_theme','init_category');


function printemps_site_logo( $args = array(), $echo = true ) {
    $logo       = get_custom_logo();
    $site_title = get_bloginfo( 'name' );
    $contents   = '';
    $classname  = '';

    $defaults = array(
        'logo'        => '%1$s<span class="screen-reader-text">%2$s</span>',
        'logo_class'  => 'site-logo',
        'title'       => '<a href="%1$s">%2$s</a>',
        'title_class' => 'site-title',
        'home_wrap'   => '<h1 class="%1$s">%2$s</h1>',
        'single_wrap' => '<div class="%1$s faux-heading">%2$s</div>',
        'condition'   => ( is_front_page() || is_home() ) && ! is_page(),
    );

    $args = wp_parse_args( $args, $defaults );

    /**
     * Filters the arguments for `twentytwenty_site_logo()`.
     *
     * @since Twenty Twenty 1.0
     *
     * @param array $args     Parsed arguments.
     * @param array $defaults Function's default arguments.
     */
    $args = apply_filters( 'printemps_site_logo', $args, $defaults );

    if ( has_custom_logo() ) {
        $contents  = sprintf( $args['logo'], $logo, esc_html( $site_title ) );
        $classname = $args['logo_class'];
    } else {
        $contents  = sprintf( $args['title'], esc_url( get_home_url( null, '/' ) ), esc_html( $site_title ) );
        $classname = $args['title_class'];
    }

    $wrap = $args['condition'] ? 'home_wrap' : 'single_wrap';

    $html = sprintf( $args[ $wrap ], $classname, $contents );

    /**
     * Filters the arguments for `printemp_site_logo()`.
     *
     * @since printemps 1.0
     *
     * @param string $html      Compiled HTML based on our arguments.
     * @param array  $args      Parsed arguments.
     * @param string $classname Class name based on current view, home or single.
     * @param string $contents  HTML for site title or logo.
     */
    $html = apply_filters( 'printemps_site_logo', $html, $args, $classname, $contents );

    if ( ! $echo ) {
        return $html;
    }

    echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}


function printemps_title(){
/*        <a class="navbar-brand" href="<?php bloginfo('url');?>">*/
//<!--            <img src="/img/logo.svg" width="30" height="30" class="d-inline-block align-top" alt="" />-->
//        <h1>php bloginfo('name');<!--</h1>-->

    $site_title = get_bloginfo( 'name' );

    $default = array(
        "title"=>'<h1>%1$s</h1>',
        "home_wrap_class" => 'navbar-brand',
        "home_wrap"=>'<a href="%1$s" class="%2$s">%3$s</a>',

    );
    $content = sprintf($default["title"],esc_html($site_title));
    echo sprintf($default["home_wrap"],esc_url( get_home_url( null, '/' )),$default["home_wrap_class"],$content);
}

function printemps_add_settings_menu() {
    add_menu_page(__('自定义菜单标题'), __('printemps'), 'administrator',  __FILE__, 'test', false, 2);
    add_submenu_page(__FILE__,'子菜单1','设置 1', 'administrator', 'test1', 'test1');
    add_submenu_page(__FILE__,'子菜单2','设置 2', 'administrator', 'test2', 'test1');
    add_submenu_page(__FILE__,'子菜单3','设置 3', 'administrator', 'test3', 'test1');
    add_submenu_page(__FILE__,'子菜单3','设置 4', 'administrator', 'test4', 'test1');
}

add_action('admin_menu','printemps_add_settings_menu');

function test1(){
    echo "<h1>1233</h1>";
}

function test(){
    echo "<h1>from theme</h1>";
}
