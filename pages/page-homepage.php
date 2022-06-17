<?php /* Template Name: Strona Główna */ ?>
<?php get_header() ?>
<main class="mb-40">
    <section class="container mx-auto">
        <?php get_template_part('/components/boardhouse-hero'); ?>
    </section>
    <section class="container mx-auto mt-10">
        <div class="grid grid-cols-4 gap-8">
            <?php get_template_part('/components/boardhouse-cat-box'); ?>
        </div>
    </section>
    <section class="container mx-auto mt-10">
        <h2 class="text-center font-medium uppercase tracking-wider text-2xl mb-8">Ostatnio dodane Produkty</h2>
			<?php get_template_part('/components/boardhouse-products-carousel', null, array("id"=>1, "amount"=>18, "sale"=>false)); ?>
    </section>
    <section class="mt-10">
	    <?php get_template_part('/components/boardhouse-product-promo'); ?>
    </section>
    <section class="container mx-auto mt-10">
        <h2 class="text-center font-medium uppercase tracking-wider text-2xl mb-8">Promocyjne produkty</h2>
		<?php get_template_part('/components/boardhouse-products-carousel', null, array("id"=>1, "amount"=>18, "sale"=>true)); ?>
    </section>
    <section class="mt-10">
		<?php get_template_part('/components/boardhouse-cta'); ?>
    </section>
    <section class="my-28 container mx-auto">
	    <?php get_template_part('/components/boardhouse-icons-row'); ?>
    </section>
</main>
<?php get_footer() ?>
