<?php
/*
	Plugin Name:Sitemap Shortcode
	Plugin URI:http://wordpress.org/plugins/sitemap-shortcode/
	Author:Arnob Protim Roy
	Description:This is a sitemap plugin. It will help you to insert your site\'s total sitemap in any page/post/widget by using the shortcode [sitemap] . Just use this shortcode and see the result yourself. If you like it please don\'t forget to give a review. Thanks 
	Tags: sitemap , html , list , auto , bonrapro , shortcode,site,map	
	Author URI:http://bonrapro.wordpress.com
	Version:1.1
	License:GPLv2 or later
*/

// Develop By Arnob Protim Roy
function sitemap_shortcode(){
?>
	<div >			
		<div >
			<div>
				<h2><?php _e('Pages', ''); ?></h2>
				<ul>
					<?php wp_list_pages('title_li='); ?>
				</ul>
			</div>
			<div>
				<h2><?php _e('Categories', ''); ?></h2>
				<ul>
					<?php wp_list_categories('title_li='); ?>
				</ul>
			</div>
			<div>
				<h2><?php _e('Archives', ''); ?></h2>
				<ul>
					<?php wp_get_archives('type=monthly&show_post_count=0'); ?>
				</ul>
			</div>
		</div>
		<div>
			<h2><?php _e('Posts per category', ''); ?></h2>
			<?php
				$cats = get_categories();
				foreach ( $cats as $cat ) {
				query_posts( 'cat=' . $cat->cat_ID );
			?>
				<h3><?php echo $cat->cat_name; ?></h3>
				<ul>	
					<?php while ( have_posts() ) { the_post(); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php } wp_reset_query(); ?>
				</ul>
			<?php } ?>
		</div>						
	</div>
<?php
}

add_shortcode('sitemap','sitemap_shortcode');