<?php
add_filter( 'woocommerce_form_field', 'bbloomer_checkout_fields_in_label_error', 10, 4 );

function bbloomer_checkout_fields_in_label_error( $field, $key, $args, $value ) {
	if ( strpos( $field, '</label>' ) !== false && $args['required'] ) {
		$error = '<span class="error" style="display:none">';
		$error .= sprintf( __( 'Sprawdź poprawność treści w polu', 'woocommerce' ), $args['label'] );
		$error .= '</span>';
		$field = substr_replace( $field, $error, strpos( $field, '</label>' ), 0);
	}
	return $field;
}