<?php
$status = count_user_cart();
$status['remains'] < 0 ? $is_free = true : $is_free = false;
?>

<div data_cart-status class="flex items-center gap-4 opacity-50 transition-all">
    <svg data-cart_status_svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 56.21 24.7" class="h-8 shrink-0">
        <defs>
            <style>
            .b {
                fill: #1e1e1f;
            }

            .c {
                stroke-width: 1.54px;
            }

            .c,
            .d {
                fill: none;
                stroke: #1e1e1f;
                stroke-miterlimit: 10;
            }

            .d {
                stroke-width: 1.41px;
            }
            </style>
        </defs>
        <rect class="c" x="19.11" y="1.89" width="17.98" height="10.75" />
        <line class="d" x1="7.5" y1=".7" x2="16.3" y2=".7" />
        <line class="d" x1="2.71" y1="4.07" x2="11.51" y2="4.07" />
        <g>
            <path class="b"
                d="M49.57,17.64c-.28,0-.47-.01-.56-.02H8.54C2.61,17.63,.27,14.42,.18,14.28c-.31-.44-.21-1.05,.23-1.36,.44-.31,1.04-.21,1.36,.23,.09,.12,1.93,2.52,6.77,2.52H49.13s3.49,.26,5.41-1.67c.38-.38,1-.38,1.38,0,.38,.38,.38,1,0,1.38-2.02,2.02-5.06,2.25-6.35,2.25Z" />
            <path class="b"
                d="M11.55,18.52c-1.71,0-3.09,1.38-3.09,3.09s1.38,3.09,3.09,3.09,3.09-1.38,3.09-3.09-1.38-3.09-3.09-3.09Zm0,4.72c-.9,0-1.63-.73-1.63-1.63s.73-1.63,1.63-1.63,1.63,.73,1.63,1.63-.73,1.63-1.63,1.63Z" />
            <path class="b"
                d="M45.71,18.52c-1.71,0-3.09,1.38-3.09,3.09s1.38,3.09,3.09,3.09,3.09-1.38,3.09-3.09-1.38-3.09-3.09-3.09Zm0,4.72c-.9,0-1.63-.73-1.63-1.63s.73-1.63,1.63-1.63,1.63,.73,1.63,1.63-.73,1.63-1.63,1.63Z" />
        </g>
    </svg>
    <div class="w-full">
        <p data-status_bar_text class="font-bold mb-1">
            <?php if (!$is_free) : ?>
            Do darmowej dostawy brakuje <?php echo $status['remains'] ?> zł
            <?php else : ?>
            Obowiązuje Cię darmowa wysyłka
            <?php endif; ?>
        </p>
        <div class="relative bg-light-gray w-full h-2 rounded-full overflow-hidden">
            <div data-status_bar data-percent="<?php echo $status['percent'] ?>"
                class="absolute top-50 left-0 -translat-y-1/2 h-full <?php echo $is_free ? 'bg-green' : 'bg-orange';  ?> transition-all w-0">
            </div>
        </div>
    </div>
</div>