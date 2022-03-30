<?php


class test_widget extends WP_Widget
{
    public function __construct(){
        $widget_ops = array(
            'classname'=>'test_widget',
            'desctipiton' => 'for the test widget functiono',
        );
        parent::__construct('test_widget','Test Widget',$widget_ops);
    }

    public function widget($args,$instance){
        echo $args['before_widget']; // 输出 widget 前面的内容，一般是主题提供的样式。
        echo $args['before_title'];
        echo "test wi";
        echo $args['after_title'];
        if (empty($instance['title'])){
            $instance['title'] = "啦啦";
        }
        if (empty($instance["image_url"])){
            $instance["image_url"] = "https://media.istockphoto.com/photos/picturesque-morning-in-plitvice-national-park-colorful-spring-scene-picture-id1093110112?k=20&m=1093110112&s=612x612&w=0&h=3OhKOpvzOSJgwThQmGhshfOnZTvMExZX2R91jNNStBY=";
        }
        if (empty($instance["link"])){
            $instance['link'] = "https://media.istockphoto.com/photos/picturesque-morning-in-plitvice-national-park-colorful-spring-scene-picture-id1093110112?k=20&m=1093110112&s=612x612&w=0&h=3OhKOpvzOSJgwThQmGhshfOnZTvMExZX2R91jNNStBY=";
        }
        // 输出内容
        echo '<figure>
               <a href="' .   $instance['link'] .  '">
               <img src="'.   $instance['image_url'] .  '" alt="'.$instance['title'].'" width="304" height="228"></a>
               <figcaption>'. $instance['title'] .  '</figcaption>
              </figure>';
        echo $args['after_widget'];
    }

    public function form( $instance ) {

        $title = ! empty( $instance['title'] ) ? $instance['title'] : "尼玛";
        $image_url = !empty($instance['image_url']) ? $instance['image_url'] : "https://media.istockphoto.com/photos/picturesque-morning-in-plitvice-national-park-colorful-spring-scene-picture-id1093110112?k=20&m=1093110112&s=612x612&w=0&h=3OhKOpvzOSJgwThQmGhshfOnZTvMExZX2R91jNNStBY=";
        $link  = ! empty( $instance['link'] ) ? $instance['link'] : "https://media.istockphoto.com/photos/picturesque-morning-in-plitvice-national-park-colorful-spring-scene-picture-id1093110112?k=20&m=1093110112&s=612x612&w=0&h=3OhKOpvzOSJgwThQmGhshfOnZTvMExZX2R91jNNStBY=";
        ?>
            <div>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">标题</label>
                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
                </p>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>">图片地址</label>
                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_url' ) ); ?>" type="text" value="<?php echo esc_attr( $image_url ); ?>">
                </p>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>">链接</label>
                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>">
                </p>
            </div>

        <?php
    }

    public function update( $new_instance, $old_instance ) {

    }
}

function printemps_test_widget_init (){
    return register_widget('test_widget');
}

add_action('widgets_init', 'printemps_test_widget_init');


