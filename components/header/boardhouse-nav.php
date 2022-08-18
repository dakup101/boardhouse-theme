<div class="w-full sticky top-0 left-0 z-50 <?php echo is_front_page() ? '' : 'border-b border-dark/20' ?>">
    <div class="container mx-auto flex justify-between items-center gap-6 xl:gap-10 py-8">
        <a href="#" class="block lg:hidden h-8 w-8 sm:w-10 sm:h-10" data-open_mobile_nav>
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16"
                class="w-8 h-8">
                <path fill-rule="evenodd"
                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg>
        </a>
        <a href="<?php echo get_home_url();?>" class="block h-9  xl:h-9 2xl:h-14 shrink-0">
            <img src="<?php echo THEME_IMG . '/logo.svg' ?>" alt="BOARDHOUSE" class="h-full block shrink-0">
        </a>
        <!--  Site Nav  -->
        <div class="hidden lg:flex items-center justify-start gap-5 2xl:gap-10 w-full" data-nav>
            <?php
			$menu = wp_get_menu_array( 'primary' );
			?>
            <?php foreach ( $menu['menus'] as $value ) : ?>
            <div class="nav-menu-item-wrapper">
                <a href="<?php echo $value['url']; ?>"
                    class="nav-menu-item uppercase font-medium text-md 2xl:text-lg hover:text-orange focus:text-light-gray transition-all">
                    <?php echo $value['title']; ?>
                </a>
                <?php
                    $submenus = $value['children'];
                    if (sizeof($submenus) > 0 ) :
                    ?>
                <div class="nav-menu-subitems">
                    <?php foreach ($submenus as $sub) : ?>
                    <a href="<?php echo $sub['url']; ?>"
                        class="nav-menu-item uppercase font-medium text-md 2xl:text-lg hover:text-orange focus:text-light-gray transition-all">
                        <?php echo $sub['title']; ?>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <!--  Nav Tel  -->
        <div class="hidden lg:flex items-center shrink-0 gap-4">
            <?php
            $tel_sys = get_field('tel_sys', 'options');
            $tel = get_field('tel', 'options');
            $tel_text = get_field('tel_text', 'options');
            ?>
            <img src="<?php echo THEME_IMG . '/tel.svg'; ?>" alt="Telefon" class="h-5">
            <div class="flex flex-col">
                <a href="tel:<?php echo $tel_sys ?>"
                    class="font-bold xl:text-md 2xl:text-lg text-green"><?php echo $tel ?></a>
                <span class="text-xs xl:text-sm 2xl:text-md"><?php echo $tel_text ?></span>
            </div>
        </div>
        <!--  User Nav  -->
        <div class="flex gap-0.5 items-center lg:pl-5 lg:border-l-2 border-l-light-gray shrink-0 relative">
            <a href="#"
                class="hidden lg:block p-2 2xl:p-3 rounded-full transition-all hover:text-white hover:bg-orange hover:shadow-light-gray hover:shadow-lg focus:bg-light-gray focus:text-dark"
                data-make_search>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" class="fill-current h4 w-4 2xl:h-5 2xl:w-5">
                    <path
                        d="M15.01,10.51c-.29,.77-.7,1.47-1.21,2.1l4.08,4.08c.16,.16,.16,.43,0,.59l-.59,.59c-.16,.16-.43,.16-.59,0l-4.08-4.08c-.63,.51-1.33,.92-2.1,1.21-.86,.33-1.78,.51-2.75,.51-2.14,0-4.08-.87-5.48-2.27C.87,11.84,0,9.9,0,7.76S.87,3.68,2.27,2.27C3.68,.87,5.61,0,7.76,0s4.08,.87,5.48,2.27,2.27,3.34,2.27,5.48c0,.97-.18,1.9-.51,2.75h0Zm-11.55,1.54c1.1,1.1,2.62,1.78,4.3,1.78s3.2-.68,4.3-1.78c1.1-1.1,1.78-2.62,1.78-4.3s-.68-3.2-1.78-4.3c-1.1-1.1-2.62-1.78-4.3-1.78s-3.2,.68-4.3,1.78c-1.1,1.1-1.78,2.62-1.78,4.3s.68,3.2,1.78,4.3Z" />
                </svg>
            </a>
            <a href="<?php echo get_home_url() . '/lista-zyczen/' ?>"
                class="hidden lg:block p-2 2xl:p-3 rounded-full transition-all hover:text-white hover:bg-orange hover:shadow-light-gray hover:shadow-lg focus:bg-light-gray focus:text-dark relative">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21.2 18"
                    class="fill-current h4 w-4 2xl:h-5 2xl:w-5">
                    <path
                        d="M17.69,.31c.59,.22,1.09,.55,1.51,.91,.82,.69,1.39,1.54,1.71,2.5,.32,.97,.39,2.05,.2,3.2-.37,2.21-2.85,4.34-5.66,6.74-1.52,1.3-3.14,2.69-4.54,4.19l-.02,.02c-.17,.16-.44,.15-.6-.02-1.39-1.5-3-2.88-4.51-4.18C2.96,11.28,.48,9.14,.11,6.93-.08,5.77-.02,4.68,.29,3.71c.31-.95,.87-1.79,1.69-2.48h0c.42-.37,.92-.7,1.52-.92,.52-.2,1.1-.31,1.74-.31,.96,0,2.04,.27,3.11,.93,.76,.48,1.52,1.16,2.24,2.1,.71-.94,1.47-1.62,2.24-2.1,1.08-.67,2.16-.94,3.13-.94,.64,0,1.21,.12,1.73,.31h0Zm-2.83,11.62c2.29-1.95,4.3-3.66,4.54-5.14,.14-.87,.11-1.71-.13-2.46-.22-.69-.6-1.3-1.16-1.78l-.03-.03c-.3-.26-.63-.47-.99-.6-.35-.13-.73-.2-1.13-.2-.6,0-1.41,.15-2.27,.7-.66,.42-1.36,1.08-2.04,2.07l-.7,1.04s-.07,.09-.12,.12c-.2,.13-.46,.08-.59-.12l-.71-1.04c-.68-1-1.37-1.66-2.03-2.08-.86-.55-1.65-.7-2.25-.7h0c-.4,0-.79,.07-1.14,.21-.36,.14-.7,.34-.98,.59h0c-.58,.49-.96,1.11-1.18,1.8-.23,.75-.27,1.6-.12,2.48,.25,1.5,2.28,3.23,4.6,5.22l.4,.34c.69,.59,1.39,1.19,2.06,1.78,.58,.52,1.15,1.05,1.71,1.6,.56-.55,1.14-1.09,1.71-1.6,.66-.59,1.37-1.19,2.06-1.78l.49-.42Z" />
                </svg>
                <div class="flex h-5 w-5 items-center justify-center text-sm font-bold bg-green text-white rounded-full absolute -top-1.5 -right-1.5 opacity-0 transition-all"
                    data-wish_counter>
                    1
                </div>
            </a>
            <a href="<?php echo get_home_url() . '/moje-konto' ?>"
                class="hidden lg:block p-2 2xl:p-3 rounded-full transition-all hover:text-white hover:bg-orange hover:shadow-light-gray hover:shadow-lg focus:bg-light-gray focus:text-dark">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.1 18.76"
                    class="fill-current h4 w-4 2xl:h-5 2xl:w-5">
                    <path
                        d="M9.05,.38c1.3,0,2.47,.53,3.32,1.38,.85,.85,1.38,2.03,1.38,3.32s-.53,2.47-1.38,3.32c-.85,.85-2.03,1.38-3.32,1.38s-2.47-.53-3.32-1.38c-.85-.85-1.38-2.03-1.38-3.32s.53-2.47,1.38-3.32c.85-.85,2.03-1.38,3.32-1.38h0Zm2.65,2.05c-.68-.68-1.62-1.1-2.65-1.1s-1.97,.42-2.65,1.1c-.68,.68-1.1,1.62-1.1,2.65s.42,1.97,1.1,2.65c.68,.68,1.62,1.1,2.65,1.1s1.97-.42,2.65-1.1c.68-.68,1.1-1.62,1.1-2.65s-.42-1.97-1.1-2.65h0ZM1.33,17.94c-.02,.26-.25,.46-.51,.44-.26-.02-.46-.25-.44-.51,.18-2.24,1.22-4.25,2.78-5.68,1.55-1.43,3.62-2.3,5.89-2.3s4.34,.87,5.89,2.3c1.56,1.44,2.6,3.44,2.78,5.68,.02,.26-.17,.49-.44,.51-.26,.02-.49-.17-.51-.44-.16-2-1.09-3.78-2.48-5.06-1.38-1.27-3.22-2.04-5.24-2.04s-3.87,.77-5.24,2.04c-1.39,1.28-2.31,3.06-2.48,5.06h0Z" />
                </svg>
            </a>
            <a href="<?php echo get_home_url() . '/koszyk'; ?>"
                class="p-2 2xl:p-3 rounded-full transition-all hover:text-white hover:bg-orange hover:shadow-light-gray hover:shadow-lg focus:bg-light-gray focus:text-dark relative">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22.92 20"
                    class="fill-current h-5 w-5 sm:h-7 sm:w-7 lg:h4 lg:w-4 2xl:h-5 2xl:w-5">
                    <path
                        d="M15.86,15.02c.53-.53,1.26-.86,2.06-.86s1.53,.33,2.06,.86c.53,.53,.86,1.26,.86,2.06s-.33,1.53-.86,2.06c-.53,.53-1.26,.86-2.06,.86s-1.53-.33-2.06-.86c-.53-.53-.86-1.26-.86-2.06s.33-1.53,.86-2.06h0Zm1.18,2.94c.23,.23,.54,.37,.88,.37s.64-.13,.87-.35l.02-.02c.23-.23,.37-.54,.37-.88s-.14-.66-.37-.88c-.23-.23-.54-.37-.88-.37s-.64,.13-.87,.35l-.02,.02c-.23,.23-.37,.54-.37,.88s.14,.66,.37,.88h0ZM22.89,3.9l-3.33,8.73c-.05,.17-.21,.29-.4,.29H8.33c-.16,0-.32-.1-.39-.26L3.47,1.67H.42c-.23,0-.42-.19-.42-.42V.42c0-.23,.19-.42,.42-.42h3.75c.15,0,.3,.09,.37,.23l1.55,3.1H22.5s.1,0,.15,.03c.21,.08,.32,.32,.24,.54h0Zm-4.43,7.35l2.21-6.25H6.45l2.57,6.25h9.43Zm-9.68,3.77c.53-.53,1.26-.86,2.06-.86s1.53,.33,2.06,.86c.53,.53,.86,1.26,.86,2.06s-.33,1.53-.86,2.06c-.53,.53-1.26,.86-2.06,.86s-1.51-.32-2.04-.83l-.02-.02c-.53-.53-.86-1.26-.86-2.06s.33-1.53,.86-2.06h0Zm1.18,2.94c.23,.23,.54,.37,.88,.37s.64-.13,.87-.35l.02-.02c.23-.23,.37-.54,.37-.88s-.14-.66-.37-.88h0c-.23-.23-.54-.37-.88-.37s-.66,.14-.88,.37c-.23,.23-.37,.54-.37,.88s.14,.66,.37,.88Z" />
                </svg>
                <div class="flex h-5 w-5 items-center justify-center text-sm font-bold bg-green text-white rounded-full absolute -top-1.5 -right-1.5 opacity-0 transition-all"
                    data-cart_counter>
                    1
                </div>
            </a>
            <div class="searchform hidden absolute top-16 w-80 right-0 border-dark border z-50 transition-all"
                data-searchform>
                <?php echo do_shortcode('[fibosearch]'); ?>
            </div>
        </div>
    </div>

</div>