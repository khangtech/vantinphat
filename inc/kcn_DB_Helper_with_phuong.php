<?php 
	function kcn_save_bidding() {
		global $wpdb;
		if (isset($_POST['bidding']) && $_POST['doBid'] =="1") {
			$product_id = sanitize_text_field($_POST['product_id']);
			$user_id = get_current_user_id();
			$created = current_time('mysql');
			$bid_price = sanitize_text_field($_POST['txtPriceBid']);

			$table = $wpdb->prefix . 'product_bid' ;

			$data = array(
				'product_id' => $product_id,
				'user_id' => $user_id,
				'created' => $created,
				'bid_price' => $bid_price
			);

			$format = array(
				'%d',
				'%d',
				'%s',
				'%s'
			);

			$wpdb->insert($table, $data, $format);
			// trang cam on
			$url = get_post(62);
			wp_redirect( get_permalink($url) );
			exit();

		}
	}

	

	function kcn_save_register() {
		global $wpdb;
		if (isset($_POST['register']) && $_POST['doRegister'] =="1") {
			$project_id = sanitize_text_field($_POST['project_id']);
			$user_id = get_current_user_id();
			$created = current_time('mysql');
			
			$table = $wpdb->prefix . 'project_register' ;

			$data = array(
				'project_id' => $project_id,
				'user_id' => $user_id,
				'created' => $created
			);

//			print_r($data);

			$format = array(
				'%d',
				'%d',
				'%s'
			);

			$wpdb->insert($table, $data, $format);
			// trang cam on
			$url = get_post(62);
			wp_redirect( get_permalink($url) );
			exit();

		}
	}


	function kcn_save_shark() {
		global $wpdb;
		if (isset($_POST['shark']) && $_POST['doShark'] =="1") {
			$sharktank_id = sanitize_text_field($_POST['sharktank_id']);
			$user_id = get_current_user_id();
			$created = current_time('mysql');
			$gopvon = sanitize_text_field($_POST['txtGopVon']);
			
			$table = $wpdb->prefix . 'sharktank_bid' ;

			$data = array(
				'sharktank_id' => $sharktank_id,
				'user_id' => $user_id,
				'created' => $created,
				'bid_price' => $gopvon
			);

//			print_r($data);

			$format = array(
				'%d',
				'%d',
				'%s',
				'%s'
			);

			$wpdb->insert($table, $data, $format);
			// trang cam on
			$url = get_post(62);
			wp_redirect( get_permalink($url) );
			exit();

		}
	}




	function kcn_delete_registration() {
		if ($_POST['type']=='delete') :
			global $wpdb;
			$table = $wpdb->prefix . 'project_register' ;
			$id_delete = $_POST['id'];

			$result = $wpdb->delete($table, array('id' => $id_delete), array('%d'));

			if ($result == 1) {
				$response = array(
					'response' => 'success',
					'id' => $id_delete
				);
			} else {
				$response = array(
					'response' => 'error',
				);
			}

		endif;
		die(json_encode($response)); // always with Ajax WP
	}



	function kcn_save_bank() {
		global $wpdb;
		if (isset($_POST['bank']) && $_POST['doBank'] =="1") {


			
			$arr_taisan_photo = [];

			$created = current_time('mysql');
			$so_tien_vay = sanitize_text_field($_POST['txtCanVay']);
			$gia_tri_tai_san = sanitize_text_field($_POST['txtGiaTriTaiSan']);
			$lich_su_tin_dung = sanitize_text_field($_POST['cboLichSuTinDung']);
			$phap_ly_tai_san = sanitize_text_field($_POST['cboPhapLyTaiSan']);
			$so_tien_tra_hang_thang = sanitize_text_field($_POST['txtSoTienTraHangThang']);

			

			$hinh_tai_san_0 = "";
			$hinh_tai_san_1 ="" ;
			$hinh_tai_san_2 = "";
			$hinh_tai_san_3 = "" ;

  		//	print_r($hinh_tai_san);
			for ($i=0; $i< count($_FILES['hinh_anh_tai_san']["name"]); $i++) {
				if (!empty($_FILES["hinh_anh_tai_san"]["tmp_name"][$i])) {

					 $temp = explode(".", $_FILES["hinh_anh_tai_san"]["name"][$i]);
					// echo $_FILES["hinh_anh_tai_san"]["name"][$i];
					 $newfilename = time() . '_' . $i .  '.' . end($temp);
					 
					 $upload_to = wp_upload_dir();
					 $folder=  $upload_to['basedir'] .'/tai-san/'	;

					 move_uploaded_file($_FILES["hinh_anh_tai_san"]["tmp_name"][$i], "$folder".$newfilename);

					 array_push($arr_taisan_photo,$newfilename);	
				} 
				
			}

			
		
			for ($i=0; $i <count($arr_taisan_photo); $i++) {
				${"hinh_tai_san_$i"} = $arr_taisan_photo[$i];
			}
			
			$user_id = get_current_user_id();
			
		
			$table = $wpdb->prefix . 'bank' ;

			$data = array(

				'created' => $created,
				'so_tien_vay' => $so_tien_vay,
				'gia_tri_tai_san' => $gia_tri_tai_san,
				'lich_su_tin_dung' => $lich_su_tin_dung,
				'phap_ly_tai_san' => $phap_ly_tai_san,
				'so_tien_tra_hang_thang' => $so_tien_tra_hang_thang,
				'hinh_tai_san_0' => $hinh_tai_san_0,
				'hinh_tai_san_1' => $hinh_tai_san_1,
				'hinh_tai_san_2' => $hinh_tai_san_2,
				'hinh_tai_san_3' => $hinh_tai_san_3,
				'user_id' => $user_id
			);

//			print_r($data);

			$format = array(
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%d'
			);

			$wpdb->insert($table, $data, $format);
			// trang cam on
			$url = get_post(62);
			wp_redirect( get_permalink($url) );
			exit();

		}
	}




	function kcn_save_construction() {
		global $wpdb;
		if (isset($_POST['construction']) && $_POST['doConstruction'] =="1") {

			$created = current_time('mysql');
			$nhu_cau = sanitize_text_field($_POST['cboNhuCau']);
			$vi_tri_hem = sanitize_text_field($_POST['cboViTri']);
			$ban_ve = sanitize_text_field($_POST['optBanVe']);
			$thong_tin = sanitize_text_field($_POST['txtThongTinKhac']);	
			$user_id = get_current_user_id();
			
		
			$table = $wpdb->prefix . 'construction' ;

			$data = array(
				'created' => $created,
				'nhu_cau' => $nhu_cau,
				'vi_tri_hem' => $vi_tri_hem,
				'ban_ve' => $ban_ve,
				'thong_tin' => $thong_tin,
				'user_id' => $user_id
			);

//			print_r($data);

			$format = array(
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%d'
			);

			$wpdb->insert($table, $data, $format);
			// trang cam on
			$url = get_post(62);
			wp_redirect( get_permalink($url) );
			exit();

		}
	}



	function kcn_save_batdongsan() {
		global $wpdb;
		if (isset($_POST['batdongsan']) && $_POST['doBDS'] =="1") {


			
			$arr_taisan_photo = [];

			$created = current_time('mysql');
			$gia_ban = sanitize_text_field($_POST['txtGiaBan']);
			$dien_tich = sanitize_text_field($_POST['txtDienTich']);
			$quan = sanitize_text_field($_POST['cboChonQuan']);
			$phuong = sanitize_text_field($_POST['cboChonPhuong']);
			$thuong_luong = (sanitize_text_field($_POST['cboThuongLuong']) == 1) ? 1 : 0  ;
			
			

			$hinh_tai_san_0 = "";
			$hinh_tai_san_1 ="" ;
			$hinh_tai_san_2 = "";
			$hinh_tai_san_3 = "" ;

  		//	print_r($hinh_tai_san);
			for ($i=0; $i< count($_FILES['hinh_anh_tai_san']["name"]); $i++) {
				if (!empty($_FILES["hinh_anh_tai_san"]["tmp_name"][$i])) {

					 $temp = explode(".", $_FILES["hinh_anh_tai_san"]["name"][$i]);
					// echo $_FILES["hinh_anh_tai_san"]["name"][$i];
					 $newfilename = time() . '_' . $i .  '.' . end($temp);
					 
					 $upload_to = wp_upload_dir();
					 $folder=  $upload_to['basedir'] .'/tai-san/'	;

					 move_uploaded_file($_FILES["hinh_anh_tai_san"]["tmp_name"][$i], "$folder".$newfilename);

					 array_push($arr_taisan_photo,$newfilename);	
				} 
				
			}

			
		
			for ($i=0; $i <count($arr_taisan_photo); $i++) {
				${"hinh_tai_san_$i"} = $arr_taisan_photo[$i];
			}

			$mo_ta = sanitize_text_field($_POST['txtMoTa']);
			
			$user_id = get_current_user_id();
			
		
			$table = $wpdb->prefix . 'bds' ;

			$data = array(
				'created' => $created,
				'gia_ban' => $gia_ban,
				'dien_tich' => $dien_tich,
				'quan' => $quan,
				'phuong' => $phuong,
 				'thuong_luong' => $thuong_luong,
				'hinh_tai_san_0' => $hinh_tai_san_0,
				'hinh_tai_san_1' => $hinh_tai_san_1,
				'hinh_tai_san_2' => $hinh_tai_san_2,
				'hinh_tai_san_3' => $hinh_tai_san_3,
				'mo_ta' => $mo_ta,
				'user_id' => $user_id
			);

//			print_r($data);

			$format = array(
				'%s',
				'%s',
				'%s',
				'%d',
				'%d',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%d'
			);

			$wpdb->insert($table, $data, $format);
			// trang cam on
			$url = get_post(62);
			wp_redirect( get_permalink($url) );
			exit();

		}
	}






	add_action('wp_ajax_kcn_delete_registration', 'kcn_delete_registration');


	add_action('init', 'kcn_save_bidding');

	add_action('init', 'kcn_save_register');
	add_action('init', 'kcn_save_shark');

	add_action('init', 'kcn_save_bank');

	add_action('init', 'kcn_save_construction');

	add_action('init', 'kcn_save_batdongsan');


?>