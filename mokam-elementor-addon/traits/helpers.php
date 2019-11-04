<?php
namespace mokam_elementor_addons\traits;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;

trait Helper
{



    /**
     * Get Contact Form 7 [ if exists ]
     */
    public function mokam_select_contact_form()
    {
        $options = array();

        if (function_exists('wpcf7')) {
            $wpcf7_form_list = get_posts(array(
                'post_type' => 'wpcf7_contact_form',
                'showposts' => 999,
            ));
            $options[0] = esc_html__('Select a Contact Form', 'mokam-widgets');
            if (!empty($wpcf7_form_list) && !is_wp_error($wpcf7_form_list)) {
                foreach ($wpcf7_form_list as $post) {
                    $options[$post->ID] = $post->post_title;
                }
            } else {
                $options[0] = esc_html__('Create a Form First', 'mokam-widgets');
            }
        }
        return $options;
    }


    /**
     * Get posts [ if exists ]
     */


    public function mokam_blog_posts()
    {
        $posts = get_posts([
            'post_type' => 'post',
            'post_style' => 'all_types',
            'post_status' => 'publish',
            'posts_per_page' => '3',
        ]);

        if (!empty($posts)) {
            return wp_list_pluck($posts, 'post_title', 'ID');
        }

        return [];
    }
}
