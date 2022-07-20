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
            $('body').on( 'updated_wc_div', function(){
                console.log('--- updated_wc_div ---');
                document.dispatchEvent(
                    new CustomEvent('updated_wc_div')
                );
            });
        })(jQuery);
    </script>
    <?php
}