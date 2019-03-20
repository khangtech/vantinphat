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

<script type="text/javascript">
  $ = jQuery.noConflict();  

  $(document).ready(function() {

  $('#txtEndFund').datetimepicker({
    format: 'dd/mm/yyyy',
    autoclose: true,
    minView: 2
  });


    $("#main_preview").append('<img src="<?php echo get_template_directory_uri() ?>/images/preview_bds.jpg">');

    var inputs = document.querySelectorAll( '.inputfile' );
Array.prototype.forEach.call( inputs, function( input )
{
  var label  = input.nextElementSibling,
    labelVal = label.innerHTML;

    input.addEventListener( 'change', function( event )
    {
        if (this.files.length ==0) {
          alert('Chọn ít nhất 1 hình');
          return;
        } else if(this.files.length > 4  ) {
          alert('Chỉ được chọn tối đa 4 hình');
          return;
        } else {
          $('#main_preview').html('');
          $('#list_sub_preview').html('');
          for (var i = 0; i < this.files.length; i++) {
            if (i==0) {
                $('#main_preview').append("<img   src='"+URL.createObjectURL(event.target.files[i])+"'>");
            } 
            var src = event.target.files[i];

            $('#list_sub_preview').append("<img  onclick='changePreview(src)'  src='"+URL.createObjectURL(event.target.files[i])+"'>");

          }  
        }
     
    });
});

  });

  function changePreview(src) {
     $('#main_preview').html('');
     $('#main_preview').append("<img    src='"+ src +"'>");
  }

</script>

</body>
</html>
