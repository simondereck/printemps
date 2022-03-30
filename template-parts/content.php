<?php
$id = 0;
if (isset($_GET['page_id'])){
    $id = $_GET['page_id'];
}elseif(isset($_GET['p'])){
    $id = $_GET['p'];
}

$page = get_page($id);
$pages = printemps_read_pages_config();

?>
<?php if ($page->post_type=="page"): ?>
    <?php
        foreach ($pages as $page_value){
            if ($page_value["page"]==$id){
                printemps_get_page_front($page_value);
            }
        }
    ?>
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

<?php //if ( is_active_sidebar( 'printemps-footer' ) ) { ?>
<!--    --><?php //dynamic_sidebar('printemps-footer'); ?>
<?php //} ?>
