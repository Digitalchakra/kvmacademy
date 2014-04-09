<?php
/* *
 * Part Name: Default Footer
 */
?>
<footer id="colophon" class="site-footer" role="contentinfo">

	<div id="footer-widgets" class="full-container">
		<?php dynamic_sidebar( 'sidebar-footer' ) ?>
	</div><!-- #footer-widgets -->

	<?php $site_info_text = apply_filters('vantage_site_info', siteorigin_setting('general_site_info_text') ); if( !empty($site_info_text) ) : ?>
		<div id="site-info">
			<?php echo wp_kses_post($site_info_text) ?>
		</div><!-- .site-info -->
	<?php endif; ?>

	 <?php echo apply_filters( 'vantage_footer_attribution', '<!-- <div id="theme-attribution"> <div>Crafted By</div>'. sprintf( __('<a href="%s"><img src="http://localhost/wp/wp-content/uploads/2014/02/digitalchakra.png"></a>'), 'http://digitalchakra.in') . '</div> -->' ) ?> 

</footer><!-- #colophon .site-footer -->