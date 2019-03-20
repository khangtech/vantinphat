<?php 

 //table check 
            global $wpdb;
            $table_bookmarked = $wpdb->prefix."user_bookmarks";

?>

<section class="top-cnt">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">

       
        <div class="search">
          <div class="txt">Chọn sản phẩm theo quận/huyện hoặc theo khung giá</div>
          <div class="select-style">
            <select name="optSelect" id="optSelect">
              <option value="0">------------ Quận ---------</option>
              <option value="760">Quận 1</option>
              <option value="769">Quận 2</option>
              <option value="770">Quận 3</option>
              <option value="773">Quận 4</option>
              <option value="774">Quận 5</option>
              <option value="775">Quận 6</option>
              <option value="778">Quận 7</option>
              <option value="776">Quận 8</option>
              <option value="763">Quận 9</option>
              <option value="771">Quận 10</option>
              <option value="772">Quận 11</option>
              <option value="761">Quận 12</option>
              <option value="777">Quận Bình Tân</option>
                <option value="765">Quận Bình Thạnh</option>
                  <option value="764">Quận Gò Vấp</option>
                    <option value="768">Quận Phú Nhuận</option>
                      <option value="766"> Quận Tân Bình</option>
                        <option value="762">Quận Thủ Đức</option>
                        <option value="767"> Quận Tân Phú</option>
                        <option value="787">Huyện Cần Giờ</option>

                         <option value="783"> Huyện Củ Chi</option>
                        <option value="785">Huyện Bình Chánh</option>

                         <option value="786">Huyện Nhà Bè</option>
                        <option value="784">Huyện Hóc Môn</option>
            </select>
          </div>
          <div class="select-style">
            <select name="optKhungGia" id="optKhungGia">
              <option value="0">---------- Giá bán ----------</option>
              <option value="1">Dưới 1 tỉ</option>
              <option value="2">Từ 1 - 2 tỉ</option>
              <option value="3">Từ 2 - 5 tỉ</option>
               <option value="4">Từ 5 tỉ trở lên</option>
            </select>
          </div>
          <div class="btn-search">
            <button id="btnSearch" name="btnSearch">Tìm kiếm <img src="<?php echo get_template_directory_uri() ?>/images/ico-search-w.png" alt="" /></button>
          </div>
        </div>

    

      </div>
    </div>


    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <!-- <div class="search-result"> Tìm thấy 3 sản phẩm </div> -->
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="search-table">
          <table>
            <tr>
              <th ><img src="<?php echo get_template_directory_uri() ?>/images/ico-masanpham.png" alt="" />Mã sản phẩm</th>
              <th><img src="<?php echo get_template_directory_uri() ?>/images/ico-diachi.png" alt="" />Quận</th>
              <th><img src="<?php echo get_template_directory_uri() ?>/images/ico-giamuonban.png" alt="" />Giá muốn bán</th>
              <th><img src="<?php echo get_template_directory_uri() ?>/images/ico-thuongluong.png" alt="" />Thương lượng</th>
              <th class="m-hide"><img src="<?php echo get_template_directory_uri() ?>/images/ico-giamuonmua.png" alt="" />Giá muốn mua</th>
              <th class="m-hide"><img src="<?php echo get_template_directory_uri() ?>/images/ico-chongiohang.png" alt="" />Lưu tin</th>
            </tr>

            <?php 

            $args = array (
            'posts_per_page' => 3,
            'post_type' => 'products',
            'order' => 'DESC',
            'orderby' => 'date',
            'meta_key'    => 'hot_product',
            'meta_value'  => '1'
            );

            $products = new WP_Query($args);

           
            while ($products->have_posts()) : $products->the_post();    

              $post_id = get_the_ID();
              $user_id =  get_current_user_id();

              $check_existed_record = $wpdb->get_results("SELECT * FROM $table_bookmarked WHERE post_id = ".$post_id." and user_id=" . $user_id);

              if($wpdb->num_rows > 0) {
                  $label = "Bỏ lưu";
              } else {
                  $label = "Lưu tin" ; 
              }

            ?>


               <tr class="hot">

             <?php if ( is_user_logged_in() ) { ?>

                <td ><a href="<?php the_permalink(); ?>"><span class="masp"><?php the_title(); ?></span></a></td>
              <td><?php the_field('district') ?> </td>
              <td><?php the_field('sell_price') ?> tỉ </td>
              <td><?php $thuong_luong = get_field('negotiation'); echo ($thuong_luong == true ? 'thương lượng'  : 'cố định');  ?></td>
              <td class="m-hide"><?php the_field('buy_price') ?> tỉ</td>

              <td class="m-hide"><button type="submit" id="<?php the_ID(); ?>" class="bookmark" data-id="<?php the_ID(); ?>"><?php echo $label; ?></button></td>

             <?php } else { 

                $login_url = "/wp-login.php";
              ?>

                <td ><a href="<?php echo $login_url; ?>" title="Vui lòng đăng nhập"><span class="masp"><?php the_title(); ?></span></a></span></td>
              <td ><?php the_field('district') ?> </td>
              <td><?php the_field('sell_price') ?> tỉ </td>
              <td><?php $thuong_luong = get_field('negotiation'); echo ($thuong_luong == true ? 'thương lượng'  : 'cố định');  ?></td>
              <td class="m-hide"><?php the_field('buy_price') ?> tỉ</td>

              <td class="m-hide"><a class="not_login" href="<?php echo $login_url; ?>" title="Vui lòng đăng nhập">Lưu tin</a></td>

             <?php  
             } ?>
               

            

            </tr>



            <?php endwhile; wp_reset_postdata(); ?>



            <?php 

            $args = array (
            'posts_per_page' => -1,
            'post_type' => 'products',
            'order' => 'DESC',
            'orderby' => 'date',
            'meta_key'    => 'hot_product',
            'meta_value'  => '0'
            );

            $products_normal = new WP_Query($args);

            while ($products_normal->have_posts()) : $products_normal->the_post();    


               $post_id = get_the_ID();
              $user_id =  get_current_user_id();

              $check_existed_record = $wpdb->get_results("SELECT * FROM $table_bookmarked WHERE post_id = ".$post_id." and user_id=" . $user_id);

              if($wpdb->num_rows > 0) {
                  $label = "Bỏ lưu";
              } else {
                  $label = "Lưu tin" ; 
              }


            ?>


               <tr>
              <td ><span class="masp"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></td>
              <td><?php the_field('district') ?> </td>
              <td><?php the_field('sell_price') ?> tỉ</td>
              <td><?php $thuong_luong = get_field('negotiation'); echo ($thuong_luong == true ? 'thương lượng'  : 'cố định');  ?></td>
              <td class="m-hide"><?php the_field('buy_price') ?> tỉ</td>
                <td class="m-hide"><button type="submit" id="<?php the_ID(); ?>" class="bookmark" data-id="<?php the_ID(); ?>"><?php echo $label; ?></button></td>
            </tr>



            <?php endwhile; wp_reset_postdata(); ?>
           
           
          
          </table>
        </div>
      </div>
    </div>
  </div>
</section>