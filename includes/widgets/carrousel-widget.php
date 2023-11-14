<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Register the widget preview script
 */
// function your_widget_register_preview_script() {
//     wp_enqueue_script(
//         'your-widget-preview-script', // Script handle
//         plugin_dir_url( __FILE__ ) . '/js/swiper.js', // Script source
//         // array( 'jquery', 'elementor-editor' ), // Dependencies
//         false, // Version number
//         true // Load script in footer
//     );
// }

// add_action( 'elementor/editor/after_enqueue_scripts', 'your_widget_register_preview_script' );


class Ym_Elementor_Carrousel_Widget extends \Elementor\Widget_Base
{


    public function get_script_depends()
    {
        return ['ym_carrousel-script-1'];
    }

    public function get_style_depends()
    {
        return ['widget-style-1'];
    }


    public function get_name()
    {
        return 'carrousel';
    }

    public function get_title()
    {
        return esc_html__('קרוסלה מיוחדת', 'ym-carrousel');
    }

    public function get_icon()
    {
        return 'eicon-carousel-loop';
    }

    public function get_categories()
    {
        return ['general'];
    }

    public function get_keywords()
    {
        return ['carrousel', 'קרוסלה'];
    }


    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('תוכן', 'ym-carrousel'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .card-title',
            ]
        );

        $this->add_control(
            'is_autoplay',
            [
                'label' => __('ניגון אוטומטי', 'ym-carrousel'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('פועל', 'ym-carrousel'),
                'label_off' => __('כבוי', 'ym-carrousel'),
                'default' => 'מם'
            ]
        );

        $this->add_control(
            'cards',
            [
                'label' => __('כרטיסים', 'ym-carrousel'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'image',
                        'label' => __('תמונת רקע הכרטיס', 'ym-carrousel'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                        'dynamic' => ['active' => true],
                    ],
                    [
                        'name' => 'color',
                        'label' => __('צבע הכרטיס', 'ym-carrousel'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'dynamic' => ['active' => true],
                    ],
                    [
                        'name' => 'title',
                        'label' => __('כותרת', 'ym-carrousel'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __('כותרת הכרטיס', 'ym-carrousel'),
                        'label_block' => true,
                        'dynamic' => ['active' => true],
                    ],
                    [
                        'name' => 'title_color',
                        'label' => __('צבע כותרת', 'ym-carrousel'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'dynamic' => ['active' => true],
                    ]
                ],
                'title_field' => '{{{ title }}}',
            ]
        );


        $this->add_control(
            'height',
            [
                'label' => esc_html__('גובה', 'ym-carrousel'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 300,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mySwiper' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'width',
            [
                'label' => esc_html__('רוחב', 'ym-carrousel'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 300,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mySwiper' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_tab();

    }


    protected function render()
    {
        $settings = $this->get_settings_for_display();

        echo '<div class="swiper-container mySwiper"><div class="swiper-wrapper">';

        foreach ($settings['cards'] as $card) {
            echo '<div class="swiper-slide" style="background-image: url(' . esc_url($card['image']['url']) . ');background-size: cover;background-position: center;flex-direction: column;">';
            // echo '<div class="elementor-custom-image"><img src="'. .'" /></div>';
            echo '<h2 class="card-title" style="color:' . esc_html($card['title_color']) . ';    text-align: center;">' . esc_html($card['title']) . '</h2>';
            echo '</div>';
        }

        echo '</div></div>';
    }
    protected function _content_template()
    {
        ?>
        <# view.addInlineEditingAttributes('cards', 'repeater' ); #>
            <div class="swiper-container mySwiper">
                <div class="swiper-wrapper">

                    <# _.each(settings.cards, function(card) { #>
                        <div class="swiper-slide"
                            style="background-image: url({{card.image.url}});background-size: cover;background-position: center;flex-direction: column;">
                            <h2 class="card-title" style="color:{{card.title_color}};text-align: center;">{{card.title}}
                            </h2>
                            <# } ); #>
                        </div>
                </div>
                <?php
    }

}