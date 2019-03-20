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
<section class="header headerCnt">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="h-box clearfix">
          <h1><a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri() ?>/images/logo.png" alt="" /></a></h1>
          <div class="h-box-r clearfix">
            <?php 

               //check coi co dang bật 
              $turn_on_msg = get_field('bat_thong_bao', 'option');
              $msg_sub = get_field('announment_sub', 'option'); 

            ?>
            <div class="dgv">
              <h2>đang gọi vốn</h2>
              <?php 
                if ($turn_on_msg==1) {
                   echo '<div class="msg_sub">';
                     echo $msg_sub;
                     echo '</div>' ;
                } else { ?>

              <p>Thời gian đóng<span>30-12-2018<span></p>
              <p>Thời gian còn lại<span>5 ngày<span></p>
              <?php     
                } 
              ?>
            </div>
            <div class="goivon2"><a href="#">đăng ký<br>
              gọi vốn</a></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="h-box2 clearfix">
          <h2>Shark Tank VTP</h2>

            <?php 
            	global $user_login;  


			  	if (is_user_logged_in()) { ?>

			  		<div class="acc clearfix">
            <div class="ava-img"><img src="<?php echo get_template_directory_uri() ?>/images/avatar.png" alt="" /></div>
            <div class="ava-name">Chào, <?php echo $user_login; ?></div>
            <div class="acc-lst">
             
              <ul>
                <li><a href="#"><img src="<?php echo get_template_directory_uri() ?>/images/ico-tindaluu.png" alt="" />Tin đã lưu</a></li>
                <li><a href="<?php echo admin_url('profile.php') ?>"><img src="<?php echo get_template_directory_uri() ?>/images/ico-ttcanhan.png" alt="" />Thông tin cá nhân</a></li>
                <li><a href="<?php echo wp_logout_url(home_url()); ?>"><img src="<?php echo get_template_directory_uri() ?>/images/ico-dangxuat.png" alt="" />Đăng xuất</a></li>
              </ul>
            </div>
          </div>
   				<?php } 
 				else { ?>

 					<div class="login2 clearfix"> 
          				<a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Đăng nhập" class="btn-dn">đăng nhập</a> 
          				<a href="#" title="Đăng ký" class="btn-dk">đăng ký</a> 
          		</div>
				<?php  			
				}
			?> 
        </div>
      </div>
    </div>
  </div>
</section>
