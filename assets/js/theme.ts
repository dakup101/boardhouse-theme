// Loaded
console.log('--- Site Loaded ---')
import Swiper, { Pagination, Navigation } from 'swiper';
import 'swiper/css';
// import 'swiper/css/navigation';
// import 'swiper/css/pagination';
// Rendered
window.addEventListener('DOMContentLoaded', ()=>{
    console.log('--- Site Rendered ---');
    const hero = new Swiper('.hero', {
        modules: [Pagination, Navigation],
        direction: "horizontal",
        pagination: {
            el: '.hero__pagination',
            clickable: true,
            renderBullet: function (index, className) {
                if (index.toString().length<2) return '<span class="' + className + '">0' + (index + 1) + "</span>";
                return '<span class="' + className + '">' + (index + 1) + "</span>";
            }
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    })
})