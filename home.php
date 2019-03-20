<?php /* Template Name: HomePage */ ?>

<?php get_header('home'); ?>

<?php
   /* $current_user = wp_get_current_user();

    echo 'Username: ' . $current_user->user_login . '<br />';
    echo 'User email: ' . $current_user->user_email . '<br />';
    echo 'User first name: ' . $current_user->user_firstname . '<br />';
    echo 'User last name: ' . $current_user->user_lastname . '<br />';
    echo 'User display name: ' . $current_user->display_name . '<br />';
    echo 'User ID: ' . $current_user->ID . '<br />';*/
?>

<section class="project">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <h2>dự án nổi bậT</h2>
      </div>
    </div>
  </div>
  <ul class="project-top-lst clearfix">

    <?php 

      $args = array (
            'posts_per_page' => 5,
            'post_type' => 'projects',
            'order' => 'DESC',
            'orderby' => 'date'
          );
          $projects = new WP_Query($args);

          while ($projects->have_posts()) : $projects->the_post();    
    ?>
    
      <li> <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" />
      <div> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> 
        <span><em class="location"><?php the_field('dia_chi') ?></em><em class="pro-name"><?php the_title(); ?></em></span> </a> </div>
      </li>

     <?php endwhile; wp_reset_postdata(); ?>

    
    
  </ul>
</section>

<?php get_template_part( 'inc/content', 'page' ); ?>

<?php get_footer(); ?>