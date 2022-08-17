<?php

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Ustawienia globalnych elementów motywu',
        'menu_title'	=> 'Elementy Globalne',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> true,
        'icon_url' => '',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Edycja Nagłówka Strony',
        'menu_title'	=> 'Nagłówek',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Edycja Stopki Strony',
        'menu_title'	=> 'Stopka',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Produkt Wyróżniony',
        'menu_title'	=> 'Produkt Wyróżniony',
        'parent_slug'	=> 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Kategoria Wyróżniona',
        'menu_title'	=> 'Kategoria Wyróżniona',
        'parent_slug'	=> 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Ikonki przed stopką',
        'menu_title'	=> 'Ikonki przed stopką',
        'parent_slug'	=> 'theme-general-settings',
    ));
}