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

class mokam_our_team extends Widget_Base
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
        return 'mokam-our-team';
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
        return __('Our Team', 'mokam-widgets');
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
        return 'fa fa-users';
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
                    'label' => __('Our Team', 'mokam-widgets'),
                ]
            );

            $this->add_control(
                'mokam-our-team-heading',
                [
                    'label' => esc_html__('Team Title', 'mokam-widgets'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => 'Our Team',
                ]
            );
            $this->add_control(
                'mokam-our-team-description',
                [
                    'label' => esc_html__('Team Description', 'mokam-widgets'),
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'default' => 'Venenatis nullam habitasse suspendisse felis. Leo wisi, gravida quis, mollis dignis vestibulum sollicitudin elit commodo aliquam. Ultrices at vel semper fusce.',
                ]
            );

            $repeater = new \Elementor\Repeater();

        		$repeater->add_control(
        			'mokam_team_image', [
        				'label' => __( 'Member Image', 'plugin-domain' ),
        				'type' => \Elementor\Controls_Manager::MEDIA,
        				'label_block' => true,
                'default' => [
        					'url' => \Elementor\Utils::get_placeholder_image_src(),
        				],
        			]
        		);

        		$repeater->add_control(
        			'mokam_member_name', [
        				'label' => __( 'Member Name', 'plugin-domain' ),
        				'type' => \Elementor\Controls_Manager::TEXT,
        				//'default' => __( 'John Doe' , 'plugin-domain' ),
        				'show_label' => true,
                'label_block' => true,
        			]
        		);
            $repeater->add_control(
        			'mokam_member_social_link', [
        				'label' => __( 'Social Link', 'plugin-domain' ),
        				'type' => \Elementor\Controls_Manager::ICON,
                'include' => [
                  'fa fa-facebook',
                  'fa fa-flickr',
                  'fa fa-google-plus',
                  'fa fa-instagram',
                  'fa fa-linkedin',
                  'fa fa-pinterest',
                  'fa fa-reddit',
                  'fa fa-twitch',
                  'fa fa-twitter',
                  'fa fa-vimeo',
                  'fa fa-youtube',
                ],
                'default' => 'fa fa-facebook',
        				'show_label' => true,
                'label_block' => true
        			]
        		);
            $repeater->add_control(
        			'mokam_member_status', [
        				'label' => __( 'Member Status', 'plugin-domain' ),
        				'type' => \Elementor\Controls_Manager::TEXT,
        				'default' => __( 'Administrator' , 'plugin-domain' ),
        				'show_label' => true,
                'label_block' => true,
        			]
        		);


        		$this->add_control(
        			'Mokam_team_repeater',
        			[
        				'label' => __( 'Team Members', 'plugin-domain' ),
        				'type' => \Elementor\Controls_Manager::REPEATER,
        				'fields' => $repeater->get_controls(),
        				'default' => [
        					[


        						'mokam_member_name' => __( 'Team Member', 'plugin-domain' ),
        						'mokam_member_social_link' => __( 'Memeber Social Link', 'plugin-domain' ),
        						'mokam_member_status' => __( 'Meber Status', 'plugin-domain' ),

        					]

        				],
        				'title_field' => '{{{ mokam_member_name }}}',
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

        <section id="team" class="team-sec common-padd">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <div class="section-head">
                    <h3 class="section-title"><?php echo esc_html($settings['mokam-our-team-heading'] ); ?></h3>
                    <p class="section-subtitle"><?php echo esc_html($settings['mokam-our-team-description'] ); ?></p>
                  </div>
                </div>
              </div>
              <div class="row">
                <?php
                $settings = $this->get_settings_for_display();

            if ( $settings['Mokam_team_repeater'] ) {

              foreach (  $settings['Mokam_team_repeater'] as $item ) { ?>
                <!-- <div class="team-caro owl-carousel"> -->
                  <div class="col-md-4">
                    <div class="team-member">
                      <figure class="memb-img">
                        <img src="<?php echo esc_url( $item['mokam_team_image']['url'] ); ?>" alt="">
                      </figure>
                      <div class="mbr-info">
                        <div class="memb-socials">
                          <!-- <a href="#" class="cls"><i class="fa fa-plus"></i></a> -->
                          <a href="#"><i class="<?php echo esc_html( $item['mokam_member_social_link'] ); ?>"></i></a>
                          <a href="#"><i class="fa fa-pinterest-p"></i></a>
                          <a href="#"><i class="fa fa-linkedin"></i></a>
                        </div>
                        <h5><?php echo esc_html( $item['mokam_member_name'] ); ?></h5>
                        <span><?php echo esc_html( $item['mokam_member_status'] ); ?></span>
                      </div>
                    </div>
                  </div>
                <!-- </div> -->
            <?php  }

            }?>

              </div>
            </div>
          </section>


        </div>
      </div>
    </section>

    <?php
    }

    }
