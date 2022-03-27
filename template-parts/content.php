<?php
$id = 0;
if (isset($_GET['page_id'])){
    $id = $_GET['page_id'];
}elseif(isset($_GET['p'])){
    $id = $_GET['p'];
}
//$page = get_page(the_ID());

$page = get_page($id);
?>
<?php if ($page->post_title=="Products"): ?>
    <?php
    $cid = get_cat_ID("products");
    $category_query_args = array(
        'cat' => $cid
    );
    $category_query = new WP_Query($category_query_args);
    $posts = $category_query->posts;
    ?>
    <div class="printemps-page-div products-div">
        <h1>Product List</h1>
        <div class="printemps-content products-content">
            <?php foreach ($posts as $key => $post):?>
                <?php if ($key%2==0): ?>
                    <div class="post-product">
                        <div class="post-product-img">
                            <?php printemps_get_featured_image($post)?>
                        </div>
                        <div class="post-product-content">
                            <p>
                            <h2 class="post-product-title"><?php echo apply_filters( 'the_title', $post->post_title, $post->ID ); ?></h2>
                            </p>
                            <p class="post-product-context">
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
    </div>
    <script>
        $(function () {
            $('#content').css('padding','0');
        });
    </script>
<?php elseif($page->post_title=="Publications"): ?>
    <?php
    $cid = get_cat_ID("publications");
    $category_query_args = array(
        'cat' => $cid
    );
    $category_query = new WP_Query($category_query_args);
    $posts = $category_query->posts;
    ?>
    <div class="printemps-page-div  publications">
        <div class="publications-top-bar">
            <img src="<?php echo get_template_directory_uri().'/assets/images/publication.jpeg'; ?>" />
            <h1>Publication</h1>
        </div>
        <div class="publications-header">
            <p><h2>Suscribe to our newsletter</h2></p>
            <p>
                <h5>Receive all our update and new articles directly in your mail box.</h5>
            </p>
            <p>
                <button class="btn btn-primary publications-header-btn" data-toggle="modal" data-target="#printemps-contact-us">Subscribe</button>
            </p>
        </div>
        <div class="printemps-content publications-content">
            <?php foreach ($posts as $post):?>
                <div class="post-publication">
                    <div class="post-publication-img">
                        <?php printemps_get_featured_image($post)?>
                    </div>
                    <div class="post-publication-right">
                        <p>
                            <h3 class="post-publication-title"><?php echo apply_filters( 'the_title', $post->post_title, $post->ID ); ?></h3>
                        </p>
                        <p class="post-publication-content">
                            <?php printemps_get_post_description($post->post_content); ?>
                        </p>
                        <a class="btn btn-info publication-read-btn" href="?p=<?php echo $post->ID;?>">Read</a>
                    </div>
                </div>
            <?php endforeach;?>
        </div>

        <div class="modal" id="printemps-contact-us" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
<!--                    <div class="modal-header">-->
<!--                        <h5 class="modal-title">Modal title</h5>-->
<!--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                            <span aria-hidden="true">&times;</span>-->
<!--                        </button>-->
<!--                    </div>-->
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h2><label>Stay in touch with us</label></h2>
                        <p>
                            Receive all our update and new articles directly in your mail box.
                        </p>
                        <div>
                            <form action="" method="post">
                                <p>
                                    <h4>
                                        <label>Name</label>
                                    </h4>
                                </p>
                                <p>
                                    <input name="name" class="form-control"/>
                                </p>
                                <p>
                                    <h4><label>E-mail</label></h4>
                                </p>
                                <p>
                                    <input name="email" class="form-control"/>
                                </p>
                                <p>
                                    <div class="publication-button-groups">
                                        <button class="btn btn-primary  publications-header-btn publications-submit-btn" >Subscribe</button>
                                    </div>
                                </p>
                            </form>

                        </div>

                    </div>
<!--                    <div class="modal-footer">-->
<!--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--                        <button type="button" class="btn btn-primary">Save changes</button>-->
<!--                    </div>-->
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#content').css('padding','0');
            $(".publications-submit-btn").click(function () {

            });
        });
    </script>
