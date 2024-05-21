<!-- Footer
	============================================= -->
	<footer id="footer" class="dark border-0">
		<div class="container">
			<div class="footer-widgets-wrap">
				<div class="row gap-5">
					<div class="col-lg-4">
						<div class="widget clearfix">
							<h4>Contact</h4>
							<p class="lead"><?= $settings['address'];; ?></p>
							<ul class="list-inline d-flex gap-4">
								<li class="#"> <a href="#" class="d-flex gap-2"> <i class="icon-mobile"></i><?= $settings['contact']; ?></a> </li>
								<li class="#"> <a href="#" class="d-flex gap-2"> <i class="icon-envelope"></i> <?= $settings['email-id']; ?></a> </li>
							</ul> 
							<div class="#">
							<?php echo (isset($settings['Facebook'])?'<a href="'.$settings['Facebook'].'" class="social-icon inline-block border-0 si-small si-facebook" title="Facebook"><i class="icon-facebook"></i><i class="icon-facebook"></i></a>':'');?>
							<?php echo (isset($settings['Twitter'])?'<a href="'.$settings['Twitter'].'" class="social-icon inline-block border-0 si-small si-twitter" title="twitter"><i class="icon-twitter"></i><i class="icon-twitter"></i></a>':'');?>
							<?php echo (isset($settings['Youtube'])?'<a href="'.$settings['Youtube'].'" class="social-icon inline-block border-0 si-small si-youtube" title="youtube"><i class="icon-youtube"></i><i class="icon-youtube"></i></a>':'');?>
							<?php echo (isset($settings['Instagram'])?'<a href="'.$settings['Instagram'].'" class="social-icon inline-block border-0 si-small si-instagram" title="instagram"><i class="icon-instagram"></i><i class="icon-instagram"></i></a>':'');?>
							<?php echo (isset($settings['Linkedin'])?'<a href="'.$settings['Linkedin'].'" class="social-icon inline-block border-0 si-small si-linkedin" title="linkedin"><i class="icon-linkedin"></i><i class="icon-linkedin"></i></a>':'');?>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="widget clearfix">
							<h4>Useful Links</h4>
							<ul class="list-unstyled footer-site-links mb-0">
								<?php foreach($menus as $mn)  { ?>
									<li><a href="#" data-scrollto="<?= $mn->href_url ?>" data-easing="easeInOutExpo" data-speed="1250" data-offset="70"><?= $mn->menu ?></a></li>
                            	<?php  } ?>
							</ul>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="widget subscribe-widget clearfix" data-loader="button">
							<h4>Subscribe</h4>
							<p><?= $settings['subscribe']; ?></p>
							<div class="widget-subscribe-form-result"></div>
							<form id="widget-subscribe-form subscription-form2" action="<?=site_url("form/subscribe");?>" method="post">
								<input type="email" id="widget-subscribe-form-email" name="email" class="form-control form-control-lg not-dark required email" placeholder="Your Email" />
								<span class="">
									<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
									<button class="button button-border button-circle button-light topmargin-sm" type="submit"><i class="icon-paper-plane"></i></button>
								</span>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Subscription Form Validation-->
		<script type="text/javascript">
			var csrf_token = '<?=csrf_token();?>';
			var csrf_hash = '<?=csrf_hash();?>';
			function update_token(result)
			{
				csrf_token = result.error_token.cname;
				csrf_hash = result.error_token.cvalue;
				$('input[name='+ csrf_token +']').attr('value',csrf_hash);
			}
				$('#subscription-form2').submit(function(e){
					e.preventDefault();
					var response = '';
					var frm = $('#subscription-form2');
					frm.children(".alert").remove();
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
							if (result.success == true){
								response = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + result.alert + '</div>';
							}else{
								response = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + result.message.email + '</div>';
							}
							frm.prepend(response);
						}
					});
					return false;
				});
		</script>

        <div id="copyrights">
			<div class="container center clearfix">
				<?= $settings['copyright']; ?>
			</div>
		</div>
		
	</footer>