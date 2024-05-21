<!DOCTYPE html>
<html lang="en">
<head>
<?php include('common/header_script.php'); ?>	
</head>

<body>

    <?php include('common/side.php'); ?>
    <!-- /# sidebar -->

    <?php include('common/header.php'); ?>
    
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-lg-6 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>User</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">User</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <div class="card">
                        <div class="card-header m-b-20">
                           <div class="card-header m-b-20">
								<div class="row form-group">
								<form action="<?=site_url('web-admin/user');?>" method="post">
								<div class="row">
										<div class="col-md-4">
										<select class="form-control" name="status">
										<!--  <option value="-" >All</option> -->
											<option value="A" <?php echo (('A'==$status)?'selected':''); ?>>Activated</option>
											<option value="D" <?php echo (('D'==$status)?'selected':''); ?>>Deactivated</option>
											
										</select>
										</div>
										<div class="col-md-4">
										<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
										<input type="submit" class="form-control btn btn-success" value="Fetch">
										</div>
									</form>
									<div class="col-md-3">
									<?php if(in_array('1',$other_action)){ ?>
										<input type="button" class="form-control btn btn-success" data-toggle="modal" data-target="#addUser" value="Add New">
									<?php } ?>
									</div>
								</div>
							</div>
                        </div>
                        <div class="card-body">
							<table class="table f-s-13">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Email_ID</th>
                                        <th>Type</th>
										<th>CreateAT</th>
										<th>LastUpdate</th>
										<th>UpdateBy</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
								<tbody>
									<?php $i=1; foreach($emp as $em){ ?>
									<tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$em->f_name;?></td>
                                        <td><?=$em->email_id;?></td>
                                        <td><?= strtoupper($user_type[$em->type]->name); ?></td>
										<td><?= date('Y-m-d H:i:s',strtotime($em->create_time)); ?></td>
										<td><?= date('Y-m-d H:i:s',strtotime($em->update_time)); ?></td>
										<td><?=$user_info[$em->update_by]->f_name;?></td>
										<td>
											<?php if(in_array('2',$other_action)){ ?><a href="<?=site_url('/web-admin/user/user_access');
											?>?user_id=<?=data_encode($em->id);?>" class="badge badge-primary">Profile</a><?php } ?>
										</td>
                                    </tr>
									<?php } ?>
								</tbody>
							</table>
							<div class="m-t-10 text-center"></div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer">
                                <p>This page was generated on <span id="date-time"><?= date('h:i a, d M Y')?>. </span> <a href="#" class="page-refresh">Refresh Page</a></p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
  <!--add slider-->
	
<div class="modal fade" id="addUser" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add User</h4>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					<div id="mediaadd" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-12 attach-details">
								<form class="form-submit" method="post" action="<?= site_url('/web-admin/user/add_user')?>">
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<label>First Name</label>
											<input type="text" name="fname" class="form-control" placeholder="First Name">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Last Name</label>
											<input type="text" name="lname" class="form-control" placeholder="Last Name">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group ">
											<label>Type</label>
											<select name="type" class="form-control">
											<?php foreach($user_type as $key => $obj){ ?>
												<option value="<?=$obj->user_key;?>"><?=strtoupper($obj->name);?></option>
											<?php } ?>
											</select>
										</div>
										<div class="col-md-6 col-sm-12 form-group ">
											<label>Email ID</label>
											<input type="email" name="email" class="form-control" placeholder="Email-ID">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group">
											<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
											<button type="submit" class="btn btn-success" style="width: 100%;"><span class="btn-val">Add User</span></button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<!--End Add Home Slide-->

    <!-- jquery vendor -->
    <script src="<?= base_url('web-app/assets'); ?>/js/lib/jquery.min.js"></script>
    <script src="<?= base_url('web-app/assets'); ?>/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="<?= base_url('web-app/assets'); ?>/js/lib/menubar/sidebar.js"></script>
    <script src="<?= base_url('web-app/assets'); ?>/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="<?= base_url('web-app/assets'); ?>/js/lib/bootstrap.min.js"></script>
    <!-- bootstrap -->
    <script src="<?= base_url('web-app/assets'); ?>/js/scripts.js"></script>
    <script src="<?= base_url('web-app/assets'); ?>/js/myjs.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
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
				if(item != "" && status != "")
				{
					$("#page-"+item).html("<img src='<?= base_url('assets'); ?>/images/loader.gif' style='width: 40px;'>");
					$.ajax({
						type: "POST",
						url: "<?= site_url('home/change_testimonial_status'); ?>",
						data: {status:status,id:item},
						dataType: 'json',
						cache: false,
						success: function(result){
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
</body>
</html>