<?php elseif($page->post_title=="Contact Us"): ?>

    <div class="printemps-page-div">
        <div class="contact-us-top-bar">
            <img src="<?php echo get_template_directory_uri().'/assets/images/company.jpeg'; ?>" />
        </div>
        <div class="contact-us-div">
            <h1>Contact us</h1>
            <div>
                <div class="card career-card contact-card">
                    <div class="card-body">
                        <h4 class="card-title">Let's do something amazing together.</h4>
                        <div class="card-text">
                            <form action="" method="post">
                                <p>
                                <div class="contact-item">
                                    <input class="form-control"  name="email" placeholder="Work e-mail"/>
                                    <input class="form-control"  name="company" placeholder="Company"/>
                                </div>
                                </p>
                                <p>
                                <div class="contact-item">
                                    <input class="form-control"  name="name" placeholder="Name"/>
                                    <input class="form-control"  name="surname" placeholder="Surname"/>
                                </div>
                                </p>
                                <p>
                                <div class="contact-item">
                                    <input class="form-control"  name="country" placeholder="Country"/>
                                    <input class="form-control"  name="product" placeholder="Select Product"/>
                                </div>
                                </p>
                            </form>
                        </div>
                        <div class="btn-groups">
                            <button class="btn btn-primary btn-lg contact-send-btn">Send</button>
                        </div>
                    </div>
                    <div class="card-img">
                        <img src="https://etesia-formation.com/wp-content/uploads/2020/11/formation-gestion-efficacite-professionnelle.jpg"  />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#content').css('padding','0');
        });
    </script>
<?php elseif($page->post_title=="Career"): ?>
    <div class="printemps-page-div">
        <h1>Job title</h1>
        <div class=" career-div">
            <?php
            $cid = get_cat_ID("career");
            $category_query_args = array(
                'cat' => $cid
            );
            $category_query = new WP_Query($category_query_args);
            $posts = $category_query->posts;
            ?>
            <div class="printemps-content">
                <?php foreach ($posts as $post):?>
                    <div class="card career-card">
<!--                        <div class="card-header">-->
<!--                            --><?php //echo $post->post_title; ?>
<!--                        </div>-->
                        <div class="card-body">
                            <h4 class="card-title"><?php echo apply_filters( 'the_title', $post->post_title, $post->ID ); ?></h4>
                            <p class="card-text">
                                <?php printemps_get_post_description($post->post_content); ?>
                            </p>
                            <a href="?p=<?php echo $post->ID;?>" class="btn btn-info career-action-btn">Action</a>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
<?php elseif($page->post_title=="Company"): ?>
    <div class="printemps-page-div">
        <div class="contact-us-top-bar">
            <img src="<?php echo get_template_directory_uri().'/assets/images/company.jpeg'; ?>" />
            <h1>Company</h1>
        </div>
        <div class="company-div">
            <h1>About Us</h1>
            <div class="description">
                <p>
                    Heroku est une entreprise créant des logiciels pour serveur qui permettent
                    le déploiement d'applications web.
                    Créée en 2007, elle est rachetée en 2010 par l'éditeur Salesforce.com. Wikipédia
                </p>
            </div>
            <div>
                <?php
                $cid = get_cat_ID("company");
                $category_query_args = array(
                    'cat' => $cid
                );
                $category_query = new WP_Query($category_query_args);
                $posts = $category_query->posts;
                ?>

                <div class="printemps-company-roles">
                    <?php foreach ($posts as $post):?>
                        <div class="card company-role-item" style="width: 18rem;">
                            <div class="company-role-item-img"><?php  printemps_get_featured_image($post); ?></div>
                            <!--                        <img src="..." class="card-img-top" alt="...">-->
                            <div class="card-body">
                                <h5 class="card-title"><?php echo apply_filters( 'the_title', $post->post_title, $post->ID ); ?></h5>
                                <p class="card-text">
                                    <?php printemps_get_post_description($post->post_content); ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#content').css('padding','0');
        });
    </script>
<?php elseif($page->post_title=="Solution"): ?>
    <div class="printemps-page-div">
        <div class="contact-us-top-bar">
            <img src="<?php echo get_template_directory_uri().'/assets/images/industrie-3.jpeg'; ?>" />
            <h1>Solution</h1>
        </div>
        <div class="solution-div">
            <h1>Page title</h1>

        </div>
    </div>
    <script>
        $(function () {
            $('#content').css('padding','0');
        });
    </script>
<?php else:?>
    <div class="printemps-page-div">
        <div class="printemps-post-style">
            <h1><?php echo $page->post_title; ?></h1>
            <div class="printemps-content">
                <?php echo $page->post_content; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
