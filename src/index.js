import Swiper from 'swiper';
import { EffectCards, Autoplay ,EffectCube,EffectCreative} from 'swiper/modules'


class ContentToggleButton extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    return {
      selectors: {
        swiper: '.mySwiper'
      },
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings('selectors');
    return {
      $swiper: this.$element.find(selectors.swiper),
    };
  }

  bindEvents() {
    this.elements.$swiper.ready(this.onSwiperLoad.bind(this));
    // this.elements.$swiper.on('DOMSubtreeModified',this.onSwiperLoad.bind(this));
  }

  onSwiperLoad(event) {
    const isAutoplay = this.elements.$swiper.data("isautoplay")
    const delay = +this.elements.$swiper.data("delay")
    const effect = this.elements.$swiper.data("effect")
    console.log(effect);
    if(effect==='creative'){
      this.elements.$swiper.css('overflow', 'hidden');
    }
    var swiper = new Swiper(".mySwiper", {
      effect: effect,
      modules: [EffectCards, Autoplay,EffectCube,EffectCreative],
      grabCursor: true,

      creativeEffect: {
        prev: {
          shadow: true,
          translate: ["-125%", 0, -800],
          rotate: [0, 0, -90],
        },
        next: {
          shadow: true,
          translate: ["125%", 0, -800],
          rotate: [0, 0, 90],
        },
      },
      autoplay: isAutoplay.length?{
        delay:delay*1000
      }:false
    });
  }
}



jQuery(window).on('elementor/frontend/init', () => {
  const addHandler = ($element) => {
    elementorFrontend.elementsHandler.addHandler(ContentToggleButton, {
      $element,
    });
  };

  elementorFrontend.hooks.addAction('frontend/element_ready/ym_carrousel.default', addHandler);
});