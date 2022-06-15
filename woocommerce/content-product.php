<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<?php

$product->get_type() == 'variable' ? $is_variable = true : $is_variable = false;
$is_sale      = false;
$sale         = null;
$price_string = null;
$img_id       = $product->get_image_id();
$img          = wp_get_attachment_image( $img_id, 'large', '', array( "class" => "absolute min-w-full min-h-full object-cover top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10" ) );
$name         = $product->get_name();
$url          = $product->get_permalink();
$manufacturer = get_field( 'manufacturer', $product->get_id() )->name;
if ( $is_variable ) {
	$variations = $product->get_children();
	$counter    = 0;
	$min        = 0;
	$max        = 0;
	foreach ( $variations as $variation_id ) {
		$variation     = wc_get_product( $variation_id );
		$variation_reg = number_format( (float) $variation->get_regular_price(), 2 );
		if ( $variation->get_sale_price() ) {
			$is_sale        = true;
			$variation_sale = (float) $variation->get_sale_price();
			$sale           = floor( ( $variation_reg - $variation_sale ) / $variation_reg * 100 );
			if ( $counter == 0 ) {
				$min = $variation_sale;
				$max = $variation_sale;
			} else {
				if ( $variation_sale < $min ) {
					$min = $variation_sale;
				}
				if ( $variation_sale > $max ) {
					$max = $variation_sale;
				}
			}
		} else {
			if ( $counter == 0 ) {
				$min = $variation_reg;
				$max = $variation_reg;
			} else {
				if ( $variation_reg < $min ) {
					$min = $variation_reg;
				}
				if ( $variation_reg > $max ) {
					$max = $variation_reg;
				}
			}
		}

		$counter ++;
	}
	$price_string = number_format( (float) $min, 2 ) .
	                ' zł - ' . number_format( (float) $max, 2 ) .
	                ' zł';
} else {
	if ( $product->get_sale_price() ) {
		$is_sale      = true;
		$sale         = floor( ( (float) $product->get_regular_price() - (float) $product->get_sale_price() ) / (float) $product->get_regular_price() * 100 );
		$price_string = '<s class="text-gray">' . number_format( (float) $product->get_regular_price(), 2 ) .
		                'zł </s> <span class="text-green">' . number_format( (float) $product->get_sale_price(), 2 ) .
		                'zł </span>';
	}
	if ( ! $price_string ) {
		$price_string = '<span class="w-full text-center">' . number_format( (float) $product->get_regular_price(), 2 ) . ' zł </span>';
	}
}
?>
<div class="border-light-gray relative border flex flex-col h-full">
    <div class="relative w-full h-80 shrink-0 bg-light-gray overflow-hidden">
        <a href="<?php echo $url ?>"
           class="z-20 absolute w-full h-full bg-gray/40 opacity-0 hover:opacity-100 transition-all flex items-center justify-center">
            <span class="px-5 py-2 border-2 border-white text-white hover:bg-white hover:text-dark transition-all uppercase">Dodaj do koszyka</span>
        </a>
		<?php echo $img; ?>
		<?php if ( $is_sale ): ?>
            <span class="bg-green z-30 w-14 h-14 absolute left-4 top-3 rounded-full shadow-light-gray text-white font-bold text-md flex items-center justify-center">
            <?php echo '-' . $sale . '%' ?>
        </span>
		<?php endif; ?>
        <div class="z-30 absolute flex gap-3 top-5 right-3">
            <a href="#"
               class="p-2 rounded-full transition-all hover:text-white hover:bg-orange hover:shadow-light-gray hover:shadow-lg focus:bg-light-gray focus:text-dark"
               data-product="<?php echo $product->get_id(); ?>"
               data-quick_view
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 18 18"
                     class="fill-current h-5 w-5"
                >
                    <path d="M15.01,10.51c-.29,.77-.7,1.47-1.21,2.1l4.08,4.08c.16,.16,.16,.43,0,.59l-.59,.59c-.16,.16-.43,.16-.59,0l-4.08-4.08c-.63,.51-1.33,.92-2.1,1.21-.86,.33-1.78,.51-2.75,.51-2.14,0-4.08-.87-5.48-2.27C.87,11.84,0,9.9,0,7.76S.87,3.68,2.27,2.27C3.68,.87,5.61,0,7.76,0s4.08,.87,5.48,2.27,2.27,3.34,2.27,5.48c0,.97-.18,1.9-.51,2.75h0Zm-11.55,1.54c1.1,1.1,2.62,1.78,4.3,1.78s3.2-.68,4.3-1.78c1.1-1.1,1.78-2.62,1.78-4.3s-.68-3.2-1.78-4.3c-1.1-1.1-2.62-1.78-4.3-1.78s-3.2,.68-4.3,1.78c-1.1,1.1-1.78,2.62-1.78,4.3s.68,3.2,1.78,4.3Z"/>
                </svg>
            </a>
            <a href="#"
               class="p-2 rounded-full transition-all hover:text-white hover:bg-orange hover:shadow-light-gray hover:shadow-lg focus:bg-light-gray focus:text-dark"
               data-product="<?php echo $product->get_id(); ?>"
               data-whishlist_add
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 21.2 18"
                     class="fill-current w-5 h-5"
                >
                    <path d="M17.69,.31c.59,.22,1.09,.55,1.51,.91,.82,.69,1.39,1.54,1.71,2.5,.32,.97,.39,2.05,.2,3.2-.37,2.21-2.85,4.34-5.66,6.74-1.52,1.3-3.14,2.69-4.54,4.19l-.02,.02c-.17,.16-.44,.15-.6-.02-1.39-1.5-3-2.88-4.51-4.18C2.96,11.28,.48,9.14,.11,6.93-.08,5.77-.02,4.68,.29,3.71c.31-.95,.87-1.79,1.69-2.48h0c.42-.37,.92-.7,1.52-.92,.52-.2,1.1-.31,1.74-.31,.96,0,2.04,.27,3.11,.93,.76,.48,1.52,1.16,2.24,2.1,.71-.94,1.47-1.62,2.24-2.1,1.08-.67,2.16-.94,3.13-.94,.64,0,1.21,.12,1.73,.31h0Zm-2.83,11.62c2.29-1.95,4.3-3.66,4.54-5.14,.14-.87,.11-1.71-.13-2.46-.22-.69-.6-1.3-1.16-1.78l-.03-.03c-.3-.26-.63-.47-.99-.6-.35-.13-.73-.2-1.13-.2-.6,0-1.41,.15-2.27,.7-.66,.42-1.36,1.08-2.04,2.07l-.7,1.04s-.07,.09-.12,.12c-.2,.13-.46,.08-.59-.12l-.71-1.04c-.68-1-1.37-1.66-2.03-2.08-.86-.55-1.65-.7-2.25-.7h0c-.4,0-.79,.07-1.14,.21-.36,.14-.7,.34-.98,.59h0c-.58,.49-.96,1.11-1.18,1.8-.23,.75-.27,1.6-.12,2.48,.25,1.5,2.28,3.23,4.6,5.22l.4,.34c.69,.59,1.39,1.19,2.06,1.78,.58,.52,1.15,1.05,1.71,1.6,.56-.55,1.14-1.09,1.71-1.6,.66-.59,1.37-1.19,2.06-1.78l.49-.42Z"/>
                </svg>
            </a>
        </div>
    </div>
    <div class="px-10 py-5 flex h-full flex-col gap-3 justify-between">
        <span class="text-center block w-full text-gray font-light"><?php echo $manufacturer ?></span>
        <span class="text-center block w-full font-medium text-lg"><?php echo $name ?></span>
        <span class="flex font-medium text-lg <?php echo ! $is_variable ? 'justify-between' : 'justify-center' ?>"><?php echo $price_string; ?></span>
    </div>
</div>
