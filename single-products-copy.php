<?php get_header(); ?>



<section class="wrap-box">
  <div class="container">
  <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
      <ul class="path clearfix">
        <li><a href="<?php echo home_url(); ?>">Trang chủ</a></li>
        <li>Sản phẩm: <?php the_title(); ?></li>
      </ul>
    </div>
  </div>



    <?php if (have_posts()): while (have_posts()) : the_post();?>

  <div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6">
      <div class="ct-l clearfix">
        <div class="tcbcBottom">

          

            

          <div id="bctc1" class="owl-carousel">
          <?php if( have_rows('product_galleries') ): 
                  while ( have_rows('product_galleries') ) : the_row(); ?>
                    <div class="item">
                    <?php 

                    $image = get_sub_field('product_detail_photo');

                    $size = 'product_photo'; 
                    echo wp_get_attachment_image( $image, $size ); 

                    ?>
                   </div>

          <?php   endwhile; endif; ?>
          </div>

        </div>
        <div class="tcbcTop">
          <div id="bctc2" class="owl-carousel">
           <?php if( have_rows('product_galleries') ): 
                  while ( have_rows('product_galleries') ) : the_row(); ?>
                    <div class="item">

                      <?php 

                    $image = get_sub_field('product_detail_photo');
                    
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
      <div class="box-cnt clearfix">
        <h2>nếu bạn thích sản phẩm <span><?php the_title(); ?></span> này? Chúng tôi có thể mang về cho bạn</h2>

        <form method="post" class="bidding">
        <div class="wrap-2col clearfix">
          
        <div class="wrap-2col-l clearfix">
            <div class="wrap-input">
            <div class="price">
                <p><strong>giá bán</strong></p>
              </div>
              
            </div>
          </div>

          
          <div class="wrap-2col-r clearfix">
            <div class="wrap-input">
            <div class="price"><?php the_field('sell_price') ?> tỉ</div>
             

            </div>
          </div>
        </div>

        <div class="wrap-2col clearfix">
          <div class="wrap-2col-l clearfix">
            <div class="wrap-input">
            <input type="text"  name="txtPriceBid" maxlength="200" required class="in-txt" placeholder="Nhập giá muốn mua" />
              <input type="hidden" name="product_id" value="<?php echo get_the_ID(); ?>" />
            </div>
          </div>
          <div class="wrap-2col-r clearfix">
            <div class="wrap-input">
              <button type="submit" name="bidding"  class="btn-tg">trả giá</button>
              <input type="hidden" name="doBid" value="1">
            </div>
          </div>
        </div>


        </form>


        <?php 

           //table check 
                      global $wpdb;
                      $table_bookmarked = $wpdb->prefix."user_bookmarks";



                      $post_id = get_the_ID();
              $user_id =  get_current_user_id();

              $check_existed_record = $wpdb->get_results("SELECT * FROM $table_bookmarked WHERE post_id = ".$post_id." and user_id=" . $user_id);

              if($wpdb->num_rows > 0) {
                  $label = "Bỏ lưu";
              } else {
                  $label = "Lưu tin" ; 
              }




        ?>

        <div class="des-line">

          <p><span>Địa chỉ: </span><?php the_field('ward') ?>, <?php the_field('district') ?> - <span>Diện tích:</span> <?php the_field('total_area') ?>m2</p>
          
        </div>
        <h3>Mô tả sản phẩm</h3>
        <div class="wrap-col clearfix">
          <div class="wrap-input">
            <div class="des">
                <?php the_content(); ?>
            </div>
          </div>
          <div class="btn-sub p50 clearfix">
            <button type="submit" id="<?php echo get_the_ID(); ?>" class="bookmark" data-id="<?php echo get_the_ID(); ?>"><?php echo $label; ?></button>
            <a class="calltobuy" href="tel:<?php the_field('company_hotline', 'option') ?>">Mua ngay</a>
          </div>
        </div>
      </div>
    </div>
  </div>



    <?php endwhile; endif; ?>

</section>


<?php get_template_part( 'inc/content', 'page' ); ?>






<?php get_footer('slides'); ?>


