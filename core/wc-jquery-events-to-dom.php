<?php
add_action( 'wp_footer', 'trigger_for_ajax_add_to_cart' );
function trigger_for_ajax_add_to_cart() {
    ?>
    <script type="text/javascript">
        (function($){
            $('body').on( 'update_checkout', function(){
                console.log('--- update_checkout ---');
                document.dispatchEvent(
                    new CustomEvent('update_checkout')
                );
            });
            $('body').on( 'updated_checkout', function(){
                console.log('--- updated_checkout ---');
                document.dispatchEvent(
                    new CustomEvent('updated_checkout')
                );
            });
            $('body').on( 'payment_method_selected', function(){
                console.log('--- payment_method_selected ---');
                document.dispatchEvent(
                    new CustomEvent('payment_method_selected')
                );
            });
            $('body').on( 'wc_cart_emptied', function(){
                console.log('--- wc_cart_emptied ---');
                document.dispatchEvent(
                    new CustomEvent('wc_cart_emptied')
                );
            });
            $('body').on( 'updated_wc_div', function(){
                console.log('--- updated_wc_div ---');
                document.dispatchEvent(
                    new CustomEvent('updated_wc_div')
                );
            });
            $('body').on( 'added_to_cart', function(){
                console.log('--- added_to_cart ---');
                document.dispatchEvent(
                    new CustomEvent('added_to_cart')
                );
            });
            $('body').on( 'removed_from_cart', function(){
                console.log('--- removed_from_cart ---');
                document.dispatchEvent(
                    new CustomEvent('removed_from_cart')
                );
            });
        })(jQuery);
    </script>
    <?php
}