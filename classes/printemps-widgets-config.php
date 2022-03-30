<?php

function printemps_widgets(){
    printemps_admin_head();
    $widgets = null;
    $configs = printemps_read_widgets_config();

    if ($_POST){
        $widgets = $_POST["widgets"] ?? "";
        $type = $_POST["type"] ?? "";
        if ($type=="create"){
            if ($widgets=="block_information"){
                $item = [
                  "type"=> "block_information",
                  "_id" => $_POST["id"],
                  "font" => $_POST["font"],
                  "background" => $_POST["background"],
                  "title" => $_POST["title"],
                  "description" => $_POST["description"]
                ];
                //save
                $configs[$_POST["id"]] = $item;
            }elseif($widgets=="block_image"){
                $item = [
                  "type"=>"block_image",
                  "_id"=>$_POST["id"],
                  "font"=>$_POST["font"],
                  "title"=>$_POST["title"],
                ];
                $configs[$_POST["id"]] = $item;
            }elseif($widgets=="post_list"){
                $item = [
                    "type"=>"post_list",
                    "_id"=>$_POST["id"],
                    "font"=>$_POST["font"],
                    "background"=>$_POST["background"],
                    "category"=>$_POST["category"],
                ];
                $configs[$_POST["id"]] = $item;
            }elseif($widgets=="post_cross"){
                $item = [
                    "type"=>"post_cross",
                    "_id"=>$_POST["id"],
                    "category"=>$_POST["category"],
                ];
                $configs[$_POST["id"]] = $item;
            }elseif($widgets=="post_five"){
                $item = [
                    "type"=>"post_five",
                    "_id"=>$_POST["id"],
                    "category"=>$_POST["category"],
                ];
                $configs[$_POST["id"]] = $item;
            }elseif ($widgets=="inline_icons"){
                $item = [
                    "type" => "inline_icons",
                    "_id" => $_POST["id"],
                    "title" => $_POST["title"],
                    "background" => $_POST["background"],
                    "font" => $_POST["font"],
                    "image_type" => $_POST["image"],
                    "items" => $_POST["items"],
                ];
                $configs[$_POST["id"]] = $item;
            }
            printemps_update_widgets_config($configs);
        }
    }
    ?>
        <h1>Printemps widgets setting</h1>
        <div class="row" style="width: 95%;">
            <div class="col">
                <div style="padding: 20px;background-color: whitesmoke;">
                    preview
                    <div id="preview-div" style="margin-top: 20px;"></div>
                </div>
                <div>
                    <?php if ($widgets=="block_information"): ?>
                        <?php printemps_block_information(); ?>
                    <?php elseif ($widgets=="block_image"):?>
                        <?php printemps_block_images(); ?>
                    <?php elseif ($widgets=="post_list"):?>
                        <?php printemps_post_lists();?>
                    <?php elseif ($widgets=="post_five"):?>
                        <?php printemps_post_five(); ?>
                    <?php elseif ($widgets=="post_cross"):?>
                        <?php printemps_post_cross(); ?>
                    <?php elseif ($widgets=="inline_icons"): ?>
                        <?php printemps_inline_icon();?>
                    <?php else: ?>
                        <div style="margin-top: 20px;" class="alert alert-warning" role="alert">
                            <p>please select a widgets to design!</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col col-4">
                <p>
                    select a widget add to your widgets contain, then you can apply in your page.
                </p>
                <p>
                    supper easy to start with printemps widgets.
                </p>
                <p>
                    link to page setting <a href="?page=pms_pages" class="btn btn-link">pages setting</a>
                </p>
                <form method="post" id="form_widgets">
                    <select name="widgets" class="form-control" id="select-widgets">
                        <option value="">--- select a widget ---</option>
                        <option value="block_information" <?php echo $widgets=="block_information"?"selected":"" ?> >information selection</option>
                        <option value="block_image" <?php echo $widgets=="block_image"?"selected":"" ?> >image selection</option>
                        <option value="inline_icons" <?php echo $widgets=="inline_icons"?"selected":"" ?> >inline icons</option>
                        <option value="post_list" <?php echo $widgets=="post_list"?"selected":"" ?> >post lists selection</option>
                        <option value="post_five" <?php echo $widgets=="post_five"?"selected":"" ?> >post five selection</option>
                        <option value="post_cross" <?php echo $widgets=="post_cross"?"selected":"" ?> >post cross selection</option>
                    </select>
                </form>
                <div style="margin-top: 20px;">
                    <?php foreach ($configs as $config): ?>
                        <div class="card" data-id="<?php echo $config["_id"] ?>">
                            <p>id: <?php echo $config["_id"] ?> </p>
                            <p>type: <?php echo $config["type"] ?></p>
                            <button class="btn btn-success btn-sm">update</button>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
        <script>
            $(function () {
                $("#select-widgets").change(function () {
                    const select_value = $(this).val();
                    if (select_value){
                        $("#form_widgets").submit();
                    }
                });
            });
        </script>
    <?php
}


