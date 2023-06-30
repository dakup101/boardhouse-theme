<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 icons-row-wrapper">
	<?php foreach(get_field('footer_icons', 'options') as $icon) : ?>
    <div class="flex gap-8 items-center justify-start  lg:justify-center">
        <img src="<?php echo $icon['icon'] ?>" alt="" class="h-20 w-auto" >
        <div class="flex flex-col gap-1">
            <div class="text-lg font-medium uppercase">
                <?php echo $icon['text_bold']; ?>
            </div>
            <div class="font-light">
                <?php echo $icon['text']; ?>
            </div>
        </div>
    </div>
	<?php endforeach; ?>
</div>
