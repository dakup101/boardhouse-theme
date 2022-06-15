<?php
function manufacturer_taxonomy() {
	// Add new "Locations" taxonomy to Posts
	register_taxonomy('manufacturer', 'product', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => false,
		// 'show_ui' => true,
		// 'show_in_quick_edit' => false,
		// 'meta_box_cb' => false,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Producenci', 'taxonomy general name' ),
			'singular_name' => _x( 'Producent', 'taxonomy singular name' ),
			'search_items' =>  __( 'Wyszukaj producenta' ),
			'all_items' => __( 'Wszystkie producenci' ),
			'edit_item' => __( 'Edytuj producenta' ),
			'update_item' => __( 'Zaktualizuj producenta' ),
			'add_new_item' => __( 'Dodaj producenta' ),
			'new_item_name' => __( 'Producenta' ),
			'menu_name' => __( 'Producenci' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'manufacturer', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
}
add_action( 'init', 'manufacturer_taxonomy', 0 );