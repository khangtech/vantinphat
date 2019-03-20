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





<script>

  $ = jQuery.noConflict();  


  $(document).ready(function() {
  
  var bctc1 = $("#bctc1");
  var bctc2 = $("#bctc2");
  
  bctc1.owlCarousel({
  singleItem : true,
  slideSpeed : 1000,
  pagination:false,
  navigation: false,
  afterAction : syncPosition,
  responsiveRefreshRate : 200,
  autoPlay: 3000,
  });
  
  bctc2.owlCarousel({
  items : 3,
  itemsDesktop      : [1199,3],
  itemsDesktopSmall     : [979,3],
  itemsTablet       : [767,3],
  itemsMobile       : [479,2],
  pagination:false,
  responsiveRefreshRate : 100,
  autoPlay: 3000,
  afterInit : function(el){
  el.find(".owl-item").eq(0).addClass("synced");
  }
  });
  
  function syncPosition(el){
  var current = this.currentItem;
  $("#bctc2")
  .find(".owl-item")
  .removeClass("synced")
  .eq(current)
  .addClass("synced")
  if($("#bctc2").data("owlCarousel") !== undefined){
  center(current)
  }
  
  }
  
  $("#bctc2").on("click", ".owl-item", function(e){
  e.preventDefault();
  var number = $(this).data("owlItem");
  bctc1.trigger("owl.goTo",number);
  });
  
  function center(number){
  var bctc2visible = bctc2.data("owlCarousel").owl.visibleItems;
  
  var num = number;
  var found = false;
  for(var i in bctc2visible){
  if(num === bctc2visible[i]){
  var found = true;
  }
  }
  
  if(found===false){
  if(num>bctc2visible[bctc2visible.length-1]){
  bctc2.trigger("owl.goTo", num - bctc2visible.length+2)
  }else{
  if(num - 1 === -1){
    num = 0;
  }
  bctc2.trigger("owl.goTo", num);
  }
  } else if(num === bctc2visible[bctc2visible.length-1]){
  bctc2.trigger("owl.goTo", bctc2visible[1])
  } else if(num === bctc2visible[0]){
  bctc2.trigger("owl.goTo", num-1)
  }
  }
  
  });
</script> 
<script type="text/javascript">
document.querySelector("html").classList.add('js');

var fileInput  = document.querySelector( ".input-file" ),  
    button     = document.querySelector( ".input-file-trigger" ),
    the_return = document.querySelector(".file-return");
      
button.addEventListener( "keydown", function( event ) {  
    if ( event.keyCode == 13 || event.keyCode == 32 ) {  
        fileInput.focus();  
    }  
});
button.addEventListener( "click", function( event ) {
   fileInput.focus();
   return false;
});  
fileInput.addEventListener( "change", function( event ) {  
    the_return.innerHTML = this.value;  
});  
</script>

</body>
</html>
