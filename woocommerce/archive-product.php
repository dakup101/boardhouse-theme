<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;
global $wp_query;
get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
<header class="woocommerce-products-header ">
    <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
    <h1 class="woocommerce-products-header__title page-title font-light text-5xl my-10 w-full text-center">
        <?php woocommerce_page_title(); ?></h1>
    <?php endif; ?>

    <?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>
<?php
$alt_filters_for = array(42, 41, 107, 100, 102, 103);
$cur_cat = get_queried_object_id();
$alt_filters = false;
foreach ($alt_filters_for as $cat) {
	if($cat==$cur_cat) $alt_filters = true;
}
?>

<?php 

if ($alt_filters || isset($_GET['s'])) echo do_shortcode( '[yith_wcan_filters slug="draft-preset-2"]');
else  echo do_shortcode( '[yith_wcan_filters slug="draft-preset"]');

?>

<!-- <div class="boardhouse-sidebar">
	<?php // dynamic_sidebar('sidebar'); 	do_action( 'woocommerce_before_shop_loop' );
	?>

</div> -->
<div class="before-products grid grid-cols-3 items-center mb-10">
    <div>
        <?php
        $result = woocommerce_result_count();
        global $wp_query;
        $totalproducts = wc_get_loop_prop('total') ? wc_get_loop_prop('total') : $wp_query->post_count;
        echo $result;
        $paged_maxnum = $GLOBALS['wp_query']->max_num_pages;

        ?>
    </div>
    <div class="text-center pages-dots">
        <?php the_posts_pagination(); ?>
    </div>
    <div class="text-right pages-shop ">
        <div class="prevy">
            <?php the_posts_pagination(); ?>
        </div>
        <?php
        $current_page = max(1, get_query_var('paged'));
        global $wp_query;
        ?>
        <div>
            <p>Strona <?php echo $current_page ?> z <?php echo $wp_query->max_num_pages; ?> </p>
        </div>
        <div class="nexty">
            <?php the_posts_pagination(); ?>
        </div>
    </div>
</div>
<?php
if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
    woocommerce_product_loop_start();

    if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
get_footer( 'shop' );