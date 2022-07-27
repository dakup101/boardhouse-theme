<footer class="bg-light-gray">
    <?php get_template_part('/components/boardhouse-footer'); ?>
    <?php get_template_part('/components/boardhouse-footer-copy'); ?>
    <script type="text/javascript"
        src="<?php echo get_template_directory_uri(); ?>/assets/cookies/divante.cookies.min.js">
    </script>
    <script>
    window.jQuery.cookie || document.write(
        '<script src="<?php echo get_template_directory_uri(); ?>/assets/cookies/jquery.cookie.min.js"><\/script>')
    </script>
    <script>
    jQuery(function($) {
        $.divanteCookies.render({
            privacyPolicy: true,
        });
    });
    </script>
    <?php wp_footer(); ?>
</footer>
</body>

</html>