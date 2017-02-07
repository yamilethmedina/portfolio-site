<?php
/*
Template Name: FrontPage
*/
get_header();
?>


<aside id="slider_wrap">
<!--div id="slider">


</div--><!-- END: #slider -->
	<div id="slider_home">
	<div class="flexslider">
		<ul class="slides">
			<?php 
				$type = 'slider';
				$args=array(
					'post_type' => $type,
					'post_status' => 'publish',
					'posts_per_page' => -1,
					'orderby' => 'menu_order',
					'order' => 'asc'
				);
				$temp = $wp_query;  // assign original query to temp variable for later use   
				$wp_query = null;
				$wp_query = new WP_Query($args);

				if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
					$custom = get_post_custom($post->ID);

					$slider_image = get_the_post_thumbnail($post->ID, 'homepageslider', array('title' => the_title_attribute('echo=0')));
					
					$slider_website_url = '';
					$slider_description = '';
					$custom = get_post_custom($post->ID);
					$slider_website_url = $custom["slider_website_url"][0];
					$slider_description = $custom["slider_description"][0];
					
					$slider_description_output = '';
					if ($slider_description) {
						$slider_description_output = '<p class="flex-caption">'.$slider_description.'</p>';
					}
					
					$slider_video_url = trim($custom["slider_video_url"][0]);
					
					if ($slider_video_url == '') {
			?>
			<li>
				<a href="<?php echo $slider_website_url; ?>"><?php echo $slider_image; ?></a>
				<?php echo $slider_description_output; ?>
			</li> 
			<?php			
					} else {
			?>
			<li>
				<div class="video-container"><iframe id="player" src="<?php echo $slider_video_url; ?>" frameborder="0"></iframe>
				<?php //echo $slider_description_output; ?></div>
			</li> 
			<?php
					}
					
				endwhile;
				endif; 
				
				$wp_query = null;
				$wp_query = $temp; 
			?>
		</ul>
	</div>
	</div>
	<!-- /End Full Width Slider-->
		
</aside><!-- END: #slider_wrap -->

<section id="main-content">
	<div class="center_wrap">
	
		<section id="content" class="full_width container_shadow">

				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>					
							<?php the_content(); ?>
				<?php endwhile; ?>	
			
		</section>
		
    </div>
</section><!-- END: #main-content -->
 
<?php get_footer(); ?>