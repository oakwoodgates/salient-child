<?php
/*
Template Name: BTC Order Template
*/
get_header(); ?>

<?php nectar_page_header($post->ID); ?>
<script>
jQuery(window).load(function(){
setTimeout(function(){jQuery("th.ussr-component-grid-header-item[data-modelattr=price]").html("Price (USD)");}, 1000);
});
</script>
<link href="<?php echo get_site_url(); ?>/wp-content/themes/salient-child/BTC-orderpage.css" rel="stylesheet" type="text/css" />

<div id="order-header" class="custom-header">
    <div class="custom-header-wrapper">
        <img src="<?php echo get_site_url(); ?>/wp-content/uploads/BT-Header-Logo-@2x.png" alt="Biddy logo" />
    </div>
</div>
<div id="order-main" class="container-wrap order-container-wrap">
	
	<div class="container main-content">
		
		<div class="row">
            
			<div id="post-area" class="col span_9 order-post-area">
			<?php 

			//breadcrumbs
			if ( function_exists( 'yoast_breadcrumb' ) && !is_home() && !is_front_page() ){ yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } 

			 //buddypress
			 global $bp; 
			 if($bp && !bp_is_blog_page()) echo '<h1>' . get_the_title() . '</h1>'; ?>
			
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
				<?php the_content(); ?>
                
            <?php endwhile; endif; ?>
            </div><!----/span9---->                    
                    
                        
            <div id="sidebar" class="col span_3 col_last order-sidebar-wrap">
                <?php if(has_post_thumbnail()){ ?>                                     
                <div id="order-sb-thmb" >
                    <?php the_post_thumbnail("full");?>
                </div>
                    <?php }	?> 
                <h2><?php echo get_post_meta(get_the_ID(), "Widget Heading", true)?></h2>
                <div id="order-sb-text">
                    <?php echo get_post_meta(get_the_ID(), "Widget Text", true)?>
                </div>
                <?php 
                $extra_photo = get_post_meta(get_the_ID(), "Extra Image", true) ;
                
                if(!empty($extra_photo)) 
                
                { ?> 
                <div id="order-sb-extra">
                    <img class="fullwidth" src="/admin/wp-content/uploads/<?php echo get_post_meta(get_the_ID(), "Extra Image", true)?>" />
                </div>
                <?php } ?>
                
                <div id="order-sb-text">
                    <?php echo get_post_meta(get_the_ID(), "Widget Text 2", true)?>
                </div>
                                            
                
                <div class="feature-box-content">
                    <h2>Need Help?</h2>
  		            <p>Contact us at <a href="mailto:team@biddytarot.com">team@biddytarot.com</a></p>
                </div>
                <?php 
                $testimonial1 = get_post_meta(get_the_ID(), "Testimonial1 Text", true) ;
                
                if(!empty($testimonial1)) 
                
                { ?>  
                <h2 class="purple upper center-text green-brd-btm" style="font-size: 18px;">Why People Love it...</h2>
                <div class="order-sb-test" id="order-sb-testimonial-1">
                    <?php 
                $testimonial1img = get_post_meta(get_the_ID(), "Testimonial1 Photo", true) ;
                
                    if(!empty($testimonial1img))                
                    { ?>
                    
                    <img src="/admin/wp-content/uploads/<?php echo get_post_meta(get_the_ID(), "Testimonial1 Photo", true)?>" class="order-test-photo"/>
                    
                  <?php } ?>
                    
                    <p><?php echo get_post_meta(get_the_ID(), "Testimonial1 Text", true)?></p>
                    <h4><?php echo get_post_meta(get_the_ID(), "Testimonial1 Title", true)?></h4> 
                </div>
                <?php } ?>
                                
                <?php 
                $testimonial2 = get_post_meta(get_the_ID(), "Testimonial2 Text", true) ;
                
                if(!empty($testimonial2)) 
                
                { ?>  
                
                <div class="order-sb-test" id="order-sb-testimonial-2">
                    <?php 
                $testimonial1img = get_post_meta(get_the_ID(), "Testimonial2 Photo", true) ;
                
                    if(!empty($testimonial1img))                
                    { ?>
                    
                    <img src="<?php echo get_site_url(); ?>/wp-content/uploads/<?php echo get_post_meta(get_the_ID(), "Testimonial2 Photo", true)?>" class="order-test-photo"/>
                    
                  <?php } ?>
                    <p><?php echo get_post_meta(get_the_ID(), "Testimonial2 Text", true)?></p>
                    <h4><?php echo get_post_meta(get_the_ID(), "Testimonial2 Title", true)?></h4>
                </div>   
                <?php }	?> 
                         
			</div><!--/span_3-->
		</div><!--/row-->
		
	</div><!--/container-->
    </div>
	

			
<?php get_footer(); ?>