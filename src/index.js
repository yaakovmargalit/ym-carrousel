import Swiper from 'swiper';
import { EffectCards ,Autoplay } from 'swiper/modules'
var swiper = new Swiper(".mySwiper", {
    effect: "cards",
    modules:[EffectCards,Autoplay],
    grabCursor: true,
    autoplay:true
  });