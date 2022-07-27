<?php /* Template Name: Sam Text */ ?>
<?php get_header() ?>
<main class="page-text pb-10">
    <section class="container mx-auto">
        <div class="mt-8 mb-12">
            <?php  woocommerce_breadcrumb() ?>
        </div>
    </section>
    <section class="container mx-auto">
        <div class="w-full lg:10/12 xl:w-8/12 mx-auto">
            <?php echo get_field('text'); ?>
        </div>
    </section>
</main>
<?php get_footer() ?>