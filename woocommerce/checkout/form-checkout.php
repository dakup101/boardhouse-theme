<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="hidden w-10/12 mx-auto">

<?php
do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>
</section>

<form name="checkout" method="post" class="checkout woocommerce-checkout mb-10" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
    <section class="w-10/12 mx-auto">
        <h2 class="text-5xl font-bold text-center mb-20" data_title_addr>Adres do wysyłki</h2>
        <h2 class="hidden text-5xl font-bold text-center mb-20" data_title_pay>Dostawa i płatność</h2>
        <div class="flex justify-between">
            <div class="w-7/12">
<!--	            --><?php //do_action( 'woocommerce_checkout_before_customer_details' ); ?>
                <div class="grid grid-cols-2 gap-6" data-customer_info>
                    <div class="lefty flex flex-col">
                        <div>
                            <p class="font-bold block my-2">Imię *</p>
	                        <?php woocommerce_form_field('billing_first_name', array('placeholder' => 'wpisz imię', 'required' => true), $checkout->get_value('billing_first_name')); ?>
                        </div>
                        <div>
                              <p class="font-bold block my-2">Nazwisko *</p>
                              <?php woocommerce_form_field('billing_last_name', array('placeholder' => 'wpisz nazwisko', 'required' => true), $checkout->get_value('billing_last_name')); ?>
                        </div>
                        <div>
                             <p class="font-bold block my-2">Numer telefonu *</p>
                             <?php woocommerce_form_field('billing_phone', array('placeholder' => 'wpisz numer telefonu', 'required' => true), $checkout->get_value('billing_phone')); ?>
                        </div>
                        <div>
                            <p class="font-bold block my-2">Adres e-mail *</p>
                            <?php woocommerce_form_field('billing_email', array('placeholder' => 'wpisz adres e-mail', 'required' => true), $checkout->get_value('billing_email')); ?>
                        </div>
                        <div class="hidden">
                            <?php woocommerce_form_field('billing_country', array('placeholder' => 'wpisz adres e-mail', 'required' => true), 'PL'); ?>
                        </div>
                    </div>
                    <div class="righty flex flex-col">
                        <p class="font-bold my-2">Ulica *</p>
	                    <?php woocommerce_form_field('billing_address_1', array('placeholder' => 'wpisz nazwę ulicy', 'required' => true), $checkout->get_value('billing_address_1')); ?>
                        <div class="flex gap-6">
                            <div class="w-3/5">
                                <p class="font-bold my-2">Miasto *</p>
	                            <?php woocommerce_form_field('billing_city', array('placeholder' => 'wpisz miasto', 'required' => true), $checkout->get_value('billing_city')); ?>
                            </div>
                            <div class="w-2/5">
                                <p class="font-bold my-2">Kod pocztowy *</p>
	                            <?php woocommerce_form_field('billing_postcode', array('placeholder' => 'kod pocztowy', 'required' => true), $checkout->get_value('billing_postcode')); ?>
                            </div>

                        </div>
                        <div class="my-2 custom-checkbox">
                            <input type="checkbox" id="wantFV">
                            <label for="wantFV" class="" style="color: #c6c6c6">
                                Chcę otrzymać fakturę VAT
                            </label>
                        </div>
                    </div>
                </div>
	            <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
                <div class="payment-and-shipping hidden" id="paymentShipping" data-payment_shipping>
                    <p class="text-xl font-bold">Wybierz najwygodniejszy dla Ciebie sposób dostawy</p>
                    <div class="relative">
                        <div class="shipping-boxes my-3 shipping grid grid-cols-3 gap-10">
                            <label for="#" class="shipping-box my-5 relative border border-light-gray pb-4 pt-10 px-2 flex flex-col items-center ">
                                <img data-box_img src="<?php echo THEME_IMG . '/lorry.svg' ?>" class="h-full mb-5" alt="">
                                <p data-box_text>Ładowanie...</p>
                                <div class="absolute -top-4 right-5 p-1.5 bg-white">
                                    <div class="shipping-box__cehck relative w-5 h-5  border border-light-gray rounded-full relative  bg-white">
                                        <svg class="w-4 h-4 fill-light-gray absolute -right-0.5"
                                             xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 46.1 40.72"
                                        ><path class="cls-1" d="M44.08,.31c-2.08-1.12-4.4,1.04-5.76,2.32-3.12,3.04-5.76,6.56-8.72,9.76-3.28,3.52-6.32,7.04-9.68,10.48-1.92,1.92-4,4-5.28,6.4-2.88-2.8-5.36-5.84-8.56-8.32C3.76,19.19-.08,17.91,0,22.15c.16,5.52,5.04,11.44,8.64,15.2,1.52,1.6,3.52,3.28,5.84,3.36,2.8,.16,5.68-3.2,7.36-5.04,2.96-3.2,5.36-6.8,8.08-10.08,3.52-4.32,7.12-8.56,10.56-12.96,2.16-2.72,8.96-9.44,3.6-12.32h0ZM3.52,21.83c-.08,0-.16,0-.32,.08-.32-.08-.56-.16-.88-.32,.24-.16,.64-.08,1.2,.24h0Zm0,0"/></svg>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div data-boxes_overlau class="hidden transition-all absolute w-full h-full bg-white/60 top-0 left-0"></div>
                    </div>

                    <p class="text-xl font-bold">Wybierz najwygodniejszy dla Ciebie sposób zapłaty</p>
                    <div class="relative">
                        <div class="shipping-boxes my-3 payment grid grid-cols-3 gap-10">
                            <label for="#" class="shipping-box my-5 relative border border-light-gray pb-4 pt-10 px-2 flex flex-col items-center ">
                                <img data-box_img src="<?php echo THEME_IMG . '/ccard.svg' ?>" class="h-full mb-5" alt="">
                                <p data-box_text>Ładowanie...</p>
                                <div class="absolute -top-4 right-5 p-1.5 bg-white">
                                    <div class="shipping-box__cehck relative w-5 h-5  border border-light-gray rounded-full relative  bg-white">
                                        <svg class="w-4 h-4 fill-light-gray absolute -right-0.5"
                                             xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 46.1 40.72"
                                        ><path class="cls-1" d="M44.08,.31c-2.08-1.12-4.4,1.04-5.76,2.32-3.12,3.04-5.76,6.56-8.72,9.76-3.28,3.52-6.32,7.04-9.68,10.48-1.92,1.92-4,4-5.28,6.4-2.88-2.8-5.36-5.84-8.56-8.32C3.76,19.19-.08,17.91,0,22.15c.16,5.52,5.04,11.44,8.64,15.2,1.52,1.6,3.52,3.28,5.84,3.36,2.8,.16,5.68-3.2,7.36-5.04,2.96-3.2,5.36-6.8,8.08-10.08,3.52-4.32,7.12-8.56,10.56-12.96,2.16-2.72,8.96-9.44,3.6-12.32h0ZM3.52,21.83c-.08,0-.16,0-.32,.08-.32-.08-.56-.16-.88-.32,.24-.16,.64-.08,1.2,.24h0Zm0,0"/></svg>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div data-boxes_overlau class="hidden transition-all absolute w-full h-full bg-white/60 top-0 left-0"></div>
                    </div>

                    <div class="hidden">
                        <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
                        <?php wc_cart_totals_shipping_html(); ?>
                        <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
                    </div>
                </div>
            </div>
            <div class="w-4/12">
                <div data-delivery_addr class="mb-6 hidden">
                    <div class="flex justify-between align-middle mb-4">
                        <p class="text-xl font-bold">Adres dostawy</p>
                        <a class="text-green underline font-light" href="#" data-back_to_cust >zmień</a>
                    </div>
                    <div class="font-light text-gray">
                        <p data-name></p>
                        <p data-street></p>
                        <p data-addr></p>
                        <p data-country class="mb-4">Polska</p>
                        <p data-tel></p>
                        <p data-email></p>
                    </div>
                </div>
                <div class="flex justify-between align-middle mb-4">
                    <p class="text-xl font-bold">Podgląd zamówienia</p>
                    <a class="text-green underline font-light" href="<?php echo get_home_url() . '/koszyk' ?>">edytuj koszyk</a>
                </div>
                <div id="order_review" class="woocommerce-checkout-review-order">
		            <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                </div>
            </div>
        </div>
        <div class="flex justify-between flex-wrap gap-6">
            <a href="<?php echo '#'?>" class="bg-white w-60 border-dark border-2 hover:bg-orange hover:border-orange hover:text-white transition-all text-dark flex items-center justify-center font-bold h-12 uppercase">Kontynuj zakupy</a>
            <a data-go_to_payment href="#" class="bg-green w-60 border-green text-white border-2 hover:bg-orange hover:border-orange hover:text-white transition-all text-dark flex items-center justify-center font-bold h-12 uppercase">Przejdź dalej</a>
            <a data-place_order href="#" class="hidden bg-green w-60 border-green text-white border-2 hover:bg-orange hover:border-orange hover:text-white transition-all text-dark flex items-center justify-center font-bold h-12 uppercase">Kupuję i płacę</a>
        </div>
	</section>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
