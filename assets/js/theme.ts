// Loaded
console.log('--- Site Loaded ---')
import Swiper, { Pagination, Navigation } from 'swiper';
import 'swiper/css';
// import 'swiper/css/navigation';
// import 'swiper/css/pagination';
// Rendered
window.addEventListener('DOMContentLoaded', ()=>{
    console.log('--- Site Rendered ---');
    // Main Slider
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
    // Detect product carousels and make them Swiper
    const buildCarousels = el => {
        let carouselId = el.dataset.slider;
        let container = '.product-carousel-' + carouselId;
        let paginationContainer = '.carousel-pagination-' + carouselId;
        console.log(container);
        const test = new Swiper(container, {
            modules: [Pagination],
            direction: "horizontal",
            slidesPerView: 6,
            slidesPerGroup: 6,
            loop: false,
            spaceBetween: 30,
            pagination: {
                el: paginationContainer,
                clickable: true,
                renderBullet: function (index, className) {
                    return '<span class="transition-all hover:cursor-pointer ' + className + '"></span>';
                }
            }
        })
    }
    let carousels = document.querySelectorAll('.product-carousel');
    carousels.forEach(carousel => buildCarousels(carousel));
})