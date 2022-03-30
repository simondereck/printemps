<?php


class printemps_header_widget extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = array(
            'classname'=>'printemps_header_widget',
            'desctipiton' => 'This is theme header',
        );
        parent::__construct('printemp_header_widget','Printemps Header',$widget_ops);
    }

    public function widget($args,$instance)
    {
        echo $args['before_widget'];
        echo $args['before_title'];
        echo '<h2>Header hello</h2>';
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


function printemps_header_widget_init (){
    return register_widget('printemps_header_widget');
}

add_action('widgets_init', 'printemps_header_widget_init');


