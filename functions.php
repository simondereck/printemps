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




const PRINTEMPS_CONFIG = "printemps_config";
const PRINTEMPS_PAGES_CONFIG = "printemps_pages_config";
const PRINTEMPS_WIDGETS_CONFIG = "printemps_widgets_config";
//widgets
require dirname(__FILE__) . '/widgets/test_widget.php';
require dirname(__FILE__) . '/widgets/printemps_footer_widget.php';

function printemps_widgets_init() {

    register_sidebar(
        array(
            'name'          => __( 'Footer', 'printemps' ),
            'id'            => 'printemps-footer',
            'description'   => __( 'Add widgets here to appear in your footer.', 'printemps' ),
            'before_widget' => '<div class="widget-area">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar( array(
        'name'          => __( 'Navigation', 'printemps' ),
        'id'            => 'printemps-navi',
        'description'   => __( 'Appears in the navi section of the site.', 'printemps' ),
        'before_widget' => '<div class="navigation">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );


    $config = array(
        "carousel" => [
            [
                "title" => "Carousel title 1",
                "description" => "Le concept d’industrie 4.0 correspond à une nouvelle façon d’organiser les moyens de production.
                    Cette nouvelle industrie s'affirme comme la convergence du monde virtuel,
                    de la conception numérique, de la gestion avec les produits et objets du monde réel.",
                "link" => null,
                "image" => "https://medisf.traasgpu.com/ifis/f4ad837102573086-1024x576.jpg",
            ],
            [
                "title" => "Carousel title 2",
                "description" => "Le concept d’industrie 4.0 correspond à une nouvelle façon d’organiser les moyens de production.
                    Cette nouvelle industrie s'affirme comme la convergence du monde virtuel,
                    de la conception numérique, de la gestion avec les produits et objets du monde réel.",
                "link" => null,
                "image" => "https://p1.img.cctvpic.com/fmspic/vms/image/2020/05/30/VSET_1590821895671235.jpg",
            ],
            [
                "title" => "Carousel title 3",
                "description" => "Le concept d’industrie 4.0 correspond à une nouvelle façon d’organiser les moyens de production.
                    Cette nouvelle industrie s'affirme comme la convergence du monde virtuel,
                    de la conception numérique, de la gestion avec les produits et objets du monde réel.",
                "link" =>null,
                "image" => "https://statics.dujiabieshu.com/statics/manager/ueditor/php/upload/image/20191202/b7e1bfcbfae4b33956b4236b88209fb3736121.jpg",
            ],
        ],
        "menus" => [
            ["title"=>"Proudcts","link"=>null,"page"=>null],
            ["title"=>"Solution","link"=>null,"page"=>null],
            ["title"=>"Company","link"=>null,"page"=>null],
            ["title"=>"Career","link"=>null,"page"=>null],
            ["title"=>"Publication","link"=>null,"page"=>null],
            ["title"=>"Contact us","link"=>null,"page"=>null],
        ],
        "footer" => array(),
    );
    add_option(PRINTEMPS_CONFIG,json_encode($config));

    $pages_config = [];
    foreach ($config["menus"] as $menu){
        $item = [
            "title"=>$menu["title"],
            "link" =>$menu["link"],
            "page" =>$menu["page"],
            "config" => []
        ];
        $pages_config[$menu["title"]] = $item;
    }

    add_option(PRINTEMPS_PAGES_CONFIG,json_encode($pages_config));

}
add_action( 'widgets_init', 'printemps_widgets_init' );

function printemps_enqueue_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle',
        plugins_url(get_template_directory_uri().'/assets/js/printemps-admin.js', __FILE__ ),
        array( 'example-color-picker' ),
        false,
        true
    );
}
add_action('admin_enqueue_scripts', 'printemps_enqueue_color_picker' );

function printemps_read_config($config_name=null){
    $value = get_option(PRINTEMPS_CONFIG);
    if ($value){
        $config = json_decode($value,true);
        if ($config_name && isset($config[$config_name])){
            return $config[$config_name];
        }
        return $config;
    }

    return [];
}

function printemps_update_config($data,$config_name=null){
    if ($config_name){
        $value = get_option(PRINTEMPS_CONFIG);
        if ($value){
            $config = json_decode($value,true);
            $config[$config_name] = $data;
        }
        update_option(PRINTEMPS_CONFIG,json_encode($config));
        return;
    }
    update_option(PRINTEMPS_CONFIG,json_encode($data));
}

