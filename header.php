<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<?php wp_head(); ?>


</head>
<body>
<section class="header headerCnt">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="h-box clearfix">
          <h1><a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri() ?>/images/logo.png" alt="" /></a></h1>
            <!-- edit -->
          <div class="h-box-r clearfix">
            <div class="goivon2">


            
			<?php
				global $user_login;  
				if (is_user_logged_in()) { ?>
					<a href="<?php echo get_permalink(71); ?>">đăng ký<br>
                  gọi vốn</a>
			<?php 	
			} else { ?>
             <a href="#" onclick="alert('Vui lòng đăng nhập hoặc liên hệ <?php the_field('company_hotline', 'option') ?>')">đăng ký<br>
                  gọi vốn</a>
			<?php 
				}
			?>


                 
              </div>

            <div class="dgv">
             <?php 
               $turn_on_msg = get_field('bat_thong_bao', 'option');
               $msg_sub = get_field('announment_sub', 'option'); 
               //print_r($msg_sub);
             ?>
              <?php 

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

            endwhile; wp_reset_postdata(); ?>


            <?php if($turn_on_msg == true) { ?>
                <h2>đang gọi vốn</h2>
                 <p><?php echo $msg_sub; ?></p> 
              <?php 

              } else { ?>
                 <h2> <a href="<?php echo get_permalink(73); ?>">đang gọi vốn</a></h2>
                 <p>Thời gian đóng<span><?php the_field('ngay_ket_thuc_goi_von'); ?><span></p>
                 <p>Thời gian còn lại<span><?php echo $remain_days; ?> ngày<span></p> 
              <?php 
              } 
            ?>


          
            </div>
          </div>          
         <!-- end edit -->
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="h-box2 clearfix">
          <h2>CHƯƠNG TRÌNH KẾT NỐI ĐẦU TƯ</h2>

           <?php 
              global $user_login;  

          if (is_user_logged_in()) { ?>

            <div class="acc clearfix">
            <div class="ava-img"><img src="<?php echo get_template_directory_uri() ?>/images/avatar.png" alt="" /></div>
            <div class="ava-name">Chào, <?php echo $user_login; ?></div>
            <div class="acc-lst">
             
              <ul>
              <li><a href="<?php echo admin_url('profile.php') ?>"><img src="<?php echo get_template_directory_uri() ?>/images/ico-ttcanhan.png" alt="" />Thông tin cá nhân</a></li>
                 <li><a href="<?php echo admin_url('/admin.php?page=kcn_change_pass') ?>"><img src="<?php echo get_template_directory_uri() ?>/images/ico-tindaluu.png" alt="" />Đổi mật khẩu</a></li> 
                <li><a href="<?php echo wp_logout_url(home_url()); ?>"><img src="<?php echo get_template_directory_uri() ?>/images/ico-dangxuat.png" alt="" />Đăng xuất</a></li>
              </ul>
            </div>
          </div>
          <?php } 
        else { ?>

          <div class="login2 clearfix"> 
                  <a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Đăng nhập" class="btn-dn">đăng nhập</a> 
                  <a href="/dang-ky-thanh-vien/"  title="Đăng ký" class="btn-dk">đăng ký</a> 
              </div>
        <?php       
        }
      ?> 
        </div>
      </div>
    </div>
  </div>
</section>
