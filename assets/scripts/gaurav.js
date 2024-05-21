var csrf_token = '<?=csrf_token();?>';
var csrf_hash = '<?=csrf_hash();?>';
function update_token2(result)
{
    csrf_token = result.message.cname;
    csrf_hash = result.message.cvalue;
}
$(document).ready(function(){
    $('.form-submit').submit(function(e){
        e.preventDefault();
        var frm = $(this);
        frm.find('.frm-error').remove();
        $('#toast-erromsg').html(null).hide();
        frm.find('.border-danger').removeClass('border-danger');
        $('.preloader').show();
        $.ajax({
            url: frm.attr('action'),
            data: new FormData(this),
            type: 'post',
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            success: function(result){
                update_token2(result);
					$('input[name='+ csrf_token +']').attr('value',csrf_hash);
                if(result.success == true){
                    if(result.rlink){
                        window.location.href = result.rlink;
                    }else if(result.alert){
                        frm.before(result.alert);
                    }else if(result.alert1){
                        frm.before(result.alert1);
                        frm.remove();
                    }else{
                        location.reload();
                    }
                }else{
                    $.each(result.message, function(key,value){
                        var inpt = frm.find('input[name='+key+'], textarea[name='+key+'], select[name='+key+']');
                        if(value.length > 2){
                            if(result.border == true){
                                inpt.addClass('border-danger');
                                $('#toast-erromsg').show().append(value);
                            }else{
                                inpt.addClass('border-danger').before(value);
                            }
                        }
                    });
                    setTimeout(function(){
                        $('#toast-erromsg').fadeOut(600)
                    }, 3500);
                }
                $('.preloader').hide();
            }
        });
    });
});