<?php
$zalupas = [1,2,3,4,5,6,7,8];
foreach ($zalupas as $zalupa):
?>

<div class="cat-box relative aspect-square w-full overflow-hidden">
    <a href="#" class="absolute w-full h-full top-0 left-0 bg-dark/70 flex items-center justify-center gap-10 flex-col z-20 hover:bg-green/60 focus:bg-dark/30 transition-all">
        <img src="<?php echo THEME_IMG . '/deska.svg' ?>" alt="" class="w-1/2 h-1/3">
        <div class="text-white font-medium uppercase text-4xl">Deski</div>
    </a>
    <img src="<?php echo THEME_IMG . '/thumb.jpg'?>" alt="" class="absolute top-0 left-0 w-full h-full z-10 transition-all">
</div>

<?php endforeach; ?>