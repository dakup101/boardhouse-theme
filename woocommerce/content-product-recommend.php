<?php
global $product;
$product->get_type() == 'variable' ? $is_variable = true : $is_variable = false;
$is_sale      = false;
$sale         = null;
$price_string = null;
$img_id       = $product->get_image_id();
$img          = wp_get_attachment_image( $img_id, 'large', '', array( "class" => "absolute min-w-full min-h-full object-cover top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10" ) );
$name         = $product->get_name();
$url          = $product->get_permalink();
$manufacturer = $product->get_attribute('pa_marka');
if ( $is_variable ) {
	$variations = $product->get_children();
	$counter    = 0;
	$min        = 0;
	$max        = 0;
	foreach ( $variations as $variation_id ) {
		$variation     = wc_get_product( $variation_id );
		$variation_reg = str_replace(',', '', number_format( (float) $variation->get_regular_price(), 2 ));
		if ( $variation->get_sale_price() ) {
			$is_sale        = true;
			$variation_sale = str_replace(',', '', number_format((float) $variation->get_sale_price(), 2));
			$sale           = floor( ( (float) $variation_reg - (float) $variation_sale ) / (float) $variation_reg * 100 );
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
    if ($min == $max) $price_string = number_format( (float) $min, 2 ) . ' zł';
} else {
	if ( $product->get_sale_price() ) {
		$is_sale      = true;
		$sale         = floor( ( (float) $product->get_regular_price() - (float) $product->get_sale_price() ) / (float) $product->get_regular_price() * 100 );
		$price_string = '<s class="text-gray">' . str_replace(',', '', number_format( (float) $product->get_regular_price(), 2 )) .
		                'zł </s> <span class="text-green">' . str_replace(',', '', number_format( (float) $product->get_sale_price(), 2 )) .
		                'zł </span>';
	}
	if ( ! $price_string ) {
		$price_string = '<span class="w-full text-center">' . str_replace(',', '', number_format( (float) $product->get_regular_price(), 2 )) . ' zł </span>';
	}
}
?>
<div class="border-light-gray relative border flex flex-col h-full p-5">
    <div class="flex items-center gap-6">
        <div class="w-4/5 flex flex-col gap-1">
            <span class="font-bold text-lg"><?php echo $name ?></span>
            <div class="font-bold text-lg text-orange"><?php echo $price_string ?></div>
            <a target="_blank" class="underline text-green font-light" href="<?php echo $url ?>">specyfikacja</a>
        </div>
        <div class="w-28 h-28 overflow-hidden relative">
            <?php echo $img ?>
        </div>
    </div>
    <?php if ($is_variable) : ?>
    <div class="flex flex-wrap gap-3 mt-5">
        <?php $variations = $product->get_children(); ?>
        <?php foreach ($variations as $variation_id) : ?>
            <?php
            $variation = wc_get_product($variation_id);
            $name = $variation->get_name();
            $term = explode(' - ', $name)[1];
            $variation_url = $variation->get_permalink();
            ?>
            <a class="px-4 py-2 border border-light-gray hover:border-green hover:bg-green hover:text-white transition-all"
                href="<?php echo $variation_url ?>"
                target="_blank"
            >
                <?php echo $term ?>
            </a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
