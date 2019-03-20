$ = jQuery.noConflict();

$(document).ready(function() {


	$('.bookmark').on('click', function(e) {
		
		//alert('What');
		
		var post_id = $(this).attr('data-id');
		var action_to_do =  $(this).text();
	 
	// call ajax
	$.ajax({
		type: 'post',
		data : {
			'action' : 'kcn_bookmark_product',
			'id' : post_id,
			'todo' : action_to_do,
		},
		url: admin_ajax.ajaxurl,
		success: function(data) {
			var result = JSON.parse(data);
			if (result.response == 'success') {
				if (result.action =='booked') {
					alert('Đã lưu tin');
					//change text 
					$('#'+ post_id).html('Bỏ lưu');	
				} else if(result.action =='unbooked')  {
					alert('Đã bỏ lưu tin');
					//change text 
					$('#'+ post_id).html('Lưu tin');	
				}
				

			}
		}
	});

	});





	$('.btnPop').on('click', function(e) {
		e.preventDefault();
		$('#mySurvey').show();
	});

	$('.close').on('click', function(e) {
		$('#mySurvey').hide();
	});

	$('#btnSearch').on('click', function(e) {
		e.preventDefault();
		var district_id = $('#optSelect').val();
		var price_range = $('#optKhungGia').val();


		// call ajax
	$.ajax({
		type: 'post',
		data : {
			'action' : 'kcn_filter_product',
			'district_id' : district_id,
			'price_range' : price_range,
		},
		url: admin_ajax.ajaxurl,
		success: function(data) {
			var result = data;
			$('.search-table').html(result) ;
			
			$('.bookmark').on('click', function(e) {
		e.preventDefault();
		
		var post_id = $(this).attr('data-id');
		var action_to_do =  $(this).text();
	
	// call ajax
	$.ajax({
		type: 'post',
		data : {
			'action' : 'kcn_bookmark_product',
			'id' : post_id,
			'todo' : action_to_do,
		},
		url: admin_ajax.ajaxurl,
		success: function(data) {
			var result = JSON.parse(data);
			if (result.response == 'success') {
				if (result.action =='booked') {
					alert('Đã lưu tin');
					//change text 
					$('#'+ post_id).html('Bỏ lưu');	
				} else if(result.action =='unbooked')  {
					alert('Đã bỏ lưu tin');
					//change text 
					$('#'+ post_id).html('Lưu sản phẩm');	
				}
				

			}
		}
	});

	});

		}
	});


	});

	
});