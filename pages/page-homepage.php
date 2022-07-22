<?php /* Template Name: Strona Główna */ ?>
<?php get_header() ?>
<main>
  <section class="container mx-auto">
      <?php get_template_part( '/components/boardhouse-hero' ); ?>
  </section>
  <section class="container mx-auto mt-10">
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
          <?php get_template_part( '/components/boardhouse-cat-box' ); ?>
      </div>
  </section>
  <section class="container mx-auto mt-12">
      <div class="grid grid-cols-1 sm:grid-cols-3 items-center mb-12">
          <div class="hidden sm:block"></div>
          <h2 class="text-center font-medium uppercase tracking-wider text-2xl ">Ostatnio dodane Produkty</h2>
          <div class="flex justify-center sm:justify-end">
              <a class="font-light underline text-orange hover:text-green transition-all"
                  href="<?php echo get_home_url() . '/sklep' ?>">Zobacz wszystkie produkty</a>
          </div>
      </div>
      <?php get_template_part( '/components/boardhouse-products-carousel', null, array( "id"     => 1,
                                                                                    "amount" => 18,
                                                                                    "sale"   => false
  ) ); ?>
  </section>
  <section class="mt-10">
      <?php get_template_part( '/components/boardhouse-product-promo' ); ?>
  </section>
  <section class="container mx-auto mt-12">
      <div class="grid grid-cols-1 sm:grid-cols-3 items-center mb-12">
          <div class="hidden sm:block"></div>
          <h2 class="text-center font-medium uppercase tracking-wider text-2xl ">Promocyjne produkty</h2>
          <div class="flex justify-center sm:justify-end">
              <a class="font-light underline text-orange hover:text-green transition-all"
                  href="<?php echo get_home_url() . '/sklep' ?>">Zobacz wszystkie produkty</a>
          </div>
      </div>
      <?php get_template_part( '/components/boardhouse-products-carousel', null, array( "id"     => 2,
                                                                                    "amount" => 18,
                                                                                    "sale"   => true
  ) ); ?>
  </section>
  <section class="mt-10">
      <?php get_template_part( '/components/boardhouse-cta' ); ?>
  </section>
  <section class="my-28 container mx-auto">
      <?php get_template_part( '/components/boardhouse-icons-row' ); ?>
  </section>
</main>
<?php get_footer() ?>