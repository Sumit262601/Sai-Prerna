function update_token(result)
{
    csrf_token = result.message.cname;
    csrf_hash = result.message.cvalue;
}
$(document).ready(function(){
    chk_lnnks(window.location.href);
    $('.form-submit').submit(function(e){
       e.preventDefault();
       var frm = $(this);
       frm.find('.frm-error').remove();
       $('#toast-erromsg').html(null).hide();
       frm.find('.border-danger').removeClass('border-danger');
       $('.preloader').show();
       var csrf = frm.find('#csrf-token').val();
       
        $.ajax({
           url: frm.attr('action'),
           data: new FormData(this),
           type: 'post',
           dataType: 'json',
           contentType: false,
           processData: false,
           cache: false,
           success: function(result){
			   update_token(result);
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
   
   
    $('.get_data').submit(function(e){
       e.preventDefault();
       var frm = $(this);
       frm.find('.frm-error').remove();
       $('#toast-erromsg').html(null);
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
               $('.preloader').hide();
               if(result.success == true){
                   $(frm.data('callback')).html(result.contnt);
               }else{
                   $.each(result.message, function(key,value){
                       var inpt = frm.find('input[name='+key+'], textarea[name='+key+'], select[name='+key+']');
                       if(value.length > 2){
                           inpt.addClass('border-danger');
                           $('#toast-erromsg').show().append(value);
                       }
                   });
                   setTimeout(function(){
                       $('#toast-erromsg').fadeOut(600)
                   }, 2500);
               }
           }
       });
   });
   $('#backtolog').click(function(){
       $('#forhetPass').hide();
       $('#loginghg').show();
   });
   $('#forgouij').click(function(){
       $('#forhetPass').show();
       $('#loginghg').hide();
   });
   
   $("#searchInput").on("keyup", function() {
       var value = $(this).val().toLowerCase();
       $("#searchTable tr").filter(function() {
         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
       });
     });
});

function chk_lnnks(str){
   $('a.nvlnk').each(function(){
       var ctrlnk = $(this).attr('href');
       if(ctrlnk == str){
           $(this).parent('li').addClass('active');
           $(this).parents('li.opn-prn').addClass('active open');
       }
   });
}

function previreImg(input, id) {
 if (input.files && input.files[0]) {
   var reader = new FileReader();
   reader.onload = function(e) {
     $('#'+id).attr('src', e.target.result);
   }
   reader.readAsDataURL(input.files[0]);
 }
}
