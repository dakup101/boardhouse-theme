<?php 
$promo = get_field('promo_category', 'options');
if ($promo['show']=="1") :
    $bg_desktop = $promo['bg_desktop'];
    $bg_mobile = $promo['bg_mobile'];
    $img_1 = $promo['img_2'];
    $img_2 = $promo['img_2'];
    $img_3 = $promo['img_3'];
    $text_top = $promo['text_top'];
    $text_mid = $promo['text_mid'];
    $product = $promo['product'];
    $link = $promo['link'];
?>
<div class="relative overflow-hidden pt-10 lg:pt-20 pb-20 lg:pb-64">
    <div class="container relative z-20 mx-auto flex">
        <div class="xl:w-1/12"></div>
        <div class="w-full lg:w-6/12 ">
            <img src="<?php $bg_mobile ?>" alt="" class="block lg:hidden w-full">
            <div class=" lg:w-10/12 2xl:w-9/12 flex flex-col gap-2 mt-10 mb-10 lg:mt-0 lg:mb-20">
                <span class="text-center lg:text-left text-4xl font-bold"><?php echo $text_top ?></span>
                <span class="text-center lg:text-left"><?php echo $text_mid ?></span>
            </div>
            <div class="w-full flex bg-white gap-1 relative">
                <img src="<?php echo $img_1?>" alt="" class="w-1/3 h-auto shrink-0">
                <img src="<?php echo $img_2 ?>" alt="" class="w-1/3 h-auto shrink-0">
                <img src="<?php echo $img_3 ?>" alt="" class="w-1/3 h-auto shrink-0">
                <div
                    class="absolute -bottom-16 left-1/2 -translate-x-1/2 w-full flex items-center justify-center flex-col gap-3">
                    <a href="<?php get_post_permalink($product) ?>"
                        class="flex items-center justify-center gap-3 uppercase bg-dark font-bold text-white px-5 text-lg py-3 w-10/12 sm:w-3/5 hover:bg-green transition-all">
                        Dodaj do koszyka
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                            <path
                                d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                        </svg>
                    </a>
                    <a href="<?php $link ?>"
                        class="underline-offset-1 underline text-orange font-light hover:text-green transition-all">Zobacz
                        wszystkie produkty</a>
                </div>
            </div>
        </div>
    </div>
    <img src="<?php echo $bg_desktop ?>" alt=""
        class="hidden lg:block min-w-full min-h-full absolute object-cover left-0 top-0 z-10">
</div>
<?php endif; ?>