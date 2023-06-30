<div class="mt-8 mb-12">
    <?php  woocommerce_breadcrumb() ?>
</div>

<section class="xl:w-10/12 mx-auto">
    <?php
	/**
	 * Cart Page
	 *
	 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
	 *
	 * HOWEVER, on occasion WooCommerce will need to update template files and you
	 * (the theme developer) will need to copy the new files to your theme to
	 * maintain compatibility. We try to do this as little as possible, but it does
	 * happen. When this occurs the version of the template file will be bumped and
	 * the readme will list any important changes.
	 *
	 * @see     https://docs.woocommerce.com/document/template-structure/
	 * @package WooCommerce\Templates
	 * @version 3.8.0
	 */

	defined( 'ABSPATH' ) || exit;

    ?>

    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

        <h1 class="text-5xl my-10 w-full font-bold text-center">Twój Koszyk</h1>
        <div class="flex flex-col border-t border-light-gray">
            <?php do_action( 'woocommerce_before_cart_contents' ); ?>

            <?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				if ($_product -> get_type() == 'variable' || $_product -> get_type() == 'variation'){
					$variation = wc_get_product($_product->get_id());
					$product = wc_get_product($variation->get_parent_id()) ;
				}
				else{
					$product = $_product;
				}
				

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
            <div
                class="flex flex-col lg:flex-row py-3 mb-3 items-center justify-between border-b border-light-gray woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                <div class="flex gap-4 w-full lg:w-fit items-center">
                    <div class="product-img w-32">
                        <?php
		                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'single-post-thumbnail' );
		                        ?>
                        <img class="w-full" src="<?php echo $image[0] ?>" alt="">
                    </div>
                    <div>
                        <p class="tracking-wider font-bold text-gray"><?php echo $product->get_attribute('pa_marka') ?>
                        </p>
                        <?php echo wp_kses_post( apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a class="tracking-wider mb-3 font-bold text-xl mb-1" href="%s">%s</a>', $product_permalink, $product->get_name() ) : $product->get_name(), $cart_item ) ); ?>
                        <div class="item-dec text-gray">
                            <div class="font-light mb-3">
                                <?php
				                        $pkgDesc= apply_filters( 'woocommerce_cart_item_product_id', $cart_item['variation'], $cart_item, $cart_item_key );
				                        foreach ($pkgDesc as $key => $attr){
                                            $label = wc_attribute_label(str_replace('attribute_', '', $key));
                                            echo $label . ': ' . $attr;
				                        }
				                        ?>
                            </div>
                            <p class="font-light">Ilość:
                                <?php echo $cart_item['quantity']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?>
                            </p>
                        </div>

                    </div>
                </div>

                <div class="flex flex-col lg:flex-row gap-5 lg:gap-10 items-center w-full lg:w-fit">
                    <?php 
						$stock = $_product ->get_stock_quantity();
						$stock < 0 ? $instkoc = false : $instkoc = true;
                        $is_low_and_backorder = $_product->is_on_backorder();

					?>
                    <?php if ($instkoc && !$_product->is_on_backorder()) : ?>
                    <div class="flex gap-1 items-center text-green uppercase">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-check-lg" viewBox="0 0 16 16">
                            <path
                                d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                        </svg>
                        <p class="mt-0.5">W magazynie</p>
                    </div>
                    <?php else : ?>
                    <?php if ($is_low_and_backorder) : ?>
                    <div class="flex gap-1 flex-col justify-center items-center text-orange">
                        <div class="flex gap-1 items-centeruppercase">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-clock" viewBox="0 0 16 16">
                                <path
                                    d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                            </svg>
                            <p class=" mt-0.5">NA ZAMÓWIENIE</p>
                        </div>
                        <p class="w-32 text-sm font-light">czas dostawy się wydłuży</p>
                    </div>
                    <?php else: ?>
                    <div class="flex gap-1 flex-col justify-center items-center" style="color: red">
                        <div class="flex gap-1 items-centeruppercase">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-check-lg" viewBox="0 0 16 16">
                                <path
                                    d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                            </svg>
                            <p>Niedostępne</p>
                        </div>
                        <p class="w-32 text-sm font-light">czas dostawy się wydłuży</p>
                    </div>
                    <?php endif; ?>
                    <?php endif;?>
                    <div class="product-quantity product quantity"
                        data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                        <?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
								} else {
									$product_quantity = woocommerce_quantity_input(
										array(
											'input_name'   => "cart[{$cart_item_key}][qty]",
											'input_value'  => $cart_item['quantity'],
											'max_value'    => $_product->get_max_purchase_quantity(),
											'min_value'    => '0',
											'product_name' => $_product->get_name(),
										),
										$_product,
										false
									);
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
								?>
                    </div>

                    <div class="product-subtotal text-xl font-bold"
                        data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                        <?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
								?>
                    </div>

                    <div class="product-remove">
                        <?php
                            echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                'woocommerce_cart_item_remove_link',
                                sprintf(
                                    '<a href="%s" class="flex gap-2 hover:underline transition-all" aria-label="%s" data-product_id="%s" data-product_sku="%s">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16.67 20"><defs><style>.b{fill:#1e1e1f;fill-rule:evenodd;}</style></defs><path class="b" d="M14.17,20H2.5c-.92,0-1.67-.75-1.67-1.67V4.17H0v-1.67H5V1.25c0-.69,.56-1.25,1.25-1.25h4.17c.69,0,1.25,.56,1.25,1.25v1.25h5v1.67h-.83v14.17c0,.92-.75,1.67-1.67,1.67Zm0-15.83H2.5v13.75c0,.23,.19,.42,.42,.42H13.75c.23,0,.42-.19,.42-.42V4.17Zm-7.5,3.33c0-.46-.37-.83-.83-.83s-.83,.37-.83,.83v7.5c0,.46,.37,.83,.83,.83s.83-.37,.83-.83V7.5Zm5,0c0-.46-.37-.83-.83-.83s-.83,.37-.83,.83v7.5c0,.46,.37,.83,.83,.83s.83-.37,.83-.83V7.5Zm-1.67-5.83h-3.33v.83h3.33v-.83Z"/></svg>
                                    Usuń produkt
                                    </a>',
                                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                    esc_html__( 'Remove this item', 'woocommerce' ),
                                    esc_attr( $product_id ),
                                    esc_attr( $_product->get_sku() )
                                ),
                                $cart_item_key
                            );
                        ?>
                    </div>
                </div>
            </div>
            <?php
				}
			}
			?>
            <?php do_action( 'woocommerce_cart_contents' ); ?>
            <div class="flex flex-col lg:flex-row justify-between gap-4">
                <div class="w-full my-5 max-w-sm self-start">
                    <?php get_template_part( '/components/boardhouse-cart-status'); ?>
                </div>
                <div class="flex flex-col gap-5 w-full lg:w-96 self-end my-5">
                    <div class="actions">

                        <?php if ( wc_coupons_enabled() ) { ?>
                        <div class="coupon flex">
                            <input type="text" name="coupon_code"
                                class="input-text border-light-gray border h-12 px-3 w-1/2" id="coupon_code" value=""
                                placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" />
                            <button type="submit"
                                class="w-1/2 rounded-none uppercase bg-dark text-white hover:bg-green transition-all pointer-events-auto"
                                name="apply_coupon"
                                value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
                            <?php do_action( 'woocommerce_cart_coupon' ); ?>
                        </div>
                        <?php } ?>


                        <?php do_action( 'woocommerce_cart_actions' ); ?>

                        <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                    </div>
                    <div>
                        <button type="submit"
                            class="h-12 border-2 border-dark hover:bg-green hover:text-white hover:border-green uppercase w-full transition-all cursor-pointer"
                            name="update_cart"
                            value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
                    </div>
                    <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                </div>
            </div>
        </div>
        <?php do_action( 'woocommerce_after_cart_table' ); ?>
    </form>

    <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

    <div class="flex flex-col-reverse lg:flex-row justify-between items-end mb-10">
        <div class="w-full lg:w-96">
            <a href="<?php echo get_home_url() ?>"
                class="bg-white border-dark border-2 hover:bg-orange hover:border-orange hover:text-white transition-all text-dark flex items-center justify-center font-bold w-full h-12 uppercase">
                Powrót do sklepu
            </a>
        </div>
        <div class="w-full mb-5 lg:mb-0 lg:w-96">
            <?php
			/**
			 * Cart collaterals hook.
			 *
			 * @hooked woocommerce_cross_sell_display
			 * @hooked woocommerce_cart_totals - 10
			 */
			do_action( 'woocommerce_cart_collaterals' );
			?>
        </div>
    </div>

    <?php do_action( 'woocommerce_after_cart' ); ?>

</section>



<section class="container mx-auto mt-10">
    <h2 class="text-center font-medium uppercase tracking-wider text-2xl mb-8">Mogą cię również zainteresować</h2>
    <?php get_template_part('/components/boardhouse-products-carousel', null, array("id"=>1, "amount"=>18, "sale"=>true)); ?>
</section>

<section class="my-28 container mx-auto">
    <?php get_template_part( '/components/boardhouse-icons-row' ); ?>
</section>