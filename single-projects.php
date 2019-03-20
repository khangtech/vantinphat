<?php get_header(); ?>


<section class="wrap-box">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <ul class="path clearfix">
          <li><a href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a></li>
          <li><?php the_title(); ?></li>
        </ul>
      </div>
    </div>

    <?php if (have_posts()): while (have_posts()) : the_post();?>


    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="sp-img"> <img src="<?php the_field('hinh_du_an_top') ?>" alt="" /> </div>
      </div>
    </div>


    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="sp-tab clearfix">
          <div class="sp-left">
            <h3><?php the_title(); ?></h3>
            <ul class="nav nav-tabs nav-sp">
              <li class="active"><a data-toggle="tab" href="#sp-tab1"><span>1</span>Thông tin dự án</a></li>
              <li><a data-toggle="tab" href="#sp-tab2"><span>2</span>Vị trí</a></li>
              <li><a data-toggle="tab" href="#sp-tab3"><span>3</span>Thông tin chủ đầu tư</a></li>
              <li><a data-toggle="tab" href="#sp-tab4"><span>4</span>Phương thức thanh toán</a></li>
               <li><a data-toggle="tab" href="#sp-tab5"><span>5</span>Hình ảnh</a></li>
            </ul>
          </div>
          <div class="tab-content tab-sp">
            <div id="sp-tab1" class="tab-pane fade in active">
              <?php the_content(); ?>
            </div>
            <div id="sp-tab2" class="tab-pane fade">
              <?php the_field('vi_tri_du_an') ?>
            </div>
            <div id="sp-tab3" class="tab-pane fade">
               <?php the_field('thong_tin_chu_dau_tu') ?>	
            </div>
            <div id="sp-tab4" class="tab-pane fade">
             	 <?php the_field('phuong_thuc_thanh_toan') ?>	
            </div>

             <div id="sp-tab5" class="tab-pane fade">
               
                <div class="row">


                <?php if( have_rows('hinh_du_an') ): 
                     while ( have_rows('hinh_du_an') ) : the_row(); ?>
                     <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                      <div class="sp-img"> 
                      <?php 
                            $image = get_sub_field('danh_sach_hinh_dự_an'); ?>
                          <img src="<?php echo $image ?>"/> 
                      </div>
                     </div>
                <?php   endwhile; endif; ?>
                 </div>

            </div>


          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="sp-btn clearfix"> 
          <form method="post">
              <?php if (is_user_logged_in()) { ?>
                   <button type="submit" name="register">đăng ký tư vấn</button> 
              <?php 
              } else { ?>
                  <button class="btnPop">đăng ký tư vấn</button> 
              <?php 
              } ?>
              
              <a href="tel:<?php the_field('company_hotline', 'option') ?>">Mua ngay</a> 

              <input name="doRegister" type="hidden" value="1">
              <input type="hidden" name="project_id" value="<?php echo get_the_ID(); ?>">

          </form>
         
        </div>
      </div>
    </div>

    <?php endwhile; endif; ?>
  </div>
</section>


<?php get_template_part( 'inc/content', 'page' ); ?>



<?php get_footer(); ?>