function printemps_block_information(){
    ?>
        <div style="padding: 30px;background-color: floralwhite;margin-top: 20px;">
            <form method="post" id="block_info_form">
                <label>_ID (this id is for select in pages)</label>
                <input name="id" class="form-control" required />
                <label>Title</label>
                <input name="title" class="form-control" required />
                <label>Description</label>
                <textarea id="description" name="description" class="form-control" style="height: 15vw;" required></textarea>
                <label>Background color</label>
                <input type="color" name="background" value="#f0f0f0"/>
                <label>Font color</label>
                <input name="font" type="color" value="#00000"/>
                <input type="hidden" name="type" value="create" />
                <input type="hidden" name="widgets" value="block_information" />
                <div style="margin-top: 5px;">
                    <button class="btn btn-success btn-sm">create</button>
                </div>
            </form>
        </div>
        <script>
            $(function () {
                function preview() {
                    const title = $("input[name=title]").val();
                    const description = $("textarea").val();
                    const font = $("input[name=font]").val();
                    const background = $("input[name=background]").val();
                    var style = "color:"+font+";background-color:"+background+";";
                    var item = '<div class="printemps-block_information_div" style="'+style+'">' +
                        '<p><h2 style="color:'+font+';">' + title + '</h2></p>' +
                        '<p><h5>' + description + '</h5></p>' +
                        '</div>';
                    $("#preview-div").html(item);
                }
               $("input").change(function () {
                    preview();
               });

               $("textarea").change(function () {
                   preview();
               });
            });
        </script>
    <?php
}

function printemps_block_images(){
    ?>
        <div style="padding: 30px;background-color: floralwhite;margin-top: 20px;">
            <form method="post">
                <label>_ID (this id is for select in pages)</label>
                <input name="id" class="form-control" required />
                <label>Title</label>
                <input name="title" class="form-control"  />
                <label>Image</label>
                <input name="image" class="form-control" required/>
                <div style="margin-top: 5px;">
                    <label>Font color</label>
                    <input name="font" type="color" value="#00000"/>
                </div>
                <input type="hidden" name="type" value="create" />
                <input type="hidden" name="widgets" value="block_image" />
                <div style="margin-top: 5px;">
                    <button class="btn btn-success btn-sm">create</button>
                </div>
            </form>
        </div>
        <script>
            $("input").change(function () {
                const title = $("input[name=title]").val();
                const font = $("input[name=font]").val();
                const image = $("input[name=image]").val();
                var style = "color:"+font+";";
                var item = '<div class="printemps-block_image_div">' +
                        '<img src="'+image+'"/>' +
                        '<h1 style="'+style+'">'+title+'</h1>' +
                    '</div>';
                $("#preview-div").html(item);
            });
        </script>
    <?php
}


