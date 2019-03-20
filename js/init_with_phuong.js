$ = jQuery.noConflict();

$(document).ready(function() {

	

	//load phuong theo quan
	$("#cboChonQuan").on('change', function(e){
		var district_id = this.options[e.target.selectedIndex].value;	
		// call ajax
		$.ajax({
			type: 'post',
			data : {
				'action' : 'kcn_load_wards',
				'id' : district_id,
			},
			url: admin_ajax.ajaxurl,
			success: function(data) {
				var result = JSON.parse(data);
				
				if (result.response == 'success') 
				{
					var list_phuong = result.list_ward;

					$("#cboChonPhuong").children().remove();
					$("#cboChonPhuong").append('<option value="0">Chọn phường</option>');
					for (i=0; i< list_phuong.length; i++)
						$("#cboChonPhuong").append('<option value="' + list_phuong[i]["id"] + '">' +  list_phuong[i]["name"] + '</option>');
				}
			}
		});

	});



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
});