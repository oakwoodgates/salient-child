<?php 
/*template name: Login Page Template */
get_header(); ?>
	
<div id="login-page">

	<div class="login-page-container container">
	
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
				<?php the_content(); ?>
	
			<?php endwhile; endif; ?>
				
	</div><!--/container-->

</div><!--/home-wrap-->
	
<?php get_footer(); ?>