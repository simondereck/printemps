<?php


function printemps_admin_head(){
    echo file_get_contents(
        get_template_directory_uri() . '/patterns/admin_head.php'
    );
}




function printemps_selector($select_id=null){
    $pages = get_pages();
    $selector = '<select name="page">';
    foreach ($pages as $page){
        if ($select_id&&$page->ID==$select_id){
            $selector .= '<option selected="selected" value="'.$page->ID.'">'.$page->post_title.'</option>';
        }else{
            $selector .= '<option value="'.$page->ID.'">'.$page->post_title.'</option>';
        }
    }
    echo $selector .= '</select>';
}

function printemps_add_menu(){
    ?>
    <div class="card">
        <label style="font-weight: bold;font-size: 2vw;">
            add menu
        </label>
        <form method="post">
            <label>title</label>
            <input type="text" name="title" value="" class="regular-text"/>
            <br />
            <br />
            <label>link:</label>
            <input type="text" name="link" value="" class="regular-text"/>
            <br />
            <br />
            <label>page:</label>
            <?php printemps_selector() ?>
            <br />
            <br />
            <input name="type" type="hidden" value="create"/>
            <div style="display: flex;justify-content: space-between;">
                <button type="submit" class="btn btn-outline-success btn-sm">add</button>
            </div>
        </form>
    </div>
    <?php
}


