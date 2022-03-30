<?php


class printemps_footer_widget extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = array(
            'classname'=>'printemps_footer_widget',
            'desctipiton' => 'for the test widget functiono',
        );
        parent::__construct('printemp_footer_widget','Printemps Footer',$widget_ops);
    }

    public function widget($args,$instance)
    {
        $url = "https://media.istockphoto.com/photos/picturesque-morning-in-plitvice-national-park-colorful-spring-scene-picture-id1093110112?k=20&m=1093110112&s=612x612&w=0&h=3OhKOpvzOSJgwThQmGhshfOnZTvMExZX2R91jNNStBY=";
        $elment = sprintf('<img src="%1$s"/>',$url);
        echo $args['before_widget'];
        echo $args['before_title'];
        echo '<h2>footer hello</h2>';
        echo '<img src="'.$url.'"/>';
        echo $args['after_title'];
        echo $args['after_widget'];

    }

    public function form($instance){
        echo '<p>footer</p>';
        echo '<input name="simone" value="simone" />';
    }

    public function update( $new_instance, $old_instance ) {

    }

}


function printemps_footer_widget_init (){
    return register_widget('printemps_footer_widget');
}

add_action('widgets_init', 'printemps_footer_widget_init');


