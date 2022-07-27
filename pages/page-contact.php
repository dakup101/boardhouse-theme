<?php /* Template Name: Kontakt */ ?>
<?php get_header() ?>
<main class="page-text pb-10">
    <section class="container mx-auto">
        <div class="mt-8 mb-12">
            <?php  woocommerce_breadcrumb() ?>
        </div>
    </section>
    <section class="container mx-auto">
        <div class="xl:w-10/12 mx-auto grid grid-cols-1 lg:grid-cols-4 lg:gap-20">
            <div class="mb-10">
                <h2 class="text-2xl font-bold">Obsługa Klienta</h2>
                <p class="mt-5">Aliquam finibus auctor enim. Curabitur imperdiet ipsum vitae pretium lacinia. Nam ac
                    finibus
                    nunc.
                    Nulla hendrerit, enim non dignissim elementum, velit erat varius erat, a molestie neque ligula
                    eu
                    ligula.</p>
                <a href="mailto:biuro@boardhouse.pl"
                    class="text-lg font-medium text-green hover:text-orange underline block mt-5">biuro@boardhouse.pl</a>
                <a href="tel:+48693081786" class="text-lg font-medium text-green hover:text-orange block">+48 693
                    081 786</a>
                <h2 class="text-2xl font-bold mt-10">Współpraca</h2>
                <p class="mt-5">Aliquam finibus auctor enim. Curabitur imperdiet ipsum vitae pretium lacinia. Nam ac
                    finibus
                    nunc.
                    Nulla hendrerit, enim non dignissim elementum, velit erat varius erat, a molestie neque ligula
                    eu
                    ligula.</p>
                <a href="mailto:biuro@boardhouse.pl"
                    class="text-lg font-medium text-green hover:text-orange underline block mt-5">Podejmij z
                    nami
                    współpracę</a>
            </div>
            <div class="mb-10">
                <h2 class="text-2xl font-bold">Sklep stacjonarny</h2>
                <p class="mt-5">
                    <strong>
                        Boardhouse <br>
                        ul. Malborska 96 <br>
                        30-624 Kraków
                    </strong>
                </p>
                <a href="https://www.facebook.com/Boardhouse/"
                    class="text-lg font-medium text-green hover:text-orange block mt-5">https://www.facebook.com/Boardhouse/</a>
                <p class="mt-5">
                    REGON: 122464469 <br>
                    NIP: 6792848009
                </p>
                <p class="mt-5">
                    Nr konta do wpłat: <br>
                    Santander Bank Polska <br>
                    53 1090 2053 0000 0001 1528 3469
                </p>
                <p class="mt-5">
                    Sklep jest czynny: <br>
                    poniedziałek - piątek: 10:00 - 18:00
                </p>
            </div>
            <div class="mb-10 lg:col-span-2">
                <h2 class="text-2xl font-bold mb-5">Napisz do nas</h2>
                <?php echo do_shortcode( '[contact-form-7 id="13" title="Formularz 1"]') ?>
                <div class="btn-green hidden"></div>
            </div>
        </div>
    </section>
    <section class="container mx-auto">
        <?php get_template_part('/components/boardhouse-icons-row'); ?>
    </section>
</main>
<?php get_footer() ?>