function printemps_read_pages_config($title=null){
    $value = get_option(PRINTEMPS_PAGES_CONFIG);
    if ($value){
        $config = json_decode($value,true);
        if ($title && isset($config[$title])){
            return $config[$title];
        }
        return $config;
    }
    return [];
}

function printemps_update_pages_config($data,$title=null){
    if ($title){
        $value = get_option(PRINTEMPS_PAGES_CONFIG);
        if ($value){
            $config = json_decode($value,true);
            $config[$title] = $data;
        }
        update_option(PRINTEMPS_PAGES_CONFIG,json_encode($config));
        return;
    }
    update_option(PRINTEMPS_PAGES_CONFIG,json_encode($data));
}

function printemps_read_widgets_config($_id=null){
    $value = get_option(PRINTEMPS_WIDGETS_CONFIG);
    if ($value){
        $config = json_decode($value,true);
        if (isset($config[$_id])){
            return $config[$_id];
        }
        return $config;
    }
    add_option(PRINTEMPS_WIDGETS_CONFIG,json_encode([]));
    return [];
}

function printemps_update_widgets_config($data,$_id=null){
    if ($_id){
        $config = printemps_read_widgets_config();
        $config[$_id] = $data;
        update_option(PRINTEMPS_WIDGETS_CONFIG,json_encode($config));
        return;
    }
    update_option(PRINTEMPS_WIDGETS_CONFIG,json_encode($data));
}

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


require dirname(__FILE__) . '/classes/printemps-config.php';
require dirname(__FILE__) . '/classes/printemps-widgets-config.php';

function printemps_add_settings_menu() {
    add_menu_page(__('自定义菜单标题'), __('Printemps'), 'genericon-dropbox',  __FILE__, 'test', false, 2);
    add_submenu_page(__FILE__,'sub menu 1','menus setting', 'administrator', 'pms_menu', 'printemps_menus');
    add_submenu_page(__FILE__,'sub menu 2','carousel setting', 'administrator', 'pms_carousel', "printemps_carousel");
    add_submenu_page(__FILE__,'sub menu 3','footer setting', 'administrator', 'pms_footer', 'printemps_footer');
    add_submenu_page(__FILE__,'sub menu 4','pages setting', 'administrator', 'pms_pages', 'printemps_page');
    add_submenu_page(__FILE__,'sub menu 5','widgets setting', 'administrator', 'pms_widgets', 'printemps_widgets');
}

add_action('admin_menu','printemps_add_settings_menu');


function printemps_get_menus(){
    $menu_array = [
      "menu_html" => '<li class="nav-item"><a class="nav-link" href="%1$s">%2$s</a></li>',
    ];
    $menus = printemps_read_config("menus");
    foreach ($menus as $menu){
        if($menu["link"]){
            echo sprintf($menu_array["menu_html"],$menu["link"],$menu["title"]);
        }elseif ($menu["page"]){
            echo sprintf($menu_array["menu_html"],"?page_id=".$menu["page"],$menu["title"]);
        }else{
            echo sprintf($menu_array["menu_html"],"#",$menu["title"]);
        }
    }
}


function printemps_get_nav(){
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-white printemps-nav">
        <?php printemps_title() ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse content-align-right " id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto nav-flex-icons bg-white" >
                <?php
                printemps_get_menus();
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
    <?php
}

function printdump($data){
    echo "<pre>";
    var_dump($data);
    die;
}

function printemps_get_carousel(){
    $carouse_array = [
      'item_active'=> '<div class="carousel-item active">
                <img src="%1$s" class="d-block w-100">
                <div class="carousel-caption d-none d-md-block printemps-carousel-content-block-left">
                    <h4>%2$s</h4>
                    <p>%3$s</p>
                    <button class="btn btn-info btn-carousel" data-href="%4$s">Action</button>
                </div>
            </div>',
        'item'=> '<div class="carousel-item">
                <img src="%1$s" class="d-block w-100">
                <div class="carousel-caption d-none d-md-block printemps-carousel-content-block-left">
                    <h4>%2$s</h4>
                    <p>%3$s</p>
                    <button class="btn btn-info btn-carousel" data-href="%4$s">Action</button>
                </div>
            </div>',
        'slide' => '<li data-target="#carouselExampleCaptions" data-slide-to="%1$s"></li>',
        'slide_active' => '<li data-target="#carouselExampleCaptions" data-slide-to="%1$s" class="active"></li>'
    ];

    $carousel = printemps_read_config("carousel");

    $carouselDiv = '<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">';
    $carouselDiv .= '<ol class="carousel-indicators">';
    foreach ($carousel as $key => $value){
        if ($key == 0){
            $carouselDiv .= sprintf($carouse_array["slide_active"],$key);
        }else{
            $carouselDiv .= sprintf($carouse_array["slide"],$key);
        }
    }
    $carouselDiv .= '</ol>';
    $carouselDiv .= '<div class="carousel-inner">';
    foreach ($carousel as $key => $value){
        if ($key == 0){
            $carouselDiv .= sprintf($carouse_array["item_active"],$value["image"],$value["title"],$value["description"],$value["link"]);
        }else{
            $carouselDiv .= sprintf($carouse_array["item"],$value["image"],$value["title"],$value["description"],$value["link"]);
        }
    }
    $carouselDiv .= '</div>';
    $carouselDiv .= '</div>';
    echo $carouselDiv;
}

