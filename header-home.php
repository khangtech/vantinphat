<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

<?php wp_head(); ?>

</head>
<body>

<section class="header">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="h-box clearfix">
          <h1><a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri() ?>/images/logo.png" alt="" /></a></h1>
          <div class="h-box-r adjust_width">
            <h2>CÔNG TY TNHH KẾT NỐI ĐẦU TƯ VẠN TÍN PHÁT</h2>

			<?php
				global $user_login;  
				if (is_user_logged_in()) { ?>
					
			<?php 	
			} else { ?>
            	<p> <a href="/dang-ky-thanh-vien/"  class="dk">Đăng ký</a> <a href="/wp-login.php" class="dn">Đăng nhập</a> </p>
			<?php 
				}
			?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="banner">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <h2>Shark Tank VTP</h2>
        <div class="goivon clearfix">
          <div class="goivon-l">

         

            <?php
        global $user_login;  
        if (is_user_logged_in()) { ?>

            <a href="<?php echo get_permalink(71); ?>"><img src="<?php echo get_template_directory_uri() ?>/images/ico-dkgv.png" alt="" /><br>
            đăng ký<br>
            gọi vốn</a>

          
      <?php   
      } else { ?>

          <a href="#" onclick="alert('Vui lòng đăng nhập hoặc liên hệ <?php the_field('company_hotline', 'option') ?>')">
            <img src="<?php echo get_template_directory_uri() ?>/images/ico-dkgv.png" alt="" /><br>
            đăng ký<br>
            gọi vốn</a>


      <?php 
        }
      ?>



          </div>
          <div class="goivon-r">
   

              <?php 

              //check coi co dang bật 
              $turn_on_msg = get_field('bat_thong_bao', 'option');
              $msg_home = get_field('announment_home', 'option'); 
              if ($turn_on_msg==1) { ?>   

              <?php   
                echo '<div class="msg_home">';
                echo $msg_home;
                echo '</div>';
                  
              } 

                else { 


                    $args = array (
            'posts_per_page' => 1,
            'post_type' => 'sharktanks',
            'order' => 'DESC',
            'orderby' => 'date'
          );
          $sharktanks = new WP_Query($args);

          while ($sharktanks->have_posts()) : $sharktanks->the_post();  

            $now = date("Y-m-d"); 
            $closing = get_field('ngay_ket_thuc_goi_von');
            
            $now_time= strtotime($now);
            $closing_time = strtotime(str_replace('/', '-', $closing));
            $remain_days =  ($closing_time - $now_time ) / (60 * 60 * 24);
           
            ?>

             <h2>
              <a href="<?php echo get_permalink(73); ?>"><img src="<?php echo get_template_directory_uri() ?>/images/ico-dgv.png" alt="" />đang gọi vốn
              </a> 
            </h2>
            <div class="date"> <strong>Thời gian đóng</strong> <span><?php the_field('ngay_ket_thuc_goi_von'); ?></span> </div>
            <div class="hours"> <strong>Thời gian còn lại</strong> <span><?php echo $remain_days; ?> ngày</span> </div>
            
            <?php      


            endwhile; wp_reset_postdata();

              } ?>
          </div>
        </div>
      </div>
    </div>

    <?php 

      $url_ngan_hang = get_post(65);
      $url_xay_dung  = get_post(67);
      $url_bds = get_post(69);
    ?>
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="menu">
          <ul class="clearfix">
            <li><a href="<?php echo get_permalink($url_xay_dung); ?>">XÂY DỰNG</a></li>
            <li><a href="<?php echo get_permalink($url_bds); ?>">BẤT ĐỘNG SẢN</a></li>
            <li><a href="<?php echo get_permalink($url_ngan_hang); ?>">NGÂN HÀNG</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>