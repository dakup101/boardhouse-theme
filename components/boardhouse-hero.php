<?php 
$slider = get_field('Slider'); 
if ($slider) :
?>

<div class="hero overflow-hidden relative">
    <div class="swiper-wrapper z-10">
        <?php foreach ($slider as $slide) : ?>
        <a href="<?php echo $slide['link']; ?>" class="swiper-slide">
            <img src="<?php echo $slide['desktop'] ?>" alt="" class="w-full hidden sm:block" loading="lazy">
            <img src="<?php echo $slide['mobile'] ?>" alt="" class="w-full block sm:hidden" loading="lazy">
        </a>
        <?php endforeach; ?>
    </div>
    <div
        class="hero__nav absolute left-1/2 bottom-5 sm:bottom-10 -translate-x-1/2 z-20 text-white flex gap-4 items-center">
        <button class="hero__arrow relative swiper-button-prev">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="rotate-180 fill-current w-4 h-4">
                <path d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z" />
            </svg>
        </button>
        <div class="hero__arrow hero__pagination flex gap-4 items-center"></div>
        <button class="swiper-button-next">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current w-4 h-4">
                <path d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z" />
            </svg>
        </button>
    </div>
</div>

<?php endif; ?>