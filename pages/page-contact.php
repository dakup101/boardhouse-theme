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
				<?php $col_1 = get_field('col_1'); ?>
				<h2 class="text-2xl font-bold"><?php echo $col_1['naglowek_1']; ?></h2>
				<p class="mt-5"><?php echo $col_1['content_1'] ?></p>
				<a href="mailto:<?php echo $col_1['email_1'] ?>"
				   class="text-lg font-medium text-green hover:text-orange underline block mt-5"><?php echo $col_1['email_1'] ?></a>
				<a href="tel:<?php echo $col_1['tel'] ?>" class="text-lg font-medium text-green hover:text-orange block"><?php echo $col_1['tel'] ?></a>
				<h2 class="text-2xl font-bold mt-10"><?php echo $col_1['naglowek_2'] ?></h2>
				<p class="mt-5"><?php echo $col_1['content_2'] ?></p>
				<a href="mailto:<?php echo $col_1['email_2'] ?>"
				   class="text-lg font-medium text-green hover:text-orange underline block mt-5 mb-10"><?php echo $col_1['email_2_text'] ?></a>
			</div>
			<div class="mb-10">
				<?php $col_2 = get_field('col_2'); ?>
				<h2 class="text-2xl font-bold"><?php echo $col_2['naglowek']; ?></h2>
				<p class="mt-5">
					<strong>
						<?php echo $col_2['addr'] ?>
					</strong>
				</p>
				<?php foreach($col_2['sm'] as $sm) : ?>
				<a href="<?php echo $sm['link'] ?>" class="text-lg font-medium text-green hover:text-orange block mt-5"><?php echo $sm['text'] ?></a>
				<?php endforeach; ?>
				<div class="mt-5 flex flex-col gap-10">
					<?php echo $col_2['info']; ?>
				</div>
			</div>
			<div class="mb-10 lg:col-span-2">
				<h2 class="text-2xl font-bold mb-5">Napisz do nas</h2>
				<?php echo do_shortcode( '[contact-form-7 id="6667" title="Formularz 1"]') ?>
				<div class="btn-green hidden"></div>
			</div>
		</div>
	</section>
	<section class="container mx-auto mb-10">
		<div class="xl:w-10/12 mx-auto">
			<iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=boardhouse%20malborska%2096&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
		</div>
	</section>
	<section class="container mx-auto">
		<?php get_template_part('/components/boardhouse-icons-row'); ?>
	</section>
</main>
<?php get_footer() ?>