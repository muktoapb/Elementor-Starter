<?php
/**

 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class mukto_slider_wedget extends \Elementor\Widget_Base {


	public function get_name() {
		return 'slider';
	}


	public function get_title() {
		return __( 'Mukto Tesimonial Slider', 'mukto-toolkit' );
	}


	public function get_icon() {
		return 'eicon-post-slider';
	}

	public function get_categories() {
		return [ 'general','mukto' ];
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'mukto-toolkit' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'image',
			[
				'label' => __( 'Avatar', 'mukto-toolkit' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $repeater->add_control(
			'name',
			[
				'label' => __( 'Name', 'mukto-toolkit' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Type your Title here', 'mukto-toolkit' ),
			]
		);

        $repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'mukto-toolkit' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Default description', 'mukto-toolkit' ),
				'placeholder' => __( 'Type your description here', 'mukto-toolkit' ),
			]
		);

        $repeater->add_control(
			'text_content',
			[
				'label' => __( 'Testimonial Text', 'mukto-toolkit' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Default description', 'mukto-toolkit' ),
				'placeholder' => __( 'Type your description here', 'mukto-toolkit' ),
			]
		);
        $this->add_control(
			'slide',
			[
				'label' => __( 'slider List', 'mukto-toolkit' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'slide_settings',
			[
				'label' => __( 'Slides Settings', 'wt-pnw-ex' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'nav',
			[
				'label'        => __( 'Navigation Arrow', 'wt-pnw-ex' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'wt-pnw-ex' ),
				'label_off'    => __( 'Hide', 'wt-pnw-ex' ),
				'return_value' => 'true',
				'default'      => 'true',
			]
		);
		$this->add_control(
			'dots',
			[
				'label'        => __( 'Dots', 'wt-pnw-ex' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'wt-pnw-ex' ),
				'label_off'    => __( 'Hide', 'wt-pnw-ex' ),
				'return_value' => 'true',
				'default'      => 'true',
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label'        => __( 'Auto Play', 'wt-pnw-ex' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'wt-pnw-ex' ),
				'label_off'    => __( 'No', 'wt-pnw-ex' ),
				'return_value' => 'true',
				'default'      => 'true',
			]
		);
		$this->add_control(
			'loop',
			[
				'label'        => __( 'Loop', 'wt-pnw-ex' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'wt-pnw-ex' ),
				'label_off'    => __( 'No', 'wt-pnw-ex' ),
				'return_value' => 'true',
				'default'      => 'true',
			]
		);
		$this->add_control(
			'mouseDrag',
			[
				'label'        => __( 'Mouse Drag', 'wt-pnw-ex' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'wt-pnw-ex' ),
				'label_off'    => __( 'No', 'wt-pnw-ex' ),
				'return_value' => 'true',
				'default'      => 'true',
			]
		);
		$this->add_control(
			'touchDrag',
			[
				'label'        => __( 'Touch Drag', 'wt-pnw-ex' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'wt-pnw-ex' ),
				'label_off'    => __( 'No', 'wt-pnw-ex' ),
				'return_value' => 'true',
				'default'      => 'true',
			]
		);
		$this->add_control(
			'autoplayTimeout',
			[
				'label'     => __( 'Autoplay Timeout', 'wt-pnw-ex' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '5000',
				'condition' => [
					'autoplay' => 'true',
				],
				'options' => [
					'5000'  => __( '5 Seconds', 'wt-pnw-ex' ),
					'10000' => __( '10 Seconds', 'wt-pnw-ex' ),
					'15000' => __( '15 Seconds', 'wt-pnw-ex' ),
					'20000' => __( '20 Seconds', 'wt-pnw-ex' ),
					'25000' => __( '25 Seconds', 'wt-pnw-ex' ),
					'30000' => __( '30 Seconds', 'wt-pnw-ex' ),
				],
			]
		);
		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		
		if( $settings['slide'] ){
			$sliderDynamicId = rand(10, 100000);
			$countSlide      = count($settings['slide']);
			$nav             = $settings['nav'] ? $settings['nav'] : 'false';
			$dots            = $settings['dots'] ? $settings['dots'] : 'false';
			$autoplay        = $settings['autoplay'] ? $settings['autoplay'] : 'false';
			$loop            = $settings['loop'] ? $settings['loop'] : 'false';
			$mouseDrag       = $settings['mouseDrag'] ? $settings['mouseDrag'] : 'false';
			$touchDrag       = $settings['touchDrag'] ? $settings['touchDrag'] : 'false';
			$autoplayTimeout = $settings['autoplayTimeout'] ? $settings['autoplayTimeout'] : '0';
            
            $this->add_render_attribute(
                'slider-wrapper',
                [
                    'class'                 => 'slider_wrapper owl-carousel',
                    'id'                    => 'pnw-slider-'.esc_attr($sliderDynamicId),
					'data-countslide'       => $countSlide,
                    'data-dots'             => $dots,
                    'data-nav'              => $nav,
                    'data-loop'             => $loop,
                    'data-autoplay'         => $autoplay,
                    'data-autoplay-timeout' => $autoplayTimeout,
                    'data-mouse-drag'       => $mouseDrag,
                    'data-touch-drag'       => $touchDrag
                ]
            );
                
			?>

<?php
            ?>
                <div <?php echo $this->get_render_attribute_string('slider-wrapper'); ?>>
                    <?php
			foreach (  $settings['slide'] as $slide ) {
				?>
                    <div class="slider_item">
                        <div class="testimonial_wrapper">
						<div class="slider_image"><?php echo '<img src="' . $slide['image']['url'] . '" alt="avatar">'; ?></div>
                            <div class="slier_text">
								<h2 class="author_name"><?php echo $slide['name']?></h2>
								<h5 class="author_title"><?php echo $slide['title']?></h5>
								<p><?php echo $slide['text_content']?></p>
                            </div>
						</div>
                    </div>
                    <?php }?>
                </div>
                <?php
            }
		?>
<?php
	}

}
?>