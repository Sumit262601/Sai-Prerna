
    <!-- jquery vendor -->
    <script src="<?= site_url('assets'); ?>/js/lib/jquery.min.js"></script>
    <script src="<?= site_url('assets'); ?>/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="<?= site_url('assets'); ?>/js/lib/menubar/sidebar.js"></script>
    <script src="<?= site_url('assets'); ?>/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="<?= site_url('assets'); ?>/js/lib/bootstrap.min.js"></script>
    <!-- bootstrap -->
    <script src="<?= site_url('assets'); ?>/js/scripts.js"></script>
    <script src="<?= site_url('assets'); ?>/js/myjs.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
	var csrf_token = '<?=csrf_token();?>';
	var csrf_hash = '<?=csrf_hash();?>';
	$( ".datepicker" ).datepicker({
                dateFormat: 'yy-mm-dd'
            });
        $( function() {
            $( "#datepicker" ).datepicker({
                maxDate : "-18y",
                changeYear: true,
                changeMonth: true
            });
            $( "#datepicker1,#datepicker2" ).datepicker({
				dateFormat: 'yy-mm-dd',
                changeYear: true,
                changeMonth: true
            });
			
			$('.change-status').on('click', function(){
				var item = $(this).data('id');
				var status = $(this).data('status');
				var src = $(this).data('src');
				if(item != "" && status != "")
				{
					$("#news-"+item).html("<img src='<?= base_url('assets'); ?>/images/loader.gif' style='width: 40px;'>");
					$.ajax({
						type: "POST",
						url: src,
						data: {status:status,id:item, [csrf_token]:csrf_hash},
						dataType: 'json',
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
				}
			});
		});
    </script>