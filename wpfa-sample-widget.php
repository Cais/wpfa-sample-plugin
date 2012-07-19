<?php
/*
Plugin Name: WPFirstAid Sample Widget
Plugin URI: http://wpfirstaid.com
Description: Plugin with multi-widget functionality that displays stuff ...
Version: 0.3
Author: Edward Caissie
Author URI: http://edwardcaissie.com/
Textdomain: wpfa-sample
License: GNU General Public License v2
License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

/**
 * WPFirstAid Sample Plugin for WordPress
 *
 * Plugin with multi-widget functionality that displays stuff ... and a lot more
 * things as well.
 *
 * @package     WPFA_Sample
 * @link        https://github.com/Cais/wpfa-sample
 * @version     0.3
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2010-2012, Edward Caissie
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 2, as published by the
 * Free Software Foundation.
 *
 * You may NOT assume that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to:
 *
 *      Free Software Foundation, Inc.
 *      51 Franklin St, Fifth Floor
 *      Boston, MA  02110-1301  USA
 *
 * The license for this software can also likely be found here:
 * http://www.gnu.org/licenses/gpl-2.0.html
 */

/** Add function to the widgets_init hook. */
add_action( 'widgets_init', 'load_wpfa_sample_widget' );
  
/** Function that registers our widget. */
function load_wpfa_sample_widget() {
	register_widget( 'WPFA_Sample_Widget' );
}

class WPFA_Sample_Widget extends WP_Widget {
  
	function WPFA_Sample_Widget() {
	    /** Widget settings. */
  		$widget_ops = array( 'classname' => 'wpfa-sample', 'description' => __( 'Displays some stuff.', 'wpfa-sample' ) );
  		/** Widget control settings. */
  		$control_ops = array( 'width' => 200, 'id_base' => 'wpfa-sample' );
  		/** Create the widget. */
  		$this->WP_Widget( 'wpfa-sample', 'WPFirstAid Sample', $widget_ops, $control_ops );
  	}

    /**
     * Overrides widget method from WP_Widget class
     * This is where the work is done
     *
     * @param   array $args
     * @param   array $instance
     *
     * @var $before_widget string
     * @var $after_widget string
     * @var $before_title string
     * @var $after_title string
     * @var $title string
     * @internal above vars are either drawn from the theme register_sidebar
     * definition, or are drawn from the defaults in WordPress core.
     *
     * @uses    apply_filters
     */
    function widget( $args, $instance ) {
        extract( $args );
        /** User-selected settings. */
        $title        = apply_filters( 'widget_title', $instance['title'] );
        $choices      = $instance['choices'];
        $show_choices = $instance['show_choices'];
        $optionals    = $instance['optionals'];

        /** Before widget (defined by themes). */
        /** @var $before_widget string - defined by theme */
        echo $before_widget;

        /** Widget title */
        if ( $title )
            /**
             * @var $before_title string - defined by theme | WordPress core
             * @var $after_title string - defined by theme | WordPress core
             */
            echo $before_title . $title . $after_title;

        /** Display stuff based on widget settings. */
        if ( $show_choices ) {
            echo $choices . ' is in ... step to your ' . $optionals;
        } else {
            echo __( 'No appointments today.', 'wpfa-sample' );
        }

        /** After widget (defined by themes). */
        echo $after_widget;
    }

    /**
     * Overrides update method from WP_Widget class
     *
     * @package WPFA_Sample
     * @since   0.1
     *
     * @param   array $new_instance
     * @param   array $old_instance
     *
     * @return  array
     */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        /** Strip tags (if needed) and update the widget settings. */
        $instance['title']          = strip_tags( $new_instance['title'] );
        $instance['choices']        = strip_tags( $new_instance['choices'] );
        $instance['show_choices']   = $new_instance['show_choices'];
        $instance['optionals']      = $new_instance['optionals'];

        return $instance;
    }

    /**
     * Overrides form method from WP_Widget class
     *
     * @package WPFA_Sample
     * @since   0.1
     *
     * @param   array $instance
     *
     * @uses    _e
     * @uses    checked
     * @uses    get_field_id
     * @uses    selected
     *
     * @return  string|void
     */
    function form( $instance ) {
        /** Set default widget settings. */
        $defaults = array(
            'title'         => __( 'WPFirstAid Sample', 'wpfa-sample' ),
            'choices'       => __( 'The Doctor', 'wpfa-sample' ),
            'show_choices'  => true,
            'optionals'     => 'right'
        );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
    
		<p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'wpfa-sample' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'choices' ); ?>"><?php _e( 'Make your choices:', 'wpfa-sample' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'choices' ); ?>" name="<?php echo $this->get_field_name( 'choices' ); ?>" value="<?php echo $instance['choices']; ?>" style="width:100%;" />
        </p>
  		
  	    <p>
            <input class="checkbox" type="checkbox" <?php checked( (bool) $instance['show_choices'], true ); ?> id="<?php echo $this->get_field_id( 'show_choices' ); ?>" name="<?php echo $this->get_field_name( 'show_choices' ); ?>" />
            <label for="<?php echo $this->get_field_id( 'show_choices' ); ?>"><?php _e( 'Show your choices?', 'wpfa-sample' ); ?></label>
        </p>
		
 		<p>
			<label for="<?php echo $this->get_field_id( 'optionals' ); ?>"><?php _e( 'Options:', 'wpfa-sample' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'optionals' ); ?>" name="<?php echo $this->get_field_name( 'optionals' ); ?>" class="widefat" style="width:100%;">
                <option <?php selected( 'right', $instance['sort_order'], true ); ?>>right</option>
                <option <?php selected( 'left', $instance['sort_order'], true ); ?>>left</option>
			</select>
		</p>

		<?php
	}
}
/**
 * WPFA Sample Shortcode
 * Adds shortcode functionality
 *
 * @package WPFA_Sample
 * @since   0.2
 *
 * @uses    the_widget
 * @uses    shortcode_atts
 */
function wpfa_sample_shortcode ( $atts ) {
    /** Start capture */
    ob_start();
    /** Using the_widget() to make a plugin template tag */ ?>
    <div class="wpfa-sample-shortcode">
        <?php
        the_widget(
            'WPFA_Sample_Widget',
            $instance = shortcode_atts(
                array(
                    'title'         => __( 'WPFirstAid Sample', 'wpfa-sample' ),
                    'choices'       => __( 'The Doctor', 'wpfa-sample' ),
                    'show_choices'  => true,
                    'optionals'     => 'right',
                ),
                $atts
            ),
            $args = array (
                'before_widget'   => '',
                'before_title'    => '',
                'after_title'     => '',
                'after_widget'    => ''
            ) ); ?>
    </div><!-- .wpfa-sample-shortcode -->
    <?php
    /** End the captured output routine */
    $wpfa_sample_output = ob_get_contents();
    /** Stop capture */
    ob_end_clean();

    return $wpfa_sample_output;
}
/** Register shortcode */
add_shortcode( 'wpfa_sample', 'wpfa_sample_shortcode' );