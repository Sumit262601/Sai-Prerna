$(document).ready(function(){
    
	$('.form-submit').submit(function(e){
        e.preventDefault();
        var frm = $(this);
		var form_btn = $(frm).find('button[type="submit"]');
		var form_result_div = '#form-result';
		$(form_result_div).remove();
		form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
		var form_btn_old_msg = form_btn.html();
		form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
		$.ajax({
            url: frm.attr('action'),
            data: new FormData(this),
            type: 'post',
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            success: function(result){
                if(result.success == true){
					$(frm).find('.form-control').val('');
					form_btn.prop('disabled', false).html(form_btn_old_msg);
                    if(result.rlink){
                        window.location.href = result.rlink;
                    }else if(result.alert){
                        $(form_result_div).html(result.alert).fadeIn('slow');
                    }else if(result.alert1){
						$(form_result_div).html(result.alert1).fadeIn('slow');
						setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
                    }else{
                        location.reload();
                    }
                }else{
					form_btn.prop('disabled', false).html(form_btn_old_msg);
					var error = '';
                    $.each(result.message, function(key,value){
                        var inpt = frm.find('input[name='+key+'], textarea[name='+key+'], select[name='+key+']');
                        if(value.length > 2){
                            if(result.border == true){
                                inpt.addClass('border-danger');
								error = error+', '+value;
                            }else{
                                inpt.addClass('border-danger').before(value);
                            }
                        }
                    });
					$(form_result_div).html(error).fadeIn('slow');
					setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
					
                }
               
            }
        });
    });
	$("#cookie-btn").on("click",function(){
		$.ajax({
            url: "https://www.publicpoliceindia.com/form/cookie_session.html",
            type: 'post',
            dataType: 'json',
            success: function(result){
                if(result.success == true){
					$(".cookie-bar").css("display","none");
                }
            }
        });
	});
});