
<?php /* Template Name: CamOn */ ?>
<?php get_header(); ?>


<section class="wrap-box">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <ul class="path clearfix">
          <li><a href="#">Trang chủ</a></li>
          <li><?php the_title();   ?></li>
        </ul>
      </div>
    </div>
    <div class="row">
    
      <div class="col-sm-12 col-md-12 col-lg-12">
      	 
      	    <?php if (have_posts()): while (have_posts()) : the_post();?>

      	    	<div style="padding: 10px 0px 50px 0px; text-align: center;">
      	 				<?php the_content(); ?>
      			</div>
      	    		 
      	     <?php endwhile; endif; ?>        
      </div>
    </div>
  </div>
</section>





<?php get_footer(); ?>