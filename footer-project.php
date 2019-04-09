<?php wp_footer(); ?>


<section class="letter-out">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="letter clearfix">
          <?php echo do_shortcode('[contact-form-7 id="117" title="Đăng ký nhận tin"]'); ?>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="footer">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-md-6 col-lg-6">
        <div class="f-left">
          <h2><?php the_field('company_name', 'option') ?></h2>
          <div class="f-home">Địa chỉ: <?php the_field('company_add', 'option') ?></div>
          <div class="f-phone">Điện thoại: <?php the_field('company_tel', 'option') ?></div>
          <div class="f-mail">Email: <a href="mailto:<?php the_field('company_name', 'option') ?>"><?php the_field('company_email', 'option') ?></a></div>
        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-6">
        <div class="f-right">

        

          <div class="f-thongke"><span>Thống kê truy cập</span><?php echo vcp_get_visit_count('T') ?></div>
          <div class="f-thanhvien"><span>Tổng hôm nay</span><?php echo vcp_get_visit_count('D') ?></div>
          <div class="f-online"><span>Đang online</span><?php echo vcp_get_visit_count('C') ?></div>

        </div>
      </div>
    </div>
  </div>
</section>
<section class="copyright">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="copyTxt">Copyright <?php echo date("Y"); ?> <a href="<?php echo home_url(); ?>">vantinphat</a>. All rights reserved.</div>
      </div>
    </div>
  </div>
</section>




<!-- Popup -->
<div id="mySurvey" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content sv-box">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title sv-ttl">ĐĂNG KÝ TƯ VẤN</h4>
      </div>
      <div class="modal-body">
         <form name="dangkytuvan" method="post">
            <label>Số điện thoại</label> <input type="text" name="txtPhone" id="txtPhone">
             <input name="doDangKy" type="hidden" value="1">
             <br>
              <input type="hidden" name="project_id" value="<?php echo get_the_ID(); ?>">
            <input type="submit" name="btnDangKy" value="Đăng ký" class="wpcf7-submit" onclick="return checkPhone();">
         </form>
        </div>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.fancybox.min.css" />
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox.min.js"></script>

<script type="text/javascript">
  function checkPhone() {

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
        } 
    }

    return true;
  }
</script>


</body>
</html>
