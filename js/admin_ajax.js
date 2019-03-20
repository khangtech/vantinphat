$ = jQuery.noConflict();

$(document).ready(function() {

	$('.remove_registrator').on('click', function(e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
		
		$.ajax({
			type: 'post',
			data : {
				'action' : 'kcn_delete_registration',
				'id' : id,
				'type' : 'delete'
			},

			url : admin_ajax.ajaxurl,
			success: function (data) {
				var result = JSON.parse(data);
				if (result.response=='success') {
					jQuery("[data-id='" + result.id + "']").parent().parent().remove();
					alert('Đã xóa xong');
				}
			}
		});
	});
});