<?php
$cats = get_field('cats');
if ($cats) :
foreach ($cats as $el):
?>

<div class="cat-box relative aspect-square w-full overflow-hidden">
    <a href="<?php echo get_term_link($el['link']); ?>"
        class="absolute w-full h-full top-0 left-0 flex items-center justify-center gap-10 flex-col z-20 hover:bg-green/60 focus:bg-dark/20 transition-all">
        <img src="<?php echo $el['img'] ?>" alt="" class="w-auto h-1/2">
        <div class="text-white font-medium uppercase text-xl sm:text-2xl xl:text-3xl 2xl:text-4xl">
            <?php echo $el['name']; ?></div>
    </a>
    <img src="<?php echo $el['bg'] ?>" alt="" class="absolute top-0 left-0 w-full h-full z-10 transition-all">
</div>

<?php endforeach; ?>
<?php endif; ?>