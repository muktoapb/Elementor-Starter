<?php
/**

 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class mukto_acordian_wedget extends \Elementor\Widget_Base {


	public function get_name() {
		return 'content';
	}


	public function get_title() {
		return __( 'Mukto Accordion', 'mukto-toolkit' );
	}


	public function get_icon() {
		return 'eicon-accordion';
	}

	public function get_categories() {
		return [ 'general','mukto' ];
	}


	protected function register_controls() {

		$this->start_controls_section(
			'accordion_section',
			[
				'label' => __( 'Accordion Items', 'mukto-toolkit' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label' => __( 'Logo', 'mukto-toolkit' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'mukto-toolkit' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Title here', 'mukto-toolkit' ),
			]
		);
		$repeater->add_control(
			'text_content',
			[
				'label' => __( 'Text Content', 'mukto-toolkit' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'placeholder' => __( 'Type your description here', 'mukto-toolkit' ),
			]
		);

		$this->add_control(
			'accordion',
			[
				'label' => __( 'Accordian List', 'mukto-toolkit' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);
		$this->end_controls_section();

	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		
		if( $settings['accordion'] ){
			?>

<div class="accordion_area">
    <?php
			foreach (  $settings['accordion'] as $item ) {
				?>
    <div class="accordian_item">
        <div class="accordion">
            <div class="acor_icon"><?php echo '<img src="' . $item['image']['url'] . '" alt="icon">'; ?></div>
            <div class="acor_title"><?php echo $item['title']?></div>
            <div class="acor_arrow"><i class="fa fa-angle-down"></i></div>
        </div>
        <div class="panel">
            <?php echo $item['text_content']?>
        </div>
    </div>
    <?php }?>
    <!-- end loop -->
</div>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
</script>
<?php
		}
		// end Repeater check 
	}

}
?>