<?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')) { ?>
<footer class="mh-footer mh-row clearfix">
	<?php if (is_active_sidebar('footer-1')) { ?>
	<div class="mh-col-1-4 mh-widget-col-1 mh-footer-area mh-footer-1">
		<?php dynamic_sidebar('footer-1'); ?>
	</div>
	<?php } ?>
	<?php if (is_active_sidebar('footer-2')) { ?>
	<div class="mh-col-1-4 mh-widget-col-1 mh-footer-area mh-footer-2">
		<?php dynamic_sidebar('footer-2'); ?>
	</div>
	<?php } ?>
	<?php if (is_active_sidebar('footer-3')) { ?>
	<div class="mh-col-1-4 mh-widget-col-1 mh-footer-area mh-footer-3">
		<?php dynamic_sidebar('footer-3'); ?>
	</div>
	<?php } ?>
	<?php if (is_active_sidebar('footer-4')) { ?>
	<div class="mh-col-1-4 mh-widget-col-1 mh-footer-area mh-footer-4">
		<?php dynamic_sidebar('footer-4'); ?>
	</div>
	<?php } ?>
</footer>
<?php } ?>
<div class="copyright-wrap">
	<p class="copyright"><?php printf(__('Copyright &copy; %1$s | WordPress Theme by %2$s', 'mh-magazine-lite'), date("Y"), '<a href="' . esc_url('http://www.mhthemes.com/') . '" rel="nofollow">MH Themes</a>'); ?></p>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>