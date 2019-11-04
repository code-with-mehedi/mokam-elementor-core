<?php
//define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
include_once ( MY_PLUGIN_PATH . '../traits/helpers.php');

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Group_Control_Background as Group_Control_Background;
use \Elementor\Group_Control_Border as Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Scheme_Typography as Scheme_Typography;
use \Elementor\Widget_Base as Widget_Base;

class mokam_post_widgets extends Widget_Base
{
 use \mokam_elementor_addons\traits\Helper;
    /**
     * Retrieve contact form 7 widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
   public function get_name()
    {
        return 'mokam-posts-widgets';
    }

    /**
     * Retrieve contact form 7 widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Post Grid', 'mokam-widgets');
    }

    /**
     * Retrieve the list of categories the contact form 7 widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['mokamCat'];
    }

    /**
     * Retrieve contact form 7 widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'fa fa-th';
    }

    /**
     * Register contact form 7 widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @access protected
     */
    protected function _register_controls()
    {

        /*-----------------------------------------------------------------------------------*/
        /*    CONTENT TAB
        /*-----------------------------------------------------------------------------------*/

            /**
             * Content Tab: Contact Form
             * -------------------------------------------------
             */
            $this->start_controls_section(
                'section_info_box',
                [
                    'label' => __('Post Grid', 'mokam-widgets'),
                ]
            );

            $this->add_control(
                'mokam-post-grid-heading',
                [
                    'label' => esc_html__('Title', 'mokam-widgets'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => 'Latest news',
                ]
            );
            $this->add_control(
                'mokam-post-short-description',
                [
                    'label' => esc_html__('Short Description', 'mokam-widgets'),
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'default' => 'Venenatis nullam habitasse suspendisse felis. Leo wisi, gravida quis, mollis dignis vestibulum sollicitudin elit commodo aliquam. Ultrices at vel semper fusce.',
                ]
            );
            $this->add_control(
                'mokam-post-list',
                [
                    'label' => esc_html__('Posts Per Page', 'mokam-widgets'),
                    'type' => Controls_Manager::NUMBER,
                    'label_block' => false,
                    'default' => '3',
                ]
            );
            $this->add_control(
                'mokam-read-more-btn',
                [
                    'label' => esc_html__('Read More Button Text', 'mokam-widgets'),
                    'type' => Controls_Manager::TEXT,
                    'default'=>'Read More',
                    'label_block' => true,
                ]
            );

            $this->end_controls_section();


    }

    /**
     * @access protected
     */
    protected function render()
    {


        $settings = $this->get_settings_for_display();
        ?>
        <section id="blog" class="blog-sec common-padd">
              <div class="container">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="section-head">
                      <h3 class="section-title"><?php echo esc_html($settings['mokam-post-grid-heading']); ?></h3>
                      <p class="section-subtitle"><?php echo esc_html($settings['mokam-post-short-description']); ?></p>
                    </div>
                  </div>
                </div>
                <div class="row row-eq-height">

              <?php
              global $post;
              $args = array( 'numberposts' => $settings['mokam-post-list'],);
              $myposts = get_posts( $args );
              foreach( $myposts as $post ) :  setup_postdata($post);
                ?>

                <div class="col-lg-4">
                  <div class="single-post">
                    <figure class="post-img post-carousel owl-carousel owl-loaded owl-drag">
                        <?php the_post_thumbnail(); ?>
                    </figure>
                    <div class="post-body">
                      <div class="post-meta">
                        <a href="<?php the_author_link() ?>"><i class="fa fa-user-o"></i> by <?php the_author(); ?></a>
                        <a href="#"><i class="fa fa-clock-o"></i> <?php echo human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ).' '.__( 'ago' ); ?></a>
                      </div>
                      <h4><a href="<?php the_permalink( ); ?>"><?php the_title(); ?></a></h4>
                        <?php the_excerpt(); ?>
                      <a href="<?php the_permalink(); ?>" class="read-more"><?php echo $settings['mokam-read-more-btn']; ?></a>
                    </div>
                  </div>
                </div>
          <?php endforeach; wp_reset_postdata();?>

        </div>
      </div>
    </section>
    <?php
    }

    }
