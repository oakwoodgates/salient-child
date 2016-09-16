<?php 
/*template name: Sales Page Template */
get_header(); ?>
<link href="/wp-content/themes/salient-child/SPstyle.css" type="text/css" rel="stylesheet" />
	
<div id="sales-page" class="container-wrap">
	
	<div class="container sales-page-container main-content">
		
		<div class="row">
	
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
				<?php the_content(); ?>
	
			<?php endwhile; endif; ?>
		</div>
				
	</div><!--/container-->

</div><!--/salespage -wrap-->
	
<?php get_footer(); ?>