function printemps_get_footer(){
    $footers = printemps_read_config("footer");
    $items = $footers["items"] ?? [];
    $global = $footers["global"] ?? [];
    $styles = "";
    $color = $global["font"] ?? "white";
    $background = $global["background"] ?? "#0E0628";
    $styles .= "color:".$color.";";
    $styles .= "background-color:".$background.";";

    ?>
    <footer id="site-footer" class="header-footer-group" style="<?php echo $styles;?>">
        <div class="section-inner">
            <div class="footer-credits">
                <div class="footer-items">
                    <div class="footer-logo">
                        <p><?php echo get_custom_logo() ?></p>
                    </div>
                    <?php foreach ($items as $key => $item):?>
                        <div>
                            <p>
                                <?php if($item["link"]):?>
                                    <h4><a href="<?php echo $item["link"] ?>"><?php echo $key ?></a></h4>
                                <?php else: ?>
                                    <h4><a href="#"><?php echo $key ?></a></h4>
                                <?php endif; ?>
                            </p>

                            <?php foreach($item["lists"] as $key_list => $value_list): ?>
                                <p>
                                    <a href="<?php echo $value_list["link"] ?>"><?php echo $value_list["title"] ?></a>
                                </p>
                            <?php endforeach; ?>

                        </div>
                    <?php endforeach;?>
                </div>
                <div class="footer-copyright">
                    <hr color="white" />
                    <p class="footer-copyright">&copy;
                        <a  href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <style>
        #site-footer a:link,
        #site-footer a,
        #site-footer a:hover{
            color:<?php echo $color ?>;
            text-decoration: none;
        }
    </style>
    <?php
}

function printemps_get_information_block($config){
    if ($config){
        $color = $config["font"] ?? "black";
        $background = $config["background"] ?? "whitesomke";
        $style = "color:".$color.";background-color:".$background.";";
        ?>
        <div class="printemps-block_information_div" style="<?php echo $style ?>">
            <p><h2><?php echo $config["title"] ?? "" ?></h2></p>
            <p><h5><?php echo $config["description"] ?? "" ?></h5></p>
        </div>
        <?php
    }
}


function printemps_get_image_block($config){
    $title = $config["title"] ?? "";
    $font = $config["font"] ?? "black";
    $image = $config["image"] ?? "";
    $style = "color:".$font.";";
    ?>
        <div class="printemps-block_image_div">
            <img src="<?php echo $image; ?>" />
            <h1 style="<?php echo $style; ?>"><?php echo $title; ?></h1>
        </div>
    <?php

}

function printemps_get_post_five($config){
//    "category"=>$_POST["category"],
    $category = $config["category"];
    $category_query_args = array(
        'cat' => $category,
        "numberposts"=>5
    );
    $category_query = new WP_Query($category_query_args);
    $posts = $category_query->posts;
    if (count($posts)>=5){
        ?>
        <div id="printemps-indestries">
            <div class="printemps-indestries-line">
                <div class="printemps-indestries-item printemps-indestries-item-img">
                    <?php  printemps_get_featured_image($posts[0]) ?>
                    <!--                <img src="--><?php //echo get_template_directory_uri().'/assets/images/industrie-1.jpeg' ?><!--" />-->
                    <h3><?php echo apply_filters('the_title', $posts[0]->post_title, $posts[0]->ID); ?></h3>
                </div>
                <div class="printemps-indestries-item printemps-indestries-item-text">
                    <h3><?php echo apply_filters('the_title', $posts[1]->post_title, $posts[1]->ID); ?></h3>
                    <p>
                        <?php printemps_get_post_description($posts[1]->post_content); ?>
                    </p>
                </div>
            </div>
            <div class="printemps-indestries-line">
                <div class="printemps-indestries-item printemps-indestries-item-img">
                    <?php  printemps_get_featured_image($posts[2]) ?>
                    <h3><?php echo apply_filters('the_title', $posts[2]->post_title, $posts[2]->ID); ?></h3>
                </div>
                <div class="printemps-indestries-item printemps-indestries-item-img">
                    <?php  printemps_get_featured_image($posts[3]) ?>
                    <h3><?php echo apply_filters('the_title', $posts[3]->post_title, $posts[3]->ID); ?></h3>
                </div>
                <div class="printemps-indestries-item printemps-indestries-item-img">
                    <?php  printemps_get_featured_image($posts[4]) ?>
                    <h3><?php echo apply_filters('the_title', $posts[4]->post_title, $posts[4]->ID); ?></h3>
                </div>
            </div>
        </div>
        <?php
    }

}


