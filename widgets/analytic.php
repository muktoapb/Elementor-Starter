<?php
/**

 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embeddable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class mukto_analytic_wedget extends \Elementor\Widget_Base {


	public function get_name() {
		return 'analytic';
	}


	public function get_title() {
		return __( 'Analyze Search Bar', 'mukto-toolkit' );
	}


	public function get_icon() {
		return 'eicon-site-search';
	}

	public function get_categories() {
		return [ 'general','mukto' ];
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'analyze_search',
			[
				'label' => __( 'Content', 'mukto-toolkit' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'placeholder_text',
			[
				'label' => __( 'Placeholder Text', 'mukto-toolkit' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Placeholder text', 'mukto-toolkit' ),
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button text', 'mukto-toolkit' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Search', 'mukto-toolkit' ),
				'placeholder' => __( 'Placeholder text', 'mukto-toolkit' ),
			]
		);
		$this->add_control(
			'apikey',
			[
				'label' => __( 'API Key', 'mukto-toolkit' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Placeholder text', 'mukto-toolkit' ),
			]
		);
		$this->end_controls_section();

	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		

			?>

<div class="analyze_form_area">
    <form id="websiteAudit" class="websiteAuditForm" action="https://yoursite.report/" method="get" name="form1"
        target="_blank"><input id="url" name="url" required="required" type="text" placeholder="<?php echo esc_attr($settings['placeholder_text']); ?>"><input
            name="apikey" type="hidden" value="<?php echo esc_attr($settings['apikey']); ?>"><input id="button" name="button"
            type="submit" value="<?php echo esc_attr($settings['button_text']); ?>"></form>
</div>
<?php
	}

}
?>