<?php
/**
 * Single Product stock.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/stock.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $product;
$_product = $args['product'];
?>

<?php
$isVariable = $product->is_type('variable');
$is_low_and_backorder = $product->is_on_backorder() && $product->get_stock_quantity() <= 0;
if ($isVariable) $is_low_and_backorder = $_product->is_on_backorder() && $_product->get_stock_quantity() <= 0;


?>

<?php if($isVariable): ?>

<?php if ($is_low_and_backorder) : ?>
<p class="stock uppercase text-sm text-orange tracking-widest mb-2 <?php echo esc_attr( $class ); ?>">
    Dostępne na zamówienie.
</p>
<?php else : ?>
<p class="stock uppercase text-sm text-green tracking-widest mb-2 <?php echo esc_attr( $class ); ?>">
    <?php echo wp_kses_post( $availability ); ?></p>
<?php endif;?>


<?php if ($is_low_and_backorder) : ?>
<?php // START --- IF HAS DATE ?>
<?php if (!empty(get_field('backorder_date', $_product->get_id()))) : ?>
<div class="mb-2">
    Przewidywana dostawa:
    <?php echo '<strong>' . get_field("backorder_date", $_product->get_id()) . '</strong>';?>
    <span class="text-orange">*</span>
</div>
<div class="mb-2 text-sm text-orange">
    * Czas dostawy może się wydłużyć.
</div>
<?php else: ?>
<div class="mb-2">
    Przewidywana dostawa:
    <?php
    $datetime = new DateTime();
    $dayOfWeek = $datetime->format('w');
    if ($dayOfWeek == 6) $datetime->modify('+7 day');
    elseif ($dayOfWeek == 7) $datetime->modify('+6 day');
    else $datetime->modify('+5 day');
    echo '<strong>' . $datetime->format('d/m/Y') . '</strong>';
    ?>
    <span class="text-orange">*</span>
</div>
<div class="mb-2 text-sm text-orange">
    * Czas dostawy może się wydłużyć.
</div>
<?php endif; ?>
<?php // END --- IF HAS DATE ?>
<?php else : ?>
<div class="mb-2">
    Przewidywana dostawa: <?php
    $datetime = new DateTime();
    $dayOfWeek = $datetime->format('w');
    if ($dayOfWeek == 6) $datetime->modify('+5 day');
    elseif ($dayOfWeek == 7) $datetime->modify('+4 day');
    else $datetime->modify('+3 day');
    echo '<strong>' . $datetime->format('d/m/Y') . '</strong>';
    ?>
</div>
<?php endif; ?>




<?php else: ?>

<?php if ($is_low_and_backorder) : ?>
<p class="stock uppercase text-sm text-orange tracking-widest mb-2 <?php echo esc_attr( $class ); ?>">
    Dostępne na zamówienie.
</p>
<?php else : ?>
<p class="stock uppercase text-sm text-green tracking-widest mb-2 <?php echo esc_attr( $class ); ?>">
    <?php echo wp_kses_post( $availability ); ?></p>
<?php endif;?>



<?php if ($is_low_and_backorder) : ?>
<?php // START --- IF HAS DATE ?>
<?php if (!empty(get_field('backorder_date', $product->get_id()))) : ?>
<div class="mb-2">
    Przewidywana dostawa:
    <?php echo '<strong>' . get_field("backorder_date", $product->get_id()) . '</strong>';?>
    <span class="text-orange">*</span>
</div>
<div class="mb-2 text-sm text-orange">
    * produkt jest dostępny na zamówienie. Czas dostawy może się wydłużyć.
</div>
<?php else: ?>
<div class="mb-2">
    Przewidywana dostawa:
    <?php
    $datetime = new DateTime();
    $dayOfWeek = $datetime->format('w');
    if ($dayOfWeek == 6) $datetime->modify('+7 day');
    elseif ($dayOfWeek == 7) $datetime->modify('+6 day');
    else $datetime->modify('+5 day');
    echo '<strong>' . $datetime->format('d/m/Y') . '</strong>';
    ?>
    <span class="text-orange">*</span>
</div>
<div class="mb-2 text-sm text-orange">
    * produkt jest dostępny na zamówienie. Czas dostawy może się wydłużyć.
</div>
<?php endif; ?>
<?php // END --- IF HAS DATE ?>
<?php else : ?>
<div class="mb-2">
    Przewidywana dostawa: <?php
    $datetime = new DateTime();
    $dayOfWeek = $datetime->format('w');
    if ($dayOfWeek == 6) $datetime->modify('+5 day');
    elseif ($dayOfWeek == 7) $datetime->modify('+4 day');
    else $datetime->modify('+3 day');
    echo '<strong>' . $datetime->format('d/m/Y') . '</strong>';
    ?>
</div>
</p>
<?php endif; ?>



<?php endif;?>