function printemps_get_post_list($config){
    $category = $config["category"];
    $category_query_args = array(
        'cat' => $category,
    );
    $category_query = new WP_Query($category_query_args);
    $posts = $category_query->posts;
    ?>
    <div class="printemps-post-lists-content">
        <?php foreach ($posts as $post):?>
            <div class="printemps-post-list">
                <div class="printemps-post-list-img">
                    <?php printemps_get_featured_image($post)?>
                </div>
                <div class="printemps-post-list-right">
                    <p>
                    <h3 class="printemps-post-list-title"><?php echo apply_filters( 'the_title', $post->post_title, $post->ID ); ?></h3>
                    </p>
                    <p class="printemps-post-list-content">
                        <?php printemps_get_post_description($post->post_content); ?>
                    </p>
                    <a class="btn btn-info printemps-post-list-read-btn" href="?p=<?php echo $post->ID;?>"><?php echo $config["title"] ?></a>
                </div>
            </div>
        <?php endforeach;?>
    </div>
    <style>
        .printemps-post-list-read-btn{

            color:<?php echo $config["font"] ?? "white" ?>;
            background-color: <?php echo $config["background"] ?>;
            border:<?php echo $config["font"] ?? "white" ?> ;
            border-radius: 36px;
        }
    </style>
    <?php
}


function printemps_get_post_cross($config){
    $category = $config["category"];
    $category_query_args = array(
        'cat' => $category,
    );
    $category_query = new WP_Query($category_query_args);
    $posts = $category_query->posts;
    ?>
    <div>
        <?php foreach ($posts as $key => $post):?>
            <?php if ($key%2==0): ?>
                <div class="printemps-post-cross">
                    <div class="printemps-post-cross-img">
                        <?php printemps_get_featured_image($post)?>
                    </div>
                    <div class="printemps-post-cross-content">
                        <p>
                        <h2 class="printemps-post-cross-title"><?php echo apply_filters( 'the_title', $post->post_title, $post->ID ); ?></h2>
                        </p>
                        <p class="printemps-post-cross-context">
                            <?php printemps_get_post_description($post->post_content); ?>
                        </p>
                    </div>
                </div>
            <?php else: ?>
                <div class="post-product">
                    <div class="post-product-content">
                        <p>
                        <h2 class="post-product-title"><?php echo apply_filters( 'the_title', $post->post_title, $post->ID ); ?></h2>
                        </p>
                        <p class="post-product-context">
                            <?php printemps_get_post_description($post->post_content); ?>
                        </p>
                    </div>
                    <div class="post-product-img">
                        <?php printemps_get_featured_image($post)?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach;?>
    </div>

    <?php
}


function printemps_inline_icons($config){
    $title = $config["title"] ?? "";
    $background = $config["background"] ?? "white";
    $font = $config["font"] ?? "black";
    $image_type =  $config["image_type"] ?? "round";
    $items = $config["items"];
    ?>
    <div class="printemps-inline-icons" style="background-color: <?php echo $background;?>;">
        <h1 style="color:<?php echo $font;?>;"><?php echo $title; ?></h1>
        <div class="printemps-inline-icons-items">
            <?php foreach ($items as $item): ?>
                <div class="printemps-inline-icons-item">
                    <?php if ($item["link"]):?>
                        <a href="<?php echo $item["link"] ?>">
                            <img src="<?php echo $item["image"]?>" />
                        </a>
                    <?php else: ?>
                        <img src="<?php echo $item["image"]?>" />
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <style>
        .printemps-inline-icons-item{
            border-radius: <?php echo $image_type=="round"?"100%":"" ?>;
        }
    </style>
    <?php
}

function printemps_get_page($configs){

}






