<?php
/*
Plugin Name: WPFirstAid Sample Widget
Plugin URI: http://wpfirstaid.com
Description: Plugin with multi-widget functionality that displays stuff ...
Version: 0.3
Author: Edward Caissie
Author URI: http://edwardcaissie.com/
License: GNU General Public License v2
License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

/* Add function to the widgets_init hook. */
add_action( 'widgets_init', 'load_my_wpfa_sample_widget' );
  
/* Function that registers our widget. */
function load_my_wpfa_sample_widget() {
	register_widget( 'WPFA_Sample_Widget' );
}

class WPFA_Sample_Widget extends WP_Widget {
  
	function WPFA_Sample_Widget() {
      /* Widget settings. */
  		$widget_ops = array('classname' => 'wpfa-sample', 'description' => __('Displays some stuff.'));
  		/* Widget control settings. */
  		$control_ops = array('width' => 200, 'height' => 200, 'id_base' => 'wpfa-sample');
  		/* Create the widget. */
  		$this->WP_Widget('wpfa-sample', 'WPFirstAid Sample', $widget_ops, $control_ops);
  	}
	
	function widget( $args, $instance ) {
      extract( $args );
      /* User-selected settings. */
      $title        = apply_filters('widget_title', $instance['title'] );
      $choices      = $instance['choices'];
      $show_choices = $instance['show_choices'];
      $optionals    = $instance['optionals'];

      /* Before widget (defined by themes). */
      echo $before_widget;

      /* Title of widget (before and after defined by themes). */
      if ( $title )
        echo $before_title . $title . $after_title;

      /* Display stuff based on widget settings. */
      if ( $show_choices ) {
        echo $choices . ' is in ... step to your ' . $optionals;
      } else {
        echo __('No appointments today');
      }

      /* After widget (defined by themes). */
      echo $after_widget;
  }
  
	function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      
      /* Strip tags (if needed) and update the widget settings. */
      $instance['title']          = strip_tags( $new_instance['title'] );
      $instance['choices']        = strip_tags( $new_instance['choices'] );
      $instance['show_choices']   = $new_instance['show_choices'];
      $instance['optionals']      = $new_instance['optionals'];

      return $instance;
  }
  
  function form( $instance ) {
      /* Set default widget settings. */
      $defaults = array(
          'title'                 => __('WPFirstAid Sample'),
          'choices'               => 'The Doctor',
          'show_choices'          => true,
          'optionals'             => 'right'
      );
      $instance = wp_parse_args( (array) $instance, $defaults );
		?>
    
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:'); ?></label>
  		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
  	</p>
		
		<p>
  		<label for="<?php echo $this->get_field_id( 'choices' ); ?>"><?php _e('Make your choices:'); ?></label>
  		<input id="<?php echo $this->get_field_id( 'choices' ); ?>" name="<?php echo $this->get_field_name( 'choices' ); ?>" value="<?php echo $instance['choices']; ?>" style="width:100%;" />
  	</p>
  		
  	<p>
			<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['show_choices'], true ); ?> id="<?php echo $this->get_field_id( 'show_choices' ); ?>" name="<?php echo $this->get_field_name( 'show_choices' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_choices' ); ?>"><?php _e('Show your choices?'); ?></label>
		</p>
		
 		<p>
			<label for="<?php echo $this->get_field_id( 'optionals' ); ?>"><?php _e('Options:'); ?></label>
			<select id="<?php echo $this->get_field_id( 'optionals' ); ?>" name="<?php echo $this->get_field_name( 'optionals' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'right' == $instance['optionals'] ) echo 'selected="selected"'; ?>>right</option>
				<option <?php if ( 'left' == $instance['optionals'] ) echo 'selected="selected"'; ?>>left</option>
			</select>
		</p>

		<?php
	}
}
/* Add shortcode from post: */ 
function wpfa_sample_shortcode ($atts) {
  ob_start(); /* Start capture */
  /* Using the_widget() to make a plugin template tag */
  ?>
  <div class="wpfa-sample-shortcode">
  <?php
  the_widget(
    WPFA_Sample_Widget,
    $instance = shortcode_atts( array(
          'title'                 => __('WPFirstAid Sample'),
          'choices'               => 'The Doctor',
          'show_choices'          => true,
          'optionals'             => 'right'
    ), $atts ),
    $args = array (
    'before_widget'   => '',
    'before_title'    => '',
    'after_title'     => '',
    'after_widget'    => ''
    )
  );
  ?>
  </div><!-- .wpfa-sample-shortcode -->
  <?php
  $wpfa_sample_output = ob_get_contents(); /* Captured output */
  ob_end_clean(); /* Stop capture */

  return $wpfa_sample_output;
}
add_shortcode( 'wpfa_sample', 'wpfa_sample_shortcode' );
/* Shortcode end */