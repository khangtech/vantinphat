<?php /* Template Name: SharkTank */ ?>

<?php 

if( !is_user_logged_in() ) {
  wp_redirect('/wp-login.php');
  exit();
}

?>


<?php get_header(); ?>





<section class="wrap-box">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <ul class="path clearfix">
          <li><a href="<?php echo home_url(); ?>">Trang chủ</a></li>
          <li><?php the_title(); ?></li>
        </ul>
      </div>
    </div>

    <?php 

          $args = array (
            'posts_per_page' => 1,
            'post_type' => 'sharktanks',
            'order' => 'DESC',
            'orderby' => 'date'
          );
          $sharktanks = new WP_Query($args);

          while ($sharktanks->have_posts()) : $sharktanks->the_post();  


     ?>

    <div class="row">
      <div class="col-sm-6 col-md-6 col-lg-6">
        <div class="ct-l clearfix">
          <div class="tcbcBottom">
            <div id="bctc1" class="owl-carousel">
               <?php if( have_rows('hinh_anh_san_pham') ): 
                  while ( have_rows('hinh_anh_san_pham') ) : the_row(); ?>
                    <div class="item">
                    <?php 

                    $image = get_sub_field('hinh_san_pham_dang_goi_von');

                    $size = 'product_photo'; 
                    echo wp_get_attachment_image( $image, $size ); 

                    ?>
                   </div>

          <?php   endwhile; endif; ?>

            </div>
          </div>
          <div class="tcbcTop">
            <div id="bctc2" class="owl-carousel">
              <?php if( have_rows('hinh_anh_san_pham') ): 
                  while ( have_rows('hinh_anh_san_pham') ) : the_row(); ?>
                    <div class="item">

                      <?php 

                    $image = get_sub_field('hinh_san_pham_dang_goi_von');
                    
                    $size = 'product_thumb_photo'; 
                    echo wp_get_attachment_image( $image, $size ); 

                    ?>   


                     </div>
          <?php   endwhile; endif; ?>


            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-6">

           <form method="post">

        <div class="box-cnt clearfix">
          <h2>Bạn cũng đang thích sản phẩm này? Chúng tôi sẳn sàng chia sẽ cơ hội để hợp tác thành công</h2>
          <h3 class="sh-dot">Phương án gọi vốn</h3>
          <div class="wrap-col clearfix">
            <div class="wrap-input description">
                <?php the_content(); ?>
            </div>
          </div>
          <div class="wrap-col clearfix">
            <div class="wrap-lable">Tổng nhu cầu vốn</div>
            <div class="wrap-input wrap-input2">
              <div class="price"><?php the_field('nhu_cau_goi_von'); ?></div>
            </div>
          </div>
       

          <div class="wrap-col clearfix">
            <div class="wrap-lable">Nhập số tiền góp vốn</div>
            <div class="wrap-input wrap-input2">
              <input type="text" id="txtGopVon" name="txtGopVon" class="in-txt" />
            </div>
          </div>

              <div class="wrap-col clearfix">
            <div class="wrap-lable">Ngày hết hạn</div>
            <div class="wrap-input wrap-input2">
              <div class="price"><?php the_field('ngay_ket_thuc_goi_von'); ?></div>
            </div>
          </div>
          
          <div class="btn-sub p50 clearfix">
            <button class="bookmark" type="submit" name="shark">Góp vốn</button>
            <a class="calltobuy" href="tel:<?php the_field('company_hotline', 'option') ?>">Trao đổi</a>
          </div>
        </div>

           <input name="doShark" type="hidden" value="1">
              <input type="hidden" name="sharktank_id" value="<?php echo get_the_ID(); ?>">

          </form>


      </div>
    </div>


     <?php endwhile; wp_reset_postdata(); ?>


  </div>
</section>


<?php get_template_part( 'inc/content', 'page' ); ?>


<?php get_footer('slides'); ?>