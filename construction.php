<?php /* Template Name: Construction */ ?>

<?php get_header(); 

global $user_login;  
?>





<section class="wrap-box">
  <div class="container">
    <?php get_template_part('inc/path', $page) ?>
    <div class="row">
        <?php if (have_posts()): while (have_posts()) : the_post();?>

      <div class="col-sm-6 col-md-6 col-lg-6">
        <div class="ct-l clearfix">
          <div class="imgw"><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" /></div>
        </div>
      </div>

      <form method="post" name="constructionPost">

      <div class="col-sm-6 col-md-6 col-lg-6">
        <div class="box-cnt clearfix">

  
              <h2><?php the_content();  ?></h2>

         

        
           <div class="wrap-col clearfix">
            <div class="wrap-input">
              <div class="select-style">
                <select name="cboNhuCau" id="cboNhuCau">
                  <option value="0">Lựa chọn nhu cầu</option>
                  <option value="xây mới">Xây mới</option>
                  <option value="sửa chữa,nâng cấp">Sửa chữa nâng cấp</option>
                </select>
              </div>
            </div>
          </div>
          <div class="wrap-col clearfix">
            <div class="wrap-input">
              <div class="select-style">
                 <select name="cboViTri" id="cboViTri">
                  <option value="0">Chọn vị trí hẻm tài sản</option>
                  <option value="nhà mặt tiền">Nhà mặt tiền</option>
                  <option value="hẻm 1 xẹt">Hẻm 1 xẹt</option>
                  <option value="hẻm 2 xẹt">Hẻm 2 xẹt</option>
                </select>
              </div>
            </div>
          </div>

            <div class="wrap-col clearfix">
            <div class="wrap-input" style="text-align: left;">


          <?php endwhile; endif; ?>     


  <div class="select-style">
                 <select name="optBanVe" id="optBanVe">
                  <option value="Có" selected>Đã có bản vẽ thiết kế</option>
                 <option value="Không">Chưa có bản vẽ thiết kế</option>

                </select>
              </div>

            
            </div>
          </div>


           <div class="wrap-col clearfix">
            <div class="wrap-input">
              <input type="text" id="txtPhone" name="txtPhone" class="in-txt in-txt-extra" <?php echo is_user_logged_in() ? 'disabled' : '' ?> value="<?php echo is_user_logged_in() ? $user_login : ''  ?>" placeholder="Số điện thoại" />
              </div>
           
          </div>


        



          <div class="btn-sub p50 clearfix">
             <input name="doConstruction" type="hidden" value="1">
            <button type="submit" onclick="return checkDataXayDung();" name="construction">Nộp hồ sơ</button>
              <a class="calltobuy" href="tel:<?php the_field('company_hotline', 'option') ?>">Trao đổi</a> 
          </div>
        </div>
      </div>

      </form>




    </div>

    

  </div>
</section>


<?php get_template_part( 'inc/content', 'page' ); ?>


<script type="text/javascript">
  function checkDataXayDung() {

    intRegex = /[0-9 -()+]+$/;

    if ($('#cboNhuCau').val() =="0") {
       alert('Vui lòng chọn nhu cầu');
       return false;
    } 

     if ($('#cboViTri').val() =="0") {
       alert('Vui lòng chọn vị trí hẻm');
       return false;
    } 

    
    if ($('#txtPhone').val() =="") {
       alert('Vui lòng nhập số điện thoại');
       $('#txtPhone').focus();
       return false;
    } else {
        phone = $('#txtPhone').val();
        if (phone.length != 10 || !intRegex.test(phone)) {
          alert('Số điện thoại không hợp lệ');
          $('#txtPhone').focus();
          return false;
        } else {

        }
    } 

    return true;
  }
</script>

<?php get_footer(); ?>