<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}



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
        return 'ym_carrousel';
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
			'effect',
			[
				'label' => esc_html__( 'סגנון מעבר', 'ym-carrousel' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'cards',
				'options' => [
					'cards' => esc_html__( 'כרטיס', 'ym-carrousel' ),
					'cube' => esc_html__( 'קוביה', 'ym-carrousel' ),
					'creative'  => esc_html__( 'סיבוב', 'ym-carrousel' )
				]
			]
		);

        $this->add_control(
            'is_autoplay',
            [
                'label' => __('ניגון אוטומטי', 'ym-carrousel'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('פועל', 'ym-carrousel'),
                'label_off' => __('כבוי', 'ym-carrousel'),
                'return_value' => 'yes',
                'default' => 'off'
            ]
        );
        $this->add_control(
            'delay',
            [
                'label' => __('זמן השהיה (בשניות)', 'ym-carrousel'),
                'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 2,
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

        echo '<div class="swiper-container mySwiper" data-isAutoplay="'. esc_html($settings['is_autoplay']??0).'" data-delay="'. esc_html($settings['delay']).'" data-effect="'. esc_html($settings['effect']).'"><div class="swiper-wrapper">';

        foreach ($settings['cards'] as $card) {
            echo '<div class="swiper-slide" style="background-image: url(' . esc_url($card['image']['url']) . ');background-size: cover;background-position: center;flex-direction: column;">';
            echo '<h2 class="card-title" style="color:' . esc_html($card['title_color']) . ';    text-align: center;">' . esc_html($card['title']) . '</h2>';
            echo '</div>';
        }

        echo '</div></div>';
    }
    protected function _content_template()
    {
        ?>
        <# view.addInlineEditingAttributes('cards', 'repeater' ); #>
            <div class="swiper-container mySwiper" data-isAutoplay="{{settings.is_autoplay}}" data-delay="{{settings.delay}}" data-effect="{{settings.effect}}">
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