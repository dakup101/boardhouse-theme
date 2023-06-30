<?php
/**
 * Photoswipe markup
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/photoswipe.php.
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
	exit; // Exit if accessed directly.
}
?>

<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close"
                    aria-label="<?php esc_attr_e( 'Close (Esc)', 'woocommerce' ); ?>"></button>
                <button class="pswp__button pswp__button--share"
                    aria-label="<?php esc_attr_e( 'Share', 'woocommerce' ); ?>"></button>
                <button class="pswp__button pswp__button--fs"
                    aria-label="<?php esc_attr_e( 'Toggle fullscreen', 'woocommerce' ); ?>"></button>
                <button class="pswp__button pswp__button--zoom"
                    aria-label="<?php esc_attr_e( 'Zoom in/out', 'woocommerce' ); ?>"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left"
                aria-label="<?php esc_attr_e( 'Previous (arrow left)', 'woocommerce' ); ?>">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_0_3)">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M2.5 20C2.5 24.6413 4.34375 29.0925 7.62563 32.3743C10.9075 35.6563 15.3587 37.5 20 37.5C24.6413 37.5 29.0925 35.6563 32.3743 32.3743C35.6563 29.0925 37.5 24.6413 37.5 20C37.5 15.3587 35.6563 10.9075 32.3743 7.62563C29.0925 4.34375 24.6413 2.5 20 2.5C15.3587 2.5 10.9075 4.34375 7.62563 7.62563C4.34375 10.9075 2.5 15.3587 2.5 20ZM40 20C40 25.3043 37.8928 30.3915 34.1423 34.1423C30.3915 37.8928 25.3043 40 20 40C14.6957 40 9.6086 37.8928 5.85787 34.1423C2.10714 30.3915 0 25.3043 0 20C0 14.6957 2.10714 9.6086 5.85787 5.85787C9.6086 2.10714 14.6957 0 20 0C25.3043 0 30.3915 2.10714 34.1423 5.85787C37.8928 9.6086 40 14.6957 40 20ZM28.75 18.75C29.0815 18.75 29.3995 18.8817 29.634 19.1161C29.8682 19.3505 30 19.6685 30 20C30 20.3315 29.8682 20.6495 29.634 20.8839C29.3995 21.1183 29.0815 21.25 28.75 21.25H14.2675L19.635 26.615C19.7512 26.7312 19.8434 26.8693 19.9063 27.021C19.9692 27.173 20.0016 27.3357 20.0016 27.5C20.0016 27.6643 19.9692 27.827 19.9063 27.979C19.8434 28.1307 19.7512 28.2688 19.635 28.385C19.5188 28.5013 19.3808 28.5935 19.2289 28.6562C19.0771 28.7192 18.9143 28.7515 18.75 28.7515C18.5857 28.7515 18.4229 28.7192 18.2711 28.6562C18.1192 28.5935 17.9812 28.5013 17.865 28.385L10.365 20.885C10.2486 20.7689 10.1562 20.631 10.0932 20.4791C10.0302 20.3272 9.99777 20.1644 9.99777 20C9.99777 19.8356 10.0302 19.6728 10.0932 19.5209C10.1562 19.3691 10.2486 19.2311 10.365 19.115L17.865 11.615C18.0997 11.3803 18.418 11.2484 18.75 11.2484C19.082 11.2484 19.4003 11.3803 19.635 11.615C19.8697 11.8497 20.0016 12.168 20.0016 12.5C20.0016 12.832 19.8697 13.1503 19.635 13.385L14.2675 18.75H28.75Z"
                            fill="#45E868" />
                    </g>
                    <defs>
                        <clipPath id="clip0_0_3">
                            <rect width="40" height="40" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
            </button>
            <button class="pswp__button pswp__button--arrow--right"
                aria-label="<?php esc_attr_e( 'Next (arrow right)', 'woocommerce' ); ?>">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1_2)">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M2.5 20C2.5 24.6413 4.34375 29.0925 7.62563 32.3743C10.9075 35.6563 15.3587 37.5 20 37.5C24.6413 37.5 29.0925 35.6563 32.3743 32.3743C35.6563 29.0925 37.5 24.6413 37.5 20C37.5 15.3587 35.6563 10.9075 32.3743 7.62563C29.0925 4.34375 24.6413 2.5 20 2.5C15.3587 2.5 10.9075 4.34375 7.62563 7.62563C4.34375 10.9075 2.5 15.3587 2.5 20ZM40 20C40 25.3043 37.8928 30.3915 34.1423 34.1423C30.3915 37.8928 25.3043 40 20 40C14.6957 40 9.6086 37.8928 5.85787 34.1423C2.10714 30.3915 0 25.3043 0 20C0 14.6957 2.10714 9.6086 5.85787 5.85787C9.6086 2.10714 14.6957 0 20 0C25.3043 0 30.3915 2.10714 34.1423 5.85787C37.8928 9.6086 40 14.6957 40 20ZM11.25 18.75C10.9185 18.75 10.6005 18.8817 10.3661 19.1161C10.1317 19.3505 10 19.6685 10 20C10 20.3315 10.1317 20.6495 10.3661 20.8839C10.6005 21.1183 10.9185 21.25 11.25 21.25H25.7325L20.365 26.615C20.2488 26.7312 20.1566 26.8693 20.0937 27.021C20.0308 27.173 19.9984 27.3357 19.9984 27.5C19.9984 27.6643 20.0308 27.827 20.0937 27.979C20.1566 28.1307 20.2488 28.2688 20.365 28.385C20.4812 28.5013 20.6192 28.5935 20.7711 28.6562C20.9229 28.7192 21.0857 28.7515 21.25 28.7515C21.4143 28.7515 21.5771 28.7192 21.7289 28.6562C21.8808 28.5935 22.0188 28.5013 22.135 28.385L29.635 20.885C29.7515 20.7689 29.8437 20.631 29.9067 20.4791C29.9697 20.3272 30.0023 20.1644 30.0023 20C30.0023 19.8356 29.9697 19.6728 29.9067 19.5209C29.8437 19.3691 29.7515 19.2311 29.635 19.115L22.135 11.615C22.0188 11.4988 21.8808 11.4066 21.7289 11.3437C21.5771 11.2808 21.4143 11.2484 21.25 11.2484C21.0857 11.2484 20.9229 11.2808 20.7711 11.3437C20.6192 11.4066 20.4812 11.4988 20.365 11.615C20.2488 11.7312 20.1566 11.8692 20.0937 12.0211C20.0308 12.1729 19.9984 12.3357 19.9984 12.5C19.9984 12.6643 20.0308 12.8271 20.0937 12.9789C20.1566 13.1308 20.2488 13.2688 20.365 13.385L25.7325 18.75H11.25Z"
                            fill="#45E868" />
                    </g>
                    <defs>
                        <clipPath id="clip0_1_2">
                            <rect width="40" height="40" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
            </button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>