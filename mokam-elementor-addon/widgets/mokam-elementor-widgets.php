<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Mokam_About_Section extends \Elementor\Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'mkAbout';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'About', 'mokam-widgets' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-info';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'mokamCat' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'mokam-about-section',
			[
				'label' => __( 'About Us', 'mokam-widgets' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		//mokam about us heading
		$this->add_control(
			'mokam-about-heading',
			[
				'label' => __( 'Heading', 'mokam-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default'=>__('We Will Help You To Build Own Business','mokam-widgets'),
				'placeholder' => __( 'About Us Heading', 'mokam-widgets' ),
			]
		);
		// mokam about us content
		$this->add_control(
			'mokam-about-content',
			[
				'label' => __( 'Content', 'mokam-widgets' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default'=>__('Lorem ipsum dolor sit amet, ligula vestibulum nunc dis ipsum, et nam, cras nec lacus amet, ut mauris erat mattis neque a quis.','mokam-widgets'),
				'placeholder' => __( 'About Us Content', 'mokam-widgets' ),
			]
		);		
		// mokam about us video thumbnail
		$this->add_control(
			'mokam-about-video-thumbnail',
			[
				'label' => __( 'Video Thumbnail', 'mokam-widgets' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'mokam-about-video-link',
			[
				'label' => __( 'Youtube Video Link', 'mokam-widgets' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' =>'https://youtu.be/k0lQHHiRLS4',
				'show_external' => false,
				'default' => [
					'url' => 'https://youtu.be/k0lQHHiRLS4',
				]
		
			]
		);


		$this->end_controls_section();
		$this->start_controls_section(
					'style_section',
					[
						'label' => __( 'About Us Styles', 'plugin-name' ),
						'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					]
				);
		$this->start_controls_tabs(
			'style_tabs'
		);
		$this->end_controls_tab();
		$this->end_controls_section();
	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$mokam_ab_heading =  $settings['mokam-about-heading'];

		$mokam_ab_content =  $settings['mokam-about-content'];
		?>

		<section id="about" class="about-sec common-padd">
	      <div class="container">
	        <div class="row align-items-center">
	          <div class="col-lg-6">
	            <article class="art-content wow fadeInUp" data-wow-duration="1000ms" style="visibility: visible; animation-duration: 1000ms; animation-name: fadeInUp;">
	            	<?php if($mokam_ab_heading): ?>
	              		<h3 class="sec-title02"> <?php echo esc_html( $mokam_ab_heading) ; ?></h3>
	          		<?php endif; ?>
	          		<!-- mokam about us content -->
	              <?php if($mokam_ab_content): ?>
	              		<?php echo  $mokam_ab_content ; ?>
	          		<?php endif; ?>
	            </article>
	          </div>
	          <div class="col-lg-6">
	            <figure class="art-img wow flipInY" data-wow-delay="800ms" style="visibility: visible; animation-delay: 800ms; animation-name: flipInY;">
	              <!-- Get image URL -->
				  <img src=" <?php echo esc_url( $settings['mokam-about-video-thumbnail']['url']); ?>" >	
				  <!-- Get Video Link -->
	              <a href="<?php echo esc_url($settings['mokam-about-video-link']['url']); ?>" class="video-play" data-fancybox=""><i class="fa fa-play"></i></a>
	            </figure>
	          </div>
	        </div>
	      </div>
	    </section>

	<?php }

}

