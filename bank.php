<?php /* Template Name: Bank */ ?>

<?php get_header(); ?>





<section class="wrap-box">
  <div class="container">
    <?php get_template_part('inc/path', $page) ?>
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

      <form method="post" name="bankPost"  enctype="multipart/form-data">

      <div class="col-sm-6 col-md-6 col-lg-6">
        <div class="box-cnt clearfix">
          <h2>Bạn đang cần vốn? yên tâm! Chúng tôi sẽ lựa chọn và kết nối 
            Ngân hàng tốt nhất cho bạn!</h2>
          <div class="wrap-2col clearfix">
            <div class="wrap-2col-l clearfix">
              <div class="wrap-input">
                <input type="text" id="txtCanVay" name="txtCanVay" class="in-txt" placeholder="Nhập số tiền vay" />
              </div>
            </div>
            <div class="wrap-2col-r clearfix">
              <div class="wrap-input">
                <input type="text" id="txtGiaTriTaiSan" name="txtGiaTriTaiSan" class="in-txt" placeholder="Nhập giá trị tài sản mua" />
              </div>
            </div>
          </div>
          <div class="wrap-2col clearfix">
            <div class="wrap-2col-l clearfix">
                <div class="wrap-input">
                <input type="text" id="txtSoTienTraHangThang" name="txtSoTienTraHangThang" class="in-txt" placeholder="Tiền gốc và lãi có 
thể trả hàng tháng " />
              </div>

          
            </div>
            <div class="wrap-2col-r clearfix">
              <div class="wrap-input">
              <input type="text" id="txtPhone" name="txtPhone" class="in-txt" <?php echo is_user_logged_in() ? 'disabled' : '' ?> value="<?php echo is_user_logged_in() ? $user_login : ''  ?>" placeholder="Số điện thoại" />

              </div>
            </div>
          </div>
          <div class="wrap-2col clearfix">
            <div class="wrap-2col-l clearfix">
                <div class="wrap-input">
               
                <div class="input-file-container">
                  <input id="file" type="file" name="hinh_anh_tai_san[]" class="inputfile" multiple>
                  <label for="file"><img src="<?php echo get_template_directory_uri() ?>/images/ico-da.png" alt="" />Đăng ảnh tài sản thế chấp</label>

                   <div id="image_preview"></div>

                </div>
               
              </div>
            </div>
           
          </div>
          <div class="btn-sub p50 clearfix">
             <input name="doBank" type="hidden" value="1">
            <button type="submit" onclick="return checkData();" name="bank">Nộp hồ sơ</button>
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

    if ($('#txtCanVay').val() =="") {
       alert('Vui lòng nhập số tiền cần vay!');
       $('#txtCanVay').focus();
       return false;
    } 
    if ($('#txtGiaTriTaiSan').val() =="") {
       alert('Vui lòng nhập tổng giá trị tài sản!');
       $('#txtGiaTriTaiSan').focus();
       return false;

    } 

  

 

    if ($('#txtSoTienTraHangThang').val() =="") {
       alert('Vui lòng nhập số tiền trả hàng tháng');
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




    if ($('#file')[0].files.length == 0) {
       alert('Vui lòng chọn tối thiểu 1 hình');
       return false;
    } 




    return true;
  }
</script>

<?php get_footer('bank'); ?>