function printemps_post_five(){
    $categories = get_categories([
        'hide_empty'      => false,
    ]);
    ?>
        <div style="padding: 30px;background-color:floralwhite;margin-top: 20px;">
            <form method="post">
                <label>_ID (this id is for select in pages)</label>
                <input name="id" class="form-control" required />
                <label>Category</label>
                <select name="category" class="form-control" required >
                    <option value="">--- select a category for datasouce ---</option>
                    <?php foreach ($categories as $category):?>
                        <option value="<?php echo $category->name; ?>"><?php echo $category->name; ?></option>
                    <?php endforeach;?>
                </select>
                <input type="hidden" name="type" value="create" />
                <input type="hidden" name="widgets" value="post_five" />
                <div style="margin-top: 5px;">
                    <button class="btn btn-success btn-sm">create</button>
                </div>
            </form>
        </div>
        <div class="hidden" id="posts-list-demo">
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
        </div>
        <script>
            $("input").change(function () {
                const item = $("#posts-list-demo").html();
                $("#preview-div").html(item);
            });
        </script>
    <?php
}

function printemps_post_three_block(){

}

function printemps_post_lists(){
    $categories = get_categories([
        'hide_empty'      => false,
    ]);
    $posts = get_posts(["numberposts"=>2]);
    ?>
        <div style="padding: 30px;background-color:floralwhite;margin-top: 20px;">
            <form method="post">
                <label>_ID (this id is for select in pages)</label>
                <input name="id" class="form-control" required />
                <label>Category</label>
                <select name="category" class="form-control" required >
                    <option value="">--- select a category for datasouce ---</option>
                    <?php foreach ($categories as $category):?>
                        <option value="<?php echo $category->name; ?>"><?php echo $category->name; ?></option>
                    <?php endforeach;?>
                </select>
                <label>Button Font color</label>
                <input type="color" class="form-control" name="font" value="#ffffff"/>
                <label>Button color</label>
                <input type="color" class="form-control" value="#00C1D4" name="background" />
                <label>Button text</label>
                <input class="form-control" value="read" name="title" required />
                <input type="hidden" name="type" value="create" />
                <input type="hidden" name="widgets" value="post_list" />
                <div style="margin-top: 5px;">
                    <button class="btn btn-success btn-sm">create</button>
                </div>
            </form>
        </div>
        <div class="hidden" id="posts-list-demo">
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
                            <a class="btn btn-info printemps-post-list-read-btn" href="?p=<?php echo $post->ID;?>">Read</a>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>

        <script>
            $("input").change(function () {
                const color = $("input[name=font]").val();
                const background= $("input[name=background]").val();
                const title = $("input[name=title]").val();
                $(".printemps-post-list-read-btn").each(function () {
                    $(this).text(title);
                    console.log(title);
                });
                const item = $("#posts-list-demo").html();
                var style = '<style>' +
                        '.printemps-post-list-read-btn{'+
                            'color:'+color+';'+
                            'background-color:'+background+';'+
                            'border:'+color+';' +
                            'border-radius: 36px;' +
                        '}'+
                    '</style>';
                $("#preview-div").html(item);
                $("#preview-div").append(style);
            });
        </script>
    <?php
}

function printemps_post_cross(){
    $categories = get_categories([
        'hide_empty'      => false,
    ]);
    $posts = get_posts(["numberposts"=>3]);
    ?>
    <div style="padding: 30px;background-color:floralwhite;margin-top: 20px;">
        <form method="post">
            <label>_ID (this id is for select in pages)</label>
            <input name="id" class="form-control" required />
            <label>Category</label>
            <select name="category" class="form-control" required >
                <option value="">--- select a category for datasouce ---</option>
                <?php foreach ($categories as $category):?>
                    <option value="<?php echo $category->name; ?>"><?php echo $category->name; ?></option>
                <?php endforeach;?>
            </select>
            <input type="hidden" name="type" value="create" />
            <input type="hidden" name="widgets" value="post_cross" />
            <div style="margin-top: 5px;">
                <button class="btn btn-success btn-sm">create</button>
            </div>
        </form>
    </div>
    <div class="hidden" id="posts-list-demo">
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
    </div>
    <script>
        $("input").change(function () {
            const item = $("#posts-list-demo").html();
            $("#preview-div").html(item);
        });
    </script>
    <?php
}

