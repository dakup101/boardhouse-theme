<?php /* Template Name: Sam Text */ ?>
<?php get_header() ?>
<main class="page-text pb-10">
    <section class="container mx-auto">
        <div class="mt-8 mb-12">
            <?php  woocommerce_breadcrumb() ?>
        </div>
    </section>
    <section class="container mx-auto">
        <?php echo get_field('text'); ?>
    </section>
</main>
<?php get_footer() ?>