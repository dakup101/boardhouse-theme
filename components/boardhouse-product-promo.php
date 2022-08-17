<?php 
$promo = get_field('promo_product_kopia', 'options');
if ($promo['show']=="1") :
    $bg_desktop = $promo['bg_desktop'];
    $bg_mobile = $promo['bg_mobile'];
    $text_top = $promo['text_top'];
    $text_mid = $promo['text_mid'];
    $text_bot = $promo['text_bot'];
    $product = $promo['product'];
?>
<div class="product-promo relative py-5 md:py-24 bg-light-gray overflow-hidden">
    <img src="<?php echo $bg_desktop; ?>"
        class="hidden md:block min-h-full min-w-full absolute top-0 left-0 object-cover z-10" alt="">
    <img src="<?php echo $bg_mobile; ?>"
        class="block md:hidden min-h-full min-w-full absolute top-0 left-0 object-cover z-10" alt="">
    <div class="container mx-auto relative items-center flex-col md:flex-row flex z-20 text-white">
        <div class="w-full md:w-2/5 mt-10 flex justify-center md:justify-end items-center">
            <div class="md:max-w-fit flex flex-col items-center gap-5 justify-center">
                <span class="uppercase tracking-wider text-center leading-4"><?php echo $text_top; ?></span>
                <span class="main-text uppercase text-center"><?php echo $text_mid; ?></span>
                <span class="uppercase tracking-wider text-center leading-4"><?php echo $text_bot; ?></span>
                <a href="<?php get_post_permalink($product) ?>"
                    class="px-5 py-2 border-2 border-white mt-10 hover:bg-white hover:text-dark transition-all uppercase">Dodaj
                    do koszyka</a>
            </div>
        </div>
        <div class="w-full md:w-2/5 py-10 md:pl-8 flex justify-center">
            <div class="w-80 p-5 bg-white text-dark shadow-lg">
                <?php
                wp_reset_postdata();
	            $args = array(
		            'post_type' => 'product',
		            'posts_per_page' => 1,
                    'post__in' => array($product)
	            );
	            $loop = new WP_Query( $args );
	            if ( $loop->have_posts() ) {
		            while ( $loop->have_posts() ) : $loop->the_post();
			            ?>
                <div class="no-border">
                    <?php wc_get_template_part( 'content', 'product' ); ?>
                </div>
                <?php
		            endwhile;
	            } else {
		            echo __( 'No products found' );
	            }
	            // wp_reset_postdata();
	            ?>
            </div>
        </div>
        <div class="hidden md:block w-1/5 py-10"></div>
    </div>
</div>
<?php endif; ?>