function printemps_modal_set(){
    //button color style text
    //modal information
    //avec le buttons
}


function printemps_inline_icon(){
    //images
    //url
    $content = '<div>
                    <label>Image (required)</label>
                    <input name="image" class="form-control"/>
                    <label>link</label>
                    <input name="link" class="form-control" />
                    <div style="margin-top: 5px">
                    <button class="btn btn-sm btn-success" id="printemp-add-item">add</button>
            </div>
        </div>'
    ?>
        <div style="padding: 30px;background-color:floralwhite;margin-top: 20px;">
            <form method="post">
                <label>_ID (this id is for select in pages)</label>
                <input name="id" class="form-control" required />
                <label>Title</label>
                <input name="title" class="form-control" />
                <label>Background color</label>
                <input type="color" name="background" value="#f0f0f0"/>
                <label>Font color</label>
                <input name="font" type="color" value="#00000"/>
                <label>Image type</label>
                <select name="image" class="form-control select-image-type">
                    <option value="round" selected>round</option>
                    <option value="square">square</option>
                </select>
                <div id="add-items">

                </div>
                <div style="margin-top:5px;">
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#printemps-modal">
                        add a item
                    </button>
                </div>
                <input type="hidden" name="type" value="create" />
                <input type="hidden" name="widgets" value="inline_icons" />
                <div style="margin-top: 5px;">
                    <button class="btn btn-success btn-sm" type="submit">create</button>
                </div>
            </form>

        </div>
        <?php printemps_modal("add a item",$content);?>
        <div id="posts-list-demo" class="hidden">
            <div class="printemps-inline-icons">
                <h1></h1>
                <div class="printemps-inline-icons-items">

                </div>
            </div>
        </div>
        <script>
            function preview(){
                const title = $("input[name=title]").val();
                $("#posts-list-demo").find("h1").text(title);
                const background =  $("input[name=background]").val();
                const font = $("input[name=font]").val();
                const image_type = $(".select-image-type").val();
                var style = ""
                console.log(image_type);
                if (image_type=="round") {
                    $("#posts-list-demo").find(".printemps-inline-icons-item").each(function () {
                        $(this).css("border-radius","100%");
                    });
                }else{
                    $("#posts-list-demo").find(".printemps-inline-icons-item").each(function () {
                        $(this).css("border-radius",'');
                    });
                }
                $("#posts-list-demo").find('h1').css("color",font);
                $(".printemps-inline-icons").css("background-color",background);
                const item = $("#posts-list-demo").html();
                $("#preview-div").html(item);
                $("#preview-div").append(style);
            }
            $("input").change(function () {
                preview();
            });

            $(".select-image-type").change(function () {
                preview();
            });
            var $i = 0;
            $("#printemp-add-item").click(function () {
                const image = $("input[name=image]").val();
                const link = $("input[name=link]").val();
                var $content =  '<div class="card">' +
                        '<label>image</label>' +
                        '<input name="items['+$i+'][image]" class="form-control" value="'+image+'"/>' +
                        '<label>link</label>' +
                        '<input name="items['+$i+'][link]" class="form-control" value="'+link+'"/>'+
                    '</div>'
                $("#add-items").append($content);

                const to_preview = '<div class="printemps-inline-icons-item">' +
                    '<img src="'+image+'" />' +
                    '</div>';
                $(".printemps-inline-icons-items").append(to_preview);
                $("#printemps-modal").modal('hide');
                $i++;
            });
        </script>
    <?php
}



