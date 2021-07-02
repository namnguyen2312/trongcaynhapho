<?php $foodfarm_settings = foodfarm_check_theme_options();
$footer_type = foodfarm_get_footer_type();
?> 
	</div><!--main-->
<?php if (foodfarm_get_meta_value('show_footer', true)) : ?>
<footer id="colophon" class="footer">
    <div class="footer-v<?php echo esc_attr($footer_type); ?>">      
        <?php get_template_part('footers/footer_' . $footer_type); ?>
    </div><!-- .footer-boxed -->
</footer><!-- #colophon -->
<div class="overlay"></div>
<?php endif;?>
</div><!--page-->
<?php if (isset($foodfarm_settings['js-code'])): ?>
    <script type="text/javascript">
    <?php echo $foodfarm_settings['js-code']; ?>
    </script>
<?php endif; ?>
<?php wp_footer(); ?>

</body>
</html>