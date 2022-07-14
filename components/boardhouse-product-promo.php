<div class="product-promo relative py-24 bg-light-gray overflow-hidden">
    <div class="container mx-auto relative flex z-20 text-white">
        <div class="w-2/5 mt-10 flex justify-end items-center">
            <div class="max-w-fit flex flex-col items-center gap-2 justify-center">
                <span class="uppercase tracking-wider leading-4">Odkryj w sobie wiosnę</span>
                <span class="main-text uppercase">FRUGAL IMPULSE</span>
                <span class="uppercase tracking-wider leading-4">SEZOWONA WYPRZEDAŻ 50% OFF</span>
                <a href="#"
                   class="px-5 py-2 border-2 border-white mt-10 hover:bg-white hover:text-dark transition-all uppercase"
                >Dodaj do koszyka</a>
            </div>
        </div>
        <div class="w-2/5 py-10 pl-8 flex justify-center">
            <div class="w-80 p-5 bg-white text-dark shadow-lg">
	            <?php
                wp_reset_postdata();
	            $args = array(
		            'post_type' => 'product',
		            'posts_per_page' => 1,
                    'post__in' => array(46)
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
	            wp_reset_postdata();
	            ?>
            </div>
        </div>
        <div class="w-1/5 py-10"></div>
    </div>
    <img src="<?php echo THEME_IMG . '/banner.png'?>"
         class="min-h-full min-w-full absolute top-0 left-0 object-cover z-10"
         alt="">
</div>