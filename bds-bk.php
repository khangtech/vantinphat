<?php /* Template Name: RealEstate */ ?>

<?php get_header(); ?>

<?php 
  global $wpdb;
  $table_district = $wpdb->prefix."districts";

  $listQuan = $wpdb->get_results("SELECT * FROM $table_district ORDER BY thu_tu asc", ARRAY_A);

?>




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

      <form method="post" name="bankPost"  enctype="multipart/form-data">

      <div class="col-sm-6 col-md-6 col-lg-6">
        <div class="box-cnt clearfix">
          <?php if (have_posts()): while (have_posts()) : the_post();?>
          <h2><?php the_content(); ?></h2>
          <?php endwhile; endif; ?>     
          <div class="wrap-2col clearfix">
            <div class="wrap-2col-l clearfix">
              <div class="wrap-input">
                <input type="text" id="txtGiaBan" name="txtGiaBan" class="in-txt" placeholder="Nhập giá bán" />
              </div>
            </div>
            <div class="wrap-2col-r clearfix">
              <div class="wrap-input">
                <input type="text" id="txtDienTich" name="txtDienTich" class="in-txt" placeholder="Nhập diện tích" />
              </div>
            </div>
          </div>
          <div class="wrap-2col clearfix">
            <div class="wrap-2col-l clearfix">
              <div class="wrap-input">
                <div class="select-style">
                  <select name="cboChonQuan" class="cboChonQuan" id="cboChonQuan">
                    <option value="0">Chọn quận</option>
                    <?php 
                      for ($i=0; $i<count($listQuan); $i++) { ?>
                         <option value="<?php echo $listQuan[$i]["id"] ?>"><?php echo $listQuan[$i]["name"] ?></option> 
                    <?php 
                      }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="wrap-2col-r clearfix">
             <div class="wrap-input">
                 <div class="select-style">
                  <select name="cboThuongLuong" id="cboThuongLuong">
                    <option value="0" selected>Thương lượng</option>
                    <option value="1">Giá chốt</option>
                  </select>
                </div>
              </div>

            </div>
          </div>
       
          
          <div class="wrap-col clearfix">
            <div class="wrap-input">
              <textarea id="txtMoTa" name="txtMoTa" placeholder="Uu điểm nổi bật/tiện ích xung quanh"></textarea>
            </div>
          </div>

             <div class="wrap-2col clearfix">
            <div class="wrap-2col-l clearfix">
                <div class="wrap-input">
                <div class="input-file-container">
                  <input id="file" type="file" name="hinh_anh_tai_san[]" class="inputfile" multiple>
                  <label for="file"><img src="<?php echo get_template_directory_uri() ?>/images/ico-da.png" alt="" />Đăng hình ảnh</label>

                   <div id="image_preview"></div>

                </div>
              </div>
            </div>
            <div class="wrap-2col-r clearfix">
            
            </div>
          </div>
          

          <div class="btn-sub p50 clearfix">
             <input name="doBDS" type="hidden" value="1">
            <button type="submit" onclick="return checkData();" name="batdongsan">Ký gửi</button>
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

    if ($('#txtGiaBan').val() =="") {
       alert('Vui lòng nhập giá bán!');
       $('#txtGiaBan').focus();
       return false;
    } 
    if ($('#txtDienTich').val() =="") {
       alert('Vui lòng nhập diện tích!');
       $('#txtDienTich').focus();
       return false;
    } 

    if ($('#cboChonQuan').val() =="0") {
       alert('Vui lòng chọn quận');
       $('#cboChonQuan').focus();
       return false;
    } 

    if ($('#cboChonPhuong').val() =="0") {
       alert('Vui lòng chọn phường');
       $('#cboChonPhuong').focus();
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