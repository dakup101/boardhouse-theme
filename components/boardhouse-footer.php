<div class="container mx-auto py-12 flex flex-col lg:flex-row">
    <div class="w-full lg:w-1/4 flex flex-col items-start justify-center gap-2">
        <img src="<?php echo THEME_IMG . '/logo.svg' ?>" alt="BOARDHOUSE" class="h-14">
        <span class="font-bold text-lg mt-4 block">Skontaktuj się z nami</span>
        <?php
            $tel_sys = get_field('tel_sys', 'options');
            $tel = get_field('tel', 'options');
            $tel_text = get_field('tel_text', 'options');
        ?>
        <div class="flex items-center shrink-0 gap-4">
            <img src="<?php echo THEME_IMG . '/tel.svg'; ?>" alt="Telefon" class="h-5">
            <div class="flex flex-col">
                <a href="<?php echo $tel_sys ?>" class="font-bold text-lg"><?php echo $tel ?></a>
                <span><?php echo $tel_text ?></span>
            </div>
        </div>
    </div>
    <div class="mt-10 lg:mt-0 w-full lg:w-3/4 relative flex flex-col lg:flex-row justify-between gap-6">
        <div class="w-fit">
            <div class="text-lg font-bold mb-3">
                Dane Adresowe
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="flex text-sm flex-col gap-2">
                    <span class="font-light block">Boardhouse</span>
                    <span class="font-light block">ul. Malborska 96</span>
                    <span class="font-light block">30-624</span>
                    <span class="mt-5 font-light block">Sklep jest czynny:</span>
                    <span class="font-light block">pon-pt: 10:00-18:00</span>
                </div>
                <div class="flex text-sm flex-col gap-2">
                    <span class="font-light block">REGION: 122464469</span>
                    <span class="font-light block">NIP: 6792848009</span>
                    <span class="mt-5 font-light block">Nr. konta do wpłat</span>
                    <span class="font-light block">Santander Bank Polska</span>
                    <span class="font-light block">53109020530000000115283469</span>
                </div>
            </div>
        </div>
        <div>
            <div class="text-lg font-bold mb-3">
                Produkty
            </div>
            <div class="flex text-sm flex-col gap-2">
                <?php
                $menu = wp_get_menu_array( 'footer-1' );
                ?>
                <?php foreach ( $menu['menus'] as $value ) : ?>
                <a href="<?php echo $value['url']; ?>"
                    class="font-light block hover:text-green"><?php echo $value['title']; ?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <div>
            <div class="text-lg font-bold mb-3">
                Obsługa Klienta
            </div>
            <div class="flex text-sm flex-col gap-2">
                <?php
                $menu = wp_get_menu_array( 'footer-2' );
                ?>
                <?php foreach ( $menu['menus'] as $value ) : ?>
                <a href="<?php echo $value['url']; ?>"
                    class="font-light block hover:text-green"><?php echo $value['title']; ?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <div>
            <div class="text-lg font-bold mb-3">
                Konto
            </div>
            <div class="flex text-sm flex-col gap-2">
                <?php
                $menu = wp_get_menu_array( 'footer-3' );
                ?>
                <?php foreach ( $menu['menus'] as $value ) : ?>
                <a href="<?php echo $value['url']; ?>"
                    class="font-light block hover:text-green"><?php echo $value['title']; ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>