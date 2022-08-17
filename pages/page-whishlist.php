<?php /* Template Name: Lista Życzeń */ ?>
<?php get_header() ?>
<main class="page-whishlist pb-10">
    <section class="container mx-auto">
        <h1 class="font-light text-5xl my-10 w-full text-center">Ulubione produkty</h1>
        <?php echo do_shortcode('[woosw_list]') ?>
    </section>
</main>
<?php get_footer() ?>