<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="grid grid-cols-1 lg:grid-cols-4 xl:grd-cols-4 2xl:grid-cols-5 gap-5 mb-5">
    <?php
$alt_filters_for = array(42, 41, 107, 100, 102, 103);
$cur_cat = get_queried_object_id();
$alt_filters = false;
foreach ($alt_filters_for as $cat) {
	if($cat==$cur_cat) $alt_filters = true;
}
?>

    <?php 

if ($alt_filters || isset($_GET['s'])) echo do_shortcode( '[br_filters_group group_id=6898]');
else echo do_shortcode('[br_filters_group group_id=6834]');

?>
    <button
        class="bapf_button bapf_update w-full block text-center h-full bg-green hover:bg-orange transition-all text-white">Zastosuj</button>
</div>

<div class="active-filters mb-5">
    <?php echo do_shortcode(' [br_filter_single filter_id=6835]') ?>
</div>
<div class="products grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 2xl:grid-cols-6 gap-6">