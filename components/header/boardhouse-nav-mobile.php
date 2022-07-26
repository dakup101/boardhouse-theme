<div class="mobile-nav fixed  left-0 top-0 h-full w-80 bg-white z-50 border-r border-r-dark/30 shadow-md shadow-dark/30 transition-all -translate-x-full"
    data-mobile_nav>
    <div class="flex justify-between items-center py-3 border-b border-b-dark/30 px-3">
        <a href="<?php echo get_home_url();?>" class="block w-9/12">
            <img src="<?php echo THEME_IMG . '/logo.svg' ?>" alt="BOARDHOUSE" class="h-full block shrink-0">
        </a>
        <a href="#" class="block w-1/12" data-close_mobile_nav>
            <svg id="a" class="w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                <defs>
                    <style>
                    .b {
                        fill: #1e1e1f;
                    }
                    </style>
                </defs>
                <path class="b"
                    d="M16,14.05l-6.12-6.06L15.94,1.87l-1.89-1.87L7.99,6.12,1.87,.06,0,1.93l6.12,6.07L.06,14.13l1.87,1.87,6.07-6.13,6.12,6.07,1.87-1.89Z" />
            </svg>
        </a>
    </div>
    <div class="overflow-hidden">
        <?php echo do_shortcode('[fibosearch]'); ?>
    </div>
    <div class="the_mobile_menu border-t border-t-dark/30 h-full max-h-screen pb-28 overflow-y-auto">
        <?php
			$menu = wp_get_menu_array( 'mobile' );
            
            $data_tab = 0;
			?>
        <?php foreach ( $menu['menus'] as $value ) : $submenus = $value['children']; ?>
        <div class="flex flex-col items-center justify-start w-full" data-nav>
            <div class="w-full border-b border-b-dark/30">
                <a href="<?php echo $value['url']; ?>"
                    data-mobile_tab_for="<?php echo $data_tab ?>" <?php echo sizeof($submenus) > 0 ? 'data-parent="1"' : 'data-parent="0"';?>
                    class=" uppercase font-medium text-md 2xl:text-lg hover:text-orange  <?php echo sizeof($submenus) > 0 ? '' : 'focus:text-light-gray';?> transition-all p-3 flex justify-between items-center">
                    <span> <?php echo $value['title']; ?> </span>
                    <?php if (sizeof($submenus) > 0 ) :?>
                    <svg data-caret enable-background="new 0 0 48 48" viewBox="0 0 48 48"" xml:space=" preserve"
                        class="w-4 h-4 -rotate-90 transition-all" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Layer_4">
                            <polygon fill="#434343"
                                points="47.993,14.121 45.872,12 45.863,12.009 43.752,9.896 24.008,29.641 4.248,9.881 0.007,14.125    0.013,14.13 0.009,14.134 21.679,35.803 21.664,35.816 23.967,38.119 23.98,38.105 23.994,38.119 25.021,37.093 25.029,37.104    47.993,14.141 47.982,14.131  " />
                        </g>
                    </svg>
                    <?php endif; ?>
                </a>
            </div>

            <?php if (sizeof($submenus) > 0 ) :?>
            <div class="flex flex-col w-full h-0 transition-all overflow-hidden" data-mobile_tab="<?php echo $data_tab ?>">
                <?php foreach ($submenus as $sub) : ?>
                <a href="<?php echo $sub['url']; ?>"
                    class="uppercase bg-gray/10 font-medium text-md 2xl:text-lg hover:text-orange focus:text-light-gray transition-all p-3 flex justify-between items-center border-b border-b-dark/30">
                    <?php echo $sub['title']; ?>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php $data_tab++; endforeach; ?>
    </div>
</div>