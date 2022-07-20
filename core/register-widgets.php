<?php
function  theme_widgets_init() {

	register_sidebar( array(
		'name'          => 'Shop Sidebar',
		'id'            => 'sidebar-shop',
		'before_widget' => '<div  id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => 'Main Sidebar',
		'id'            => 'sidebar',
		'before_widget' => '<div  id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'theme_widgets_init' );
?>