function printemps_modal($title,$content){
    ?>
    <div class="modal" id="printemps-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo $title;?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo $content ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}


function printemps_menus(){
    printemps_admin_head();
    $menus = printemps_read_config("menus");
    if ($_POST){
        $type = $_POST["type"];
        if ($type=="delete"){
            $key = $_POST["key"];
            unset($menus[$key]);
            $menus = array_values($menus);
        }elseif ($type=="update"){
            $key = $_POST["key"];
            $menus[$key]["title"] = $_POST["title"];
            $menus[$key]["link"] = $_POST["link"];
            $menus[$key]["page"] = $_POST["page"];
        }elseif ($type=="create"){
            $flag = false;
            foreach ($menus as $key => $menu){
                if ($menu["title"]==$_POST["title"]){
                    $menus[$key]["title"] = $_POST["title"];
                    $menus[$key]["link"] = $_POST["link"];
                    $menus[$key]["page"] = $_POST["page"];
                    $flag = true;
                    break;
                }
            }
            if (!$flag){
                $item = [
                    "title" => $_POST["title"],
                    "link" => $_POST["link"],
                    "page" => $_POST["page"],
                ];
                $menus[] = $item;
            }
        }
        printemps_update_config($menus,"menus");
    }

    ?>
    <div style="background-color: whitesmoke;width: 80%;padding: 20px;">
        <h4>preview</h4>
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
    </div>
    <h1>menus setting</h1>
    <div class='row'>
    <?php
    if ($menus){
        echo "<div class='col'>";
        foreach ($menus as $key=>$value){
            ?>
            <div class="card">
                <div style="display: flex;justify-content: space-between;">
                    <label style="font-weight: bold;font-size: 2vw;">
                        <?php echo $value["title"] ?>
                    </label>
                    <form method="post">
                        <input name="key" type="hidden" value="<?php echo $key ?>"/>
                        <input name="type" type="hidden" value="delete"/>
                        <button type='submit' class='btn btn-danger btn-sm'>delete</button>
                    </form>
                </div>

                <div>
                    <form method="post">
                        <label>title</label>
                        <input type="text" name="title" value="<?php echo $value['title']?>" class="regular-text"/>
                        <br />
                        <br />
                        <label>link:</label>
                        <input type="text" name="link" value="<?php echo $value['link']?>" class="regular-text"/>
                        <br />
                        <br />
                        <label>page:</label>
                        <?php printemps_selector($value["page"]) ?>
                        <br />
                        <br />
                        <input name="key" type="hidden" value="<?php echo $key ?>"/>
                        <input name="type" type="hidden" value="update"/>
                        <button type='submit' class='btn btn-primary btn-sm'>update</button>
                    </form>
                </div>
            </div>
            <?php
        }
        echo "</div>";
    }
    echo "<div class='col'>";
    printemps_add_menu();
    echo "</div>";
    echo "</div>";

}

function printemps_footer(){
    printemps_admin_head();
    $footers = printemps_read_config('footer');
    $flag = 0;
    if ($_POST){
        $type = $_POST["type"];
        $key = $_POST["key"] ?? "";
        if ($type=="new"){
            $flag = 1;
        }elseif ($type=="create"){
            $item = [
                "title"=>$_POST["title"],
                "link"=>$_POST["link"]
            ];
            $footers["items"][$key]["lists"][] = $item;
        }elseif ($type=="global"){
            //do somthing
            $config = [
                "font"=>$_POST["font"],
                "background"=>$_POST["background"],
            ];
            $footers["global"] = $config;
        }elseif ($type=="item"){
            $title = $_POST["title"];
            if (isset($footers["items"]) && $footers["items"]){
                if(!isset($footers["items"][$title])){
                   $footers["items"][$title] = [];
                   $footers["items"][$title]["link"] = $_POST["link"];
                   $footers["items"][$title]["lists"] = [];
                }
            }else{
                $footers["items"] = [];
                $footers["items"][$title] = [];
                $footers["items"][$title]["link"] = $_POST["link"];
                $footers["items"][$title]["lists"] = [];
            }
        }elseif($type=="update_list"){
            $title = $_POST["title"];
            if (!isset($footers["items"][$title])){
                $item = $footers["items"][$key];
                $title = $_POST["title"];
                $item["link"] = $_POST["link"];
                unset($footers["items"][$key]);
                $footers["items"][$title] = $item;
            }else{
                $footers["items"][$key]["link"] = $_POST["link"];
            }
        }elseif($type=="delete_list"){
            unset($footers["items"][$key]);
        }elseif($type=="item_delete"){
            $key_list = $_POST["list_key"];
            unset($footers["items"][$key]["lists"][$key_list]);
            $footers["items"][$key]["lists"] = array_values($footers["items"][$key]["lists"]);
        }
        printemps_update_config($footers,'footer');
    }
    ?>
        <?php if ($flag==0): ?>
            <div style="padding: 20px;width: 80%;margin-top: 20px;margin-bottom: 20px;background-color: whitesmoke;">
                preview
                <?php printemps_get_footer();?>
            </div>
            <div style="width: 80%; display: flex;justify-content: space-between;align-items: center;">
                <h1>footer setting</h1>
                <?php printemps_init_footer($footers["global"]??[]); ?>
                <form method="post">
                    <input name="type" type="hidden" value="item" />
                    <div style="margin-top: 5px;">
                        <input name="title" class="form-control" placeholder="title" />
                    </div>
                    <div style="margin-top: 5px;">
                        <input name="link" class="form-control" type="url" placeholder="link" />
                    </div>
                    <div style="margin-top: 5px;">
                        <button class="btn btn-info btn-sm" type="sumbit">create a list</button>
                    </div>
                </form>
            </div>
            <?php foreach ($footers["items"]??[] as $key => $item): ?>
            <div style="width: 80%;margin-top: 30px;">
                <div style="width: 80%; display: flex;justify-content: space-between;align-items: center;padding: 20px;">
                    <h3><?php echo $key ?></h3>
                    <form method="post">
                        <input type="hidden" value="<?php echo $key ?>" name="key"/>
                        <input type="hidden" value="delete_list" name="type"/>
                        <button class="btn btn-danger btn-sm">delete list</button>
                    </form>
                    <form method="post">
                        <div style="margin-top: 5px;">
                            <input name="title" placeholder="title" class="form-control" value="<?php echo $key ?>"/>
                        </div>
                        <div style="margin-top: 5px;">
                            <input name="link" placeholder="link" class="form-control" value="<?php echo $item["link"] ?? null ?>"/>
                        </div>
                        <input type="hidden" value="update_list" name="type"/>
                        <input type="hidden" value="<?php echo $key ?>" name="key" />
                        <div style="margin-top: 5px;">
                            <button type="submit" class="btn btn-success btn-sm">update list</button>
                        </div>
                    </form>
                </div>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Title</th>
                          <th scope="col">Link</th>
                          <th>
                              <form method="post">
                                    <input name="key" type="hidden" value="<?php echo $key ?>" />
                                    <input name="type" type="hidden" value="new" />
                                    <button class="btn btn-success btn-sm" type="submit">create</button>
                              </form>
                          </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($item["lists"]): ?>
                            <?php foreach ($item["lists"] as $key_list => $value_list): ?>
                               <tr>
                                  <th scope="row"><?php echo $key_list+1; ?></th>
                                  <td><?php echo $value_list["title"] ?></td>
                                  <td><?php echo $value_list["link"] ?></td>
                                  <td>
                                    <form method="post">
                                        <input name="list_key" type="hidden" value="<?php echo $key_list; ?>"/>
                                       <input name="key" value="<?php echo $key ?>" type="hidden" />
                                       <input name="type" value="item_delete" type="hidden"/>
                                       <button class="btn btn-danger btn-sm" type="submit">delete</button>
                                    </form>
                                  </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php endforeach; ?>
        <?php elseif($flag==1): ?>
            <?php printemps_create_single_footer_item($key);?>
        <?php endif;?>
    <?php
}

function printemps_create_single_footer_item($key){
    ?>
    <h1>footer item create</h1>
    <div style="width: 80%;margin-top: 30px;">
        <form method="post">
            <div>
               <label>title</label>
               <input class="form-control" name="title" />
            </div>
            <div>
                <label>link</label>
                <input class="form-control" name="link" />
            </div>
            <div style="margin-top: 20px;">
                <input type="hidden" name="type" value="create" />
                <input type="hidden" name="key" value="<?php echo $key ?>" />
                <button class="btn btn-success btn-sm">create</button>
            </div>
        </form>
    </div>
    <?php
}

function printemps_init_footer($config){
    $font = $config["font"] ?? "#ffffff";
    $background = $config["background"] ?? "#0E0628";
    $lists = $config["lists"] ?? 3;
    $content = '<div>
              <form method="post">
                    <div>
                        <label for="font">font color</label>
                        <input type="color" id="font" name="font" value="'.$font.'" class="form-control"/>
                    </div>
                    <div>
                        <label for="background">background color</label>
                        <input type="color" id="background" name="background" value="'.$background.'" class="form-control"/>
                    </div>
                    <div style="margin-top: 20px;">
                        <input type="hidden" name="type" value="global" />
                        <button class="btn btn-success btn-sm">update</button>
                    </div>
                </form>
        </div>';
     ?>
     <div>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#printemps-modal">
            Footer Config Global
        </button>
        <?php printemps_modal("Footer Config Global",$content);?>
     </div>
     <?php
}

function printemps_admin_upload_image(){

}

function printemps_carousel(){
    printemps_admin_head();
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('my-upload');
    wp_enqueue_style('thickbox');

    $carousel = printemps_read_config("carousel");
    $flag = 0;
    if ($_POST){
        $type = $_POST["type"];
        $key = $_POST["key"];
        if ($type=="update"){
            $flag = 1;
        }elseif($type=="delete"){
            unset($carousel[$key]);
            $carousel = array_values($carousel);
        }elseif($type=="upgrade") {
            $item = [
                "title" => $_POST["title"],
                "image" => $_POST["image"],
                "link" => $_POST["link"],
                "description" => $_POST["description"]
            ];
            $carousel[$key] = $item;
        }elseif ($type=="create"){
            $item = [
                "title" => $_POST["title"],
                "image" => $_POST["image"],
                "link" => $_POST["link"],
                "description" => $_POST["description"]
            ];
            $carousel[] = $item;
        }elseif ($type == "new"){
            $flag = 2;
        }elseif ($type == "create"){
            $item = [
                "title" => $_POST["title"],
                "image" => $_POST["image"],
                "link" => $_POST["link"],
                "description" => $_POST["description"]
            ];
            $carousel[$key] = $item;
        }
        printemps_update_config($carousel,"carousel");
    }
    if ($flag==1){
        $item = $carousel[$key];
        ?>
            <h1>update carousel</h1>
            <div style="width:80%;">
                <form action="" method="post" enctype="multipart/form-data">
                    <label>Title:</label>
                    <input type="text" name="title" class="form-control" value="<?php echo $item['title']?>"/>
                    <label>Image:</label>
                    <input type="text" name="image" class="form-control" value="<?php echo $item['image']?>"/>
                    <label>Link:</label>
                    <input type="text" name="link" class="form-control" value="<?php echo $item['link']?>"/>
                    <label>Description:</label>
                    <textarea name="description" style="height: 25vw;"  class="form-control" >
                        <?php echo $item['description']?>
                    </textarea>
                    <input name="key" value="<?php echo $key ?>" type="hidden" />
                    <input name="type" value="upgrade" type="hidden"/>
                    <br />
                    <button type="submit" class="btn btn-info btn-sm">update</button>
                </form>
            </div>
        <?php
    }else if ($flag == 0){
        ?>
        <div style="background-color: whitesmoke;width: 90%;padding: 20px">
            <h4>preview</h4>
            <?php printemps_get_carousel(); ?>
        </div>
        <div style="display: flex;align-items: center;">
            <h1>carousel setting</h1>
            <form method="post">
                <input type="hidden" name="type" value="new"/>
                <input type="hidden" name="key" value="0" />
                <button class="btn btn-success btn-sm">create</button>
            </form>
        </div>

        <table class="table printemps-table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Des</th>
                <th scope="col">Link</th>
                <th scope="col">Option</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($carousel){
                foreach ($carousel as $key=>$value){
                    ?>
                    <tr>
                        <th scope="row"><?php echo $key; ?></th>
                        <td><img src="<?php echo $value['image']?>"/></td>
                        <td><?php echo $value["title"] ?></td>
                        <td><?php echo $value["description"]?></td>
                        <td><?php echo $value["link"] ?></td>
                        <td>
                            <form method="post">
                                <input name="key" value="<?php echo $key?>" type="hidden"/>
                                <input name="type" value="delete" type="hidden"/>
                                <button class="btn btn-sm btn-outline-danger">delete</button>
                            </form>
                            <form method="post">
                                <input name="key" value="<?php echo $key?>" type="hidden"/>
                                <input name="type" value="update" type="hidden"/>
                                <button class="btn btn-sm btn-outline-primary">update</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
        </table>

        <?php
    }elseif($flag == 2){
        ?>
        <h1>create un carousel</h1>
        <div style="width:80%;">
            <form action="" method="post" enctype="multipart/form-data">
                <label>Title:</label>
                <input type="text" name="title" class="form-control" />
                <label>Image:</label>
                <input type="text" name="image" class="form-control" />
                <label>Link:</label>
                <input type="text" name="link" class="form-control"/>
                <label>Description:</label>
                <textarea name="description" style="height: 25vw;"  class="form-control" ></textarea>
                <input name="key" value="<?php echo $key ?>" type="hidden" />
                <input name="type" value="create" type="hidden"/>
                <br />
                <button type="submit" class="btn btn-success btn-sm">create</button>
            </form>
        </div>
        <?php
    }

}

function printemps_page(){
    printemps_admin_head();
    $menus = printemps_read_config("menus");
    $widgets = printemps_read_widgets_config();
    $pages = printemps_read_pages_config();

    ?>
    <h1>Pages setting</h1>
    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <?php foreach ($menus as $key=>$menu):?>
            <a class="nav-link" id="nav-tab-<?php echo $key;?>" data-toggle="tab" href="#nav-<?php echo $key;?>" role="tab" aria-controls="nav-<?php echo $key;?>" aria-selected="false"><?php echo $menu["title"]?></a>
        <?php endforeach;?>
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
         <?php foreach ($menus as $key=>$menu): ?>
              <div class="tab-pane fade" id="nav-<?php echo $key?>" role="tabpanel" aria-labelledby="nav-tab-<?php echo $key?>">
                    <?php if ($menu["link"]): ?>
                        <div>this page is a kink page link to <a href="<?php echo $menu["link"] ?>"></a></div>
                    <?php else: ?>
                        <div class="row">
                            <div class="col-9">
                                <?php printemps_get_nav(); ?>
                                <?php printemps_get_footer(); ?>
                            </div>
                            <div class="col-3" style="height: 80vh;overflow-y: scroll;">
                                <?php foreach ($widgets as $widgt_key => $widget_value): ?>
                                    <div class="card" data-id="<?php echo $widgt_key; ?>">
                                        <h4><?php echo $widgt_key; ?></h4>
                                        <text><?php echo $widget_value["type"] ?></text>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
              </div>
        <?php endforeach;?>
    </div>
    <script>

    </script>
    <?php
}








