<div class="mt-8 mb-12">
    <?php  woocommerce_breadcrumb() ?>
</div>

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
<section class="hidden xl:w-10/12 mx-auto">

    <?php
	do_action( 'woocommerce_before_checkout_form', $checkout );

	// If checkout registration is disabled and not logged in, the user cannot checkout.
	if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
		echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );

		return;
	}

	?>
</section>

<form name="checkout" method="post" class="checkout woocommerce-checkout mb-10" autocomplete="off"
    action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
    <section class="xl:w-10/12 mx-auto">
        <h2 class="text-5xl font-bold text-center mb-20" data_title_addr>Zamówienie</h2>
        <h2 class="hidden text-5xl font-bold text-center mb-20" data_title_pay>Dostawa i płatność</h2>
        <div class="flex flex-col lg:flex-row  lg:justify-between">
            <div class="w-full lg:w-7/12">
                <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
                <div data-customer_info>
                    <h2 class="text-2xl font-bold mb-5" data_title_addr>Dane Kupującego</h2>
                    <div class="flex flex-col sm:grid sm:grid-cols-2 sm:gap-6 mb-5">
                        <div class="lefty flex flex-col">
                            <div>
                                <?php woocommerce_form_field( 'billing_first_name', array(
								'placeholder' => '',
								'required'    => true,
								'label'       => 'Imię',
								'type'        => 'text'
							), $checkout->get_value( 'billing_first_name' ) ); ?>
                            </div>
                            <div>
                                <?php woocommerce_form_field( 'billing_last_name', array(
								'placeholder' => '',
								'required'    => true,
								'label'       => 'Nazwisko',
								'type'        => 'text'
							), $checkout->get_value( 'billing_last_name' ) ); ?>
                            </div>
                            <div>
                                <?php woocommerce_form_field( 'billing_phone', array(
								'placeholder' => '',
								'required'    => true,
								'label'       => 'Numer telefonu',
								'type'        => 'tel',
								'validate'    => array('phone')
							), $checkout->get_value( 'billing_phone' ) ); ?>
                            </div>
                            <div>
                                <?php woocommerce_form_field( 'billing_email', array(
								'placeholder' => '',
								'required'    => true,
								'label'       => 'Adres e-mail',
								'type'        => 'email',
								'validate'    => array('email')
							), $checkout->get_value( 'billing_email' ) ); ?>
                            </div>
                            <div class="hidden">
                                <?php woocommerce_form_field( 'billing_country', array(
								'placeholder' => '',
								'required'    => true
							), 'PL' ); ?>
                            </div>
                        </div>
                        <div class="righty flex flex-col">
                            <?php woocommerce_form_field( 'billing_address_1', array(
							'placeholder' => '',
							'required'    => true,
							'label'       => 'Ulica, nr. domu, nr. mieszkania',
							'type'        => 'text'
						), $checkout->get_value( 'billing_address_1' ) ); ?>
                            <div class="flex gap-6">
                                <div class="w-3/5">
                                    <?php woocommerce_form_field( 'billing_city', array(
									'placeholder' => '',
									'required'    => true,
									'label'       => 'Miasto',
									'type'        => 'text'
								), $checkout->get_value( 'billing_city' ) ); ?>
                                </div>
                                <div class="w-2/5">
                                    <?php woocommerce_form_field( 'billing_postcode', array(
									'placeholder' => '',
									'required'    => true,
									'label'       => 'Kod pocztowy',
									'type'        => 'text',
									'validate'    => array('postcode')
								), $checkout->get_value( 'billing_postcode' ) ); ?>
                                </div>

                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="custom-checkbox">
                                <input type="checkbox" name="ship_to_different_address"
                                    id="ship-to-different-address-checkbox" value="1">
                                <label for="ship-to-different-address-checkbox">
                                    <h2 class="text-2xl font-bold" data_title_addr>Dostawa na inny adres</h2>
                                </label>
                            </div>
                        </div>
                        <div class="lefty flex flex-col hidden" data-other-address>
                            <div>
                                <?php woocommerce_form_field( 'shipping_first_name', array(
								'placeholder' => '',
								'required'    => true,
								'label'       => 'Imię',
								'type'        => 'text'
							), $checkout->get_value( 'shipping_first_name' ) ); ?>
                            </div>
                            <div>
                                <?php woocommerce_form_field( 'shipping_last_name', array(
								'placeholder' => '',
								'required'    => true,
								'label'       => 'Nazwisko',
								'type'        => 'text'
							), $checkout->get_value( 'shipping_last_name' ) ); ?>
                            </div>
                            <div class="hidden">
                                <?php woocommerce_form_field( 'shipping_country', array(
								'placeholder' => '',
								'required'    => true
							), 'PL' ); ?>
                            </div>
                        </div>
                        <div class="righty flex flex-col hidden" data-other-address>
                            <?php woocommerce_form_field( 'shipping_address_1', array(
							'placeholder' => '',
							'required'    => true,
							'label'       => 'Ulica, nr. domu, nr. mieszkania',
							'type'        => 'text'
						), $checkout->get_value( 'shipping_address_1' ) ); ?>
                            <div class="flex gap-6">
                                <div class="w-3/5">
                                    <?php woocommerce_form_field( 'shipping_city', array(
									'placeholder' => '',
									'required'    => true,
									'label'       => 'Miasto',
									'type'        => 'text'
								), $checkout->get_value( 'shipping_city' ) ); ?>
                                </div>
                                <div class="w-2/5">
                                    <?php woocommerce_form_field( 'shipping_postcode', array(
									'placeholder' => '',
									'required'    => true,
									'label'       => 'Kod pocztowy',
									'type'        => 'text',
									'validate'    => array('postcode')
								), $checkout->get_value( 'shipping_postcode' ) ); ?>
                                </div>

                            </div>
                        </div>
                        <div class="col-span-2">


                            <div class="my-2 custom-checkbox">
                                <input type="checkbox" name="wantFV" id="wantFV">
                                <label for="wantFV">
                                    <h2 class="text-2xl font-bold" data_title_addr>Faktura VAT</h2>
                                </label>
                            </div>
                            <div class="mb-2 hidden" data-fv_fields>
                                <div class="my-2 custom-checkbox">
                                    <input type="radio" name="fv_name" id="fvCompany" checked="checked" value="Firma">
                                    <label for="fvCompany">Firma</label>
                                    <input type="radio" name="fv_name" id="fvPrivate" value="Osoba Prywatna">
                                    <label for="fvPrivate" class="ml-5">Osoba Prywatna</label>
                                </div>
                                <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-6">
                                    <div>
                                        <div>
                                            <?php woocommerce_form_field( 'billing_company', array(
                                        'placeholder' => '',
                                        'required'    => false,
                                        'label'       => 'Odbiorca *',
                                        'type'        => 'text',
                                        )); ?>
                                        </div>
                                        <div class="nip-wrapper">
                                            <?php woocommerce_form_field( 'billing_tax_no', array(
                                        'placeholder' => '',
                                        'required'    => false,
                                        'label'       => 'NIP *',
                                        'type'        => 'text',
                                        )); ?>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div>
                                            <?php woocommerce_form_field( 'fv_address', array(
                                        'placeholder' => '',
                                        'required'    => false,
                                        'label'       => 'Ulica, nr. domu, nr. mieszkania *',
                                        'type'        => 'text',
                                        )); ?>
                                        </div>
                                        <div class="flex gap-6">
                                            <div class="w-3/5">
                                                <?php woocommerce_form_field( 'fv_city', array(
                                                'placeholder' => '',
                                                'required'    => true,
                                                'label'       => 'Miasto',
                                                'type'        => 'text'
                                            )); ?>
                                            </div>
                                            <div class="w-2/5">
                                                <?php woocommerce_form_field( 'fv_postcode', array(
                                                'placeholder' => '',
                                                'required'    => true,
                                                'label'       => 'Kod pocztowy',
                                                'type'        => 'text',
                                                'validate'    => array('postcode')
                                            ));?>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <h2 class="text-2xl font-bold mb-5" data_title_addr>Zgody formalne</h2>
                    <div class="mb-5 custom-checkbox">
                        <input type="checkbox" id="privacy_policy" name="privacy_policy" value="1">
                        <label for="privacy_policy">
                            Zapoznałem(am) się i akceptuję <a class="text-green hover:text-orange"
                                href="<?php echo get_privacy_policy_url(); ?>" target="_blank">Politykę
                                Prywatności</a> i <a href="<?php echo get_home_url() . '/obsluga-klienta/regulamin/' ?>"
                                target="_blank" class="text-green hover:text-orange">
                                Regulamin strony
                            </a>

                        </label>
                    </div>
                </div>
                <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
                <div class="payment-and-shipping hidden" id="paymentShipping" data-payment_shipping>
                    <p class="text-xl font-bold">Wybierz najwygodniejszy dla Ciebie sposób dostawy</p>
                    <div class="relative">
                        <div
                            class="shipping-boxes my-3 shipping grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-0 lg:gap-6">
                            <label for="#"
                                class="shipping-box mt-5 mb-1 relative border border-light-gray pb-4 pt-10 px-2 flex flex-col items-center ">
                                <img data-box_img src="<?php echo THEME_IMG . '/lorry.svg' ?>" class="h-full mb-5"
                                    alt="">
                                <p data-box_text>Ładowanie...</p>
                                <div class="absolute -top-4 right-5 p-1.5 bg-white">
                                    <div
                                        class="shipping-box__cehck relative w-5 h-5  border border-light-gray rounded-full relative  bg-white">
                                        <svg class="w-4 h-4 fill-light-gray absolute -right-0.5"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46.1 40.72">
                                            <path class="cls-1"
                                                d="M44.08,.31c-2.08-1.12-4.4,1.04-5.76,2.32-3.12,3.04-5.76,6.56-8.72,9.76-3.28,3.52-6.32,7.04-9.68,10.48-1.92,1.92-4,4-5.28,6.4-2.88-2.8-5.36-5.84-8.56-8.32C3.76,19.19-.08,17.91,0,22.15c.16,5.52,5.04,11.44,8.64,15.2,1.52,1.6,3.52,3.28,5.84,3.36,2.8,.16,5.68-3.2,7.36-5.04,2.96-3.2,5.36-6.8,8.08-10.08,3.52-4.32,7.12-8.56,10.56-12.96,2.16-2.72,8.96-9.44,3.6-12.32h0ZM3.52,21.83c-.08,0-.16,0-.32,.08-.32-.08-.56-.16-.88-.32,.24-.16,.64-.08,1.2,.24h0Zm0,0" />
                                        </svg>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div data-boxes_overlau
                            class="hidden transition-all absolute w-full h-full bg-white/60 top-0 left-0"></div>
                    </div>

                    <div class="py-10 inPost-wrapper hidden">
                        <div>
                            <?php get_template_part( 'components/boardhouse-template-from-inpost') ?>
                        </div>
                    </div>

                    <p class="text-xl font-bold">Wybierz najwygodniejszy dla Ciebie sposób zapłaty</p>
                    <div class="relative">
                        <div
                            class="shipping-boxes my-3 payment grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-0 lg:gap-6">
                            <label for="#"
                                class="shipping-box mt-5 mb-1 relative border border-light-gray pb-4 pt-10 px-2 flex flex-col items-center ">
                                <img data-box_img src="<?php echo THEME_IMG . '/ccard.svg' ?>" class="h-full mb-5"
                                    alt="">
                                <p data-box_text>Ładowanie...</p>
                                <div class="absolute -top-4 right-5 p-1.5 bg-white">
                                    <div
                                        class="shipping-box__cehck relative w-5 h-5  border border-light-gray rounded-full relative  bg-white">
                                        <svg class="w-4 h-4 fill-light-gray absolute -right-0.5"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46.1 40.72">
                                            <path class="cls-1"
                                                d="M44.08,.31c-2.08-1.12-4.4,1.04-5.76,2.32-3.12,3.04-5.76,6.56-8.72,9.76-3.28,3.52-6.32,7.04-9.68,10.48-1.92,1.92-4,4-5.28,6.4-2.88-2.8-5.36-5.84-8.56-8.32C3.76,19.19-.08,17.91,0,22.15c.16,5.52,5.04,11.44,8.64,15.2,1.52,1.6,3.52,3.28,5.84,3.36,2.8,.16,5.68-3.2,7.36-5.04,2.96-3.2,5.36-6.8,8.08-10.08,3.52-4.32,7.12-8.56,10.56-12.96,2.16-2.72,8.96-9.44,3.6-12.32h0ZM3.52,21.83c-.08,0-.16,0-.32,.08-.32-.08-.56-.16-.88-.32,.24-.16,.64-.08,1.2,.24h0Zm0,0" />
                                        </svg>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div data-boxes_overlau
                            class="hidden transition-all absolute w-full h-full bg-white/60 top-0 left-0"></div>
                    </div>

                    <div class="hidden">
                        <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
                        <?php wc_cart_totals_shipping_html(); ?>
                        <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-4/12">
                <div data-delivery_addr class="mb-6 hidden">
                    <div class="flex justify-between align-middle mb-4">
                        <p class="text-xl font-bold">Adres rozliczeniowy</p>
                        <a class="text-green underline font-light" href="#" data-back_to_cust>zmień</a>
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
                    <a class="text-green underline font-light" href="<?php echo get_home_url() . '/koszyk' ?>">edytuj
                        koszyk</a>
                </div>
                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                </div>
            </div>
        </div>
        <div class="flex justify-between flex-wrap gap-6 w-full lg:w-fit">
            <a href="<?php echo get_home_url() . '/sklep' ?>"
                class="bg-white w-full lg:w-60 border-dark border-2 hover:bg-orange hover:border-orange hover:text-white transition-all text-dark flex items-center justify-center font-bold h-12 uppercase">Powrót
                do sklepu</a>
            <a data-go_to_payment href="#"
                class="bg-green w-full lg:w-60 border-green text-white border-2 hover:bg-orange hover:border-orange hover:text-white transition-all text-dark flex items-center justify-center font-bold h-12 uppercase">Przejdź
                dalej</a>
            <a data-place_order href="#"
                class="hidden bg-green w-full lg:w-80 border-green text-white border-2 hover:bg-orange hover:border-orange hover:text-white transition-all text-dark flex items-center justify-center font-bold h-12 uppercase">Zamawiam
                z obowiązkiem zapłaty</a>
        </div>
    </section>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>