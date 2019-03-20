<?php /* Template Name: CallFund */ ?>

<?php 
  // neu chua login thi khong cho vao
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
          <li><a href="#">Trang chủ</a></li>
          <li><?php the_title();   ?></li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-md-6 col-lg-6">
        <div class="ct-l clearfix">
          <div class="tcbcBottom" >
            <div id="main_preview"></div>
          </div>
          <div class="tcbcTop">
            <div id="list_sub_preview"></div> 
          </div>
        </div>
      </div>

      <form method="post" name="fundPost"  enctype="multipart/form-data">

      <div class="col-sm-6 col-md-6 col-lg-6">
        <div class="box-cnt clearfix">
          <?php if (have_posts()): while (have_posts()) : the_post();?>

            <h2><?php the_content();  ?></h2>


           <?php endwhile; endif; ?>     
           
           <h3 class="sh-dot">Phương án gọi vốn</h3>
          <div class="wrap-col clearfix">
            <div class="wrap-input">
              <textarea id="txtMoTa" name="txtMoTa" placeholder="Nhập mô tả"></textarea>
            </div>
          </div>


          <div class="wrap-col clearfix">
            <div class="wrap-lable">Nhập giá trị tài sản</div>
            <div class="wrap-input wrap-input2">
              <input type="text" id="txtGiaTriTaiSan" name="txtGiaTriTaiSan" class="in-txt" />
            </div>
          </div>


            <div class="wrap-col clearfix">
            <div class="wrap-lable">Nhập số tiền muốn gọi vốn</div>
            <div class="wrap-input wrap-input2">
              <input type="text" id="txtSoTienGoiVon" name="txtSoTienGoiVon" class="in-txt" />
            </div>
          </div>

           <div class="wrap-col clearfix">
            <div class="wrap-lable">Chọn thời gian kết thúc</div>
            <div class="wrap-input wrap-input2">
              <div class='input-group'>
                    <input type='text' class="form-control form_datetime" name="txtEndFund"  id='txtEndFund' />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
          </div>


 <div class="wrap-col clearfix">
                <div class="wrap-input">
                <div class="input-file-container">
                  <input id="file" type="file" name="hinh_anh_tai_san[]" class="inputfile" multiple>
                  <label for="file"><img src="<?php echo get_template_directory_uri() ?>/images/ico-da.png" alt="" />Đăng ảnh tài sản</label>

                   <div id="image_preview"></div>

                </div>
              </div>

          </div>
         
     
          <div class="btn-sub p50 clearfix">
             <input name="doFund" type="hidden" value="1">
            <button type="submit" onclick="return checkData();" name="fund">Gọi vốn</button>
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




  function checkData() {

    if ($('#txtMoTa').val() =="") {
       alert('Vui lòng nhập phương án gọi vốn');
       return false;
    } 
    if ($('#txtGiaTriTaiSan').val() =="") {
       alert('Vui lòng nhập tổng giá trị tài sản!');
       return false;
    } 

     if ($('#txtSoTienGoiVon').val() =="") {
       alert('Vui lòng nhập số tiền muốn gọi vốn');
       return false;
    } 

    

    if ($('#txtEndFund').val() =="") {
       alert('Vui lòng nhập ngày kết thúc mong muốn');
       return false;
    } 

  


    if ($('#file')[0].files.length == 0) {
       alert('Vui lòng chọn tối thiểu 1 hình');
       return false;
    } 




    return true;
  }
</script>

<?php get_footer('bank'); ?>