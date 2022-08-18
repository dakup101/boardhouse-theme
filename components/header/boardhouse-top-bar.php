<?php
$tb1 = get_field('top_bar_1', 'options');
$tb2 = get_field('top_bar_2', 'options');
$tb3 = get_field('top_bar_3', 'options');
?>

<div class="bg-dark" data-top_bar>
    <div class="container flex justify-center lg:justify-between items-center gap-2 mx-auto text-white text-sm py-3.5">
        <!-- Kolumna 1 -->
        <?php if ($tb1['text']) : ?>
        <div class="hidden lg:flex flex-row items-center justify-between gap-3 text-xs 2xl:text-sm">
            <?php if ($tb1['icon']) : ?>
            <img src="<?php echo $tb1['icon'] ?>" alt="Boardhouse" class="h-4">
            <?php endif; ?>
            <span> <?php echo $tb1['text']; ?>
                <?php if ($tb2['link']) : ?>
                <a href="<?php echo $tb2['link'] ?>" target="_blank" class="text-orange decoration-0">
                    <?php echo $tb2['link_text'] ?>
                </a>
                <?php endif; ?>
            </span>
        </div>
        <?php endif; ?>
        <!-- Kolumna 2 -->
        <?php
        $coupon = new WC_coupon($tb2['kupon']->post_title);
        $coupon->get_date_expires() ? $expires = $coupon->get_date_expires() : $expires = null; 
        $tb2['show'] == "1" ? $show_coupon = true : $show_coupon = false;
        if ($show_coupon):
        ?>
        <div class="flex flex-row items-center justify-between gap-3 text-xs 2xl:text-sm ">
            <span class="text-green text-xs 2xl:text-sm font-medium uppercase text-center sm:text-left">
                <?php echo $tb2['text'] ?>
            </span>
            <span class="text-center sm:text-left">
                <?php echo $tb2['text_2'] . ' "' . $coupon->get_code() . '"'; ?>
            </span>
            <?php if ($expires) : ?>
            <span data-promo_timer class="text-sm text-center sm:text-left"
                data-coupon_expires="<?php echo date("D M d Y H:i:s O", strtotime($expires)) ?>">
                <span data-coupon_days class="font-medium text-xs 2xl:text-sm"></span>
                <span data-coupon_hours class="font-medium text-xs 2xl:text-sm"></span>
                <span data-coupon_minutes class="font-medium text-xs 2xl:text-sm"></span>
            </span>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <!-- Kolumna 3 -->
        <?php if ($tb3['text']) : ?>
        <div class="hidden lg:flex flex-row items-center justify-between gap-3 text-xs 2xl:text-sm">
            <?php if ($tb3['icon']) : ?>
            <img src="<?php echo $tb3['icon'] ?>" alt="Boardhouse" class="h-4">
            <?php endif; ?>
            <span> <?php echo $tb3['text']; ?>
                <?php if ($tb3['link']) : ?>
                <a href="<?php echo $tb3['link'] ?>" target="_blank" class="text-orange decoration-0">
                    <?php echo $tb3['link_text'] ?>
                </a>
                <?php endif; ?>
            </span>
        </div>
        <?php endif; ?>
    </div>
</div>