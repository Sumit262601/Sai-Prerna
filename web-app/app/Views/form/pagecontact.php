<section id="content" class="bg-sliver">
		<div class="container clearfix">
			<div class="mx-auto center" style="max-width: 900px;">
				<h2 class="mb-0 fw-light ls-1">Contact Us</h2>
			</div>
		</div>
	<div class="container clearfix">
		<div class="mx-auto topmargin" id="section-contact" style="max-width: 850px;">
			<div class="form-widget">
				<form class="row mb-0" id="template-contactform contact-form" name="template-contactform" action="<?=site_url('form/contact'); ?>" method="post">
					<div class="col-md-6 mb-4">
						<input type="text" id="template-contactform-name" name="name" value="" class="sm-form-control border-form-control required" placeholder="Name" />
					</div>
					<div class="col-md-6 mb-4">
						<input type="email" id="template-contactform-email" name="email_id" value="" class="required email sm-form-control border-form-control" placeholder="Email Address" />
					</div>
					<div class="w-100"></div>
					<div class="col-md-4 mb-4">
						<input type="text" id="template-contactform-phone" name="phone" value="" class="sm-form-control border-form-control" placeholder="Phone" />
					</div>
					<div class="col-md-8 mb-4">
						<input type="text" id="template-contactform-subject" name="purpose" value="" class="required sm-form-control border-form-control" placeholder="Purpose" />
					</div>
					<div class="w-100"></div>
					<div class="col-12 mb-4">
						<textarea class="required sm-form-control border-form-control" id="template-contactform-message" name="message" rows="7" cols="30" placeholder="Your Message"></textarea>
					</div>
					<div class="col-12 center mb-4">
	                    <input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
						<button class="button button-border button-circle fw-medium ms-0 topmargin-sm" type="submit" id="template-contactform-submit" name="submit" value="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<iframe src="<?= $settings['google-map']; ?>" width="600" height="180" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>
<!-- #content end -->


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
		$('#contact-form').submit(function(e){
			e.preventDefault();
			var response = '';
			var frm = $('#contact-form');
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
						response = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + result.alert1 + '</div>';
					}else{
						response = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + result.message.email + '</div>';
					}
					frm.prepend(response);
				}
			});
			return false;
		});
</script>
