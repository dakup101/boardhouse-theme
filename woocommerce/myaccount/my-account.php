<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */
?>
<div class="mt-8 mb-12">
    <?php  woocommerce_breadcrumb() ?>
</div>

<section class="xl:w-10/12 mx-auto mb-10">
    <h1 class="text-5xl my-10 w-full font-bold text-center">Twoje Konto</h1>
    <div class="flex">
        <div class="w-2/12 pr-3 border-r border-gray">
            <?php do_action( 'woocommerce_account_navigation' ); ?>
        </div>
        <div class="w-1/12"></div>
        <div class="w-6/12">
            <?php
		/**
		 * My Account content.
		 *
		 * @since 2.6.0
		 */
		do_action( 'woocommerce_account_content' );
	?>
        </div>
    </div>
</section>


<div class="woocommerce-MyAccount-content">

</div>