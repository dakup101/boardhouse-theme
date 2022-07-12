<?php
global $post;
global $product;
$id = $post->ID;
$attrs = $product->get_attributes();
$attrs['pa_dla-kogo'] ? $is_for = $attrs['pa_dla-kogo'] : $is_for = null;
$attrs['pa_rocznik'] ? $is_from = $attrs['pa_rocznik'] : $is_from = null;
?>

<div class="grid grid-cols-2 mb-5 mt-5">
    <div class="lefty flex flex-col gap-10">
        <?php if (!empty($is_for)) : ?>
        <div class="flex flex-col gap-2">
            <span class="uppercase text-sm font-bold">Dla kogo</span>
            <div class="flex gap-3 flex-wrap">
                <?php foreach( wc_get_product_terms( $product->get_id(), 'pa_dla-kogo' ) as $attribute ) : ?>
                <div>

                    <img class="h-8 w-auto" src="<?php echo get_field('img', $attribute); ?>"
                        alt="<?php echo $attribute->name; ?>">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        <?php if (!empty($is_from)) : ?>
        <div class="flex flex-col gap-1">
            <span class="uppercase text-sm font-bold">Rocznik</span>
            <img src="<?php echo THEME_IMG . '/calendar.svg' ?>" alt="" class="h-8 w-8">
            <span class="text-sm font-light">
                <?php
                    $is_from_vals = array();
                    foreach( wc_get_product_terms( $product->get_id(), 'pa_rocznik' ) as $attribute ){
	                    $is_from_vals[] = $attribute->name;
                    }
                    echo implode(', ',  $is_from_vals);
                    ?>
            </span>
        </div>
        <?php endif; ?>
    </div>
    <div class="righty  flex flex-col gap-5">
        <?php foreach ($attrs as $attr) : ?>
        <?php
                $term_name = $attr->get_name();
	            $term_label = wc_attribute_label($term_name);
	            $terms = null;
	            $term_desc = null;
                $has_desc = false;
                $term_items = array();
	            if (!is_not_hidden_attr($term_name)) { $terms = get_the_terms($post, $term_name); }
                if ($terms) {
                    foreach ($terms as $term) {
                        
                        $term_items[] = $term->name;
	                    if (!empty($term->description)) {  $has_desc = true; }
                    }
                }
            ?>
        <?php if (!is_not_hidden_attr($term_name)) : ?>
        <div class="flex flex-col gap-1 relative <?php if ( $has_desc ) echo 'has-tooltip' ?>">
            <span class="uppercase text-sm font-bold w-full flex gap-4 items-center ">
                <?php echo $term_label ?>
                <?php if ( $has_desc ) : ?>
                <img src="<?php echo THEME_IMG . '/info.svg' ?>" alt="" class="h-3 mb-1 cursor-pointer"
                    data-tooltip_trigger>
                <?php endif; ?>
            </span>
            <span class="text-sm font-light"><?php echo implode(", ", $term_items) ?></span>
            <?php if ($has_desc && $terms) : ?>
            <div class="hidden flex-col p-3 pb-0 shadow-md absolute w-96 mt-9 right-0 bg-white z-30" data-tooltip>
                <?php  foreach ($terms as $term) : ?>
                <?php if ($term->description) : ?>
                    <?php print_r($term) ?>
                <span class="font-bold text-md mb-2"><?php echo $term->name; ?></span>
                <span class="mb-5 font-light"><?php echo $term->description ?></span>
                <?php endif;?>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>