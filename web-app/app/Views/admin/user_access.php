<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sai-Prerna | Trust</title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/fevicon.png'); ?>">
    <!-- Styles -->
    <link href="<?= base_url('assets'); ?>/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/themify-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/unix.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/style.css" rel="stylesheet">
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
                                <h1>User Access</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">User Access</li>
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
                            <div class="row form-group">

								<form action="<?=site_url('user/user_access');?>" method="get">
									<div class="col-md-4">
										<select class="form-control" name="user_id">
										<?php foreach($emp as $em){ ?>
											<option value="<?=$em->id;?>" 
												<?php echo (($user_id==$em->id)?'selected':''); ?>><?=ucfirst($em->f_name);?>
											</option>
										<?php } ?>
										</select>
									</div>
									<div class="col-md-4">
									<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
										<input type="submit" class="form-control btn btn-success" value="Fetch">
									</div>
								</form>
								
								<div class="col-md-4">
								<?php if(in_array('1',$other_action)){ ?>
									<input type="button" class="form-control btn btn-success" data-toggle="modal" data-target="#addUser" value="Add New">
								<?php } ?>
								</div>
							</div>
                        </div>
                        <div class="card-body">
							<div class="row">
                                <div class="col-md-6">
									<form class="form-submit" method="post" action="<?= site_url('/web-admin/user/update_user_info'); ?>">
									<fieldset>
									<legend>User Information</legend>
										<div class="row form-group">
											<div class="col-md-6">
												<label>First Name</label>
												<input type="text" name="f_name" value="<?=$emp_info->f_name;?>" class="form-control">
											</div>
											<div class="col-md-6">
												<label>Last Name</label>
												<input type="text" name="l_name" value="<?=$emp_info->l_name;?>" class="form-control">
											</div>
										</div>
										<div class="row form-group">
											<div class="col-md-6">
												<label>Email ID</label>
												<input type="text" name="email" value="<?=$emp_info->email_id;?>" class="form-control">
											</div>
											<div class="col-md-6">
												<label>Password</label>
												<input type="text" name="password" value="<?=$emp_info->password;?>" class="form-control">
											</div>
										</div>
										<div class="row form-group">
											<div class="col-md-6">
												<select name="type" class="form-control">
												<?php foreach($user_type as $ut){ ?>
													<option value="<?= $ut->user_key; ?>" <?= (($emp_info->type == $ut->user_key)?'selected':''); ?> >
														<?= $ut->name; ?>
													</option>
												<?php } ?>
												</select>
											</div>
											<div class="col-md-6">
												<select name="status" class="form-control">
													<option value="A" <?= (($emp_info->status == "A")?'selected':''); ?> >Activate</option>
													<option value="D" <?= (($emp_info->status == "D")?'selected':''); ?> >Deactivate</option>
												</select>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-md-12">
											<?php if(in_array('2',$other_action)){ ?>
												<input type="hidden" name="user_id" value="<?= $user_id; ?>">
												<input id="csrf_token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
												<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Update</span></button>
											<?php } ?>
											</div>
										</div>
									</fieldset>
									</form>
                                </div>

                                <div class="col-md-6">
									<form class="form-submit" method="post" action="<?= site_url('web-admin/user/update_access'); ?>">
										<table class="table f-s-13">
											<?php foreach($menu as $tbgroup => $submenu){ ?>
												<tr>
													<th>
														<i class="<?=$submenu['icon'];?>"></i>
													</th>
													<th colspan="2">
														<?=$tbgroup;?>
													</th>
												</tr>
												<?php 
													foreach($submenu['menu'] as $name => $prop){ 
													$oa = explode(',',$prop['other_action']);
												?>
													<tr>
														<th>
															<input type="checkbox" name="tab[]" value="<?=$prop['id']; ?>" 
															<?php echo ((isset($user_access[$prop['id']]) && $user_access[$prop['id']]['status']=='A')?'checked':''); ?> >
														</th>
														<th>
															<?=$name;?>
														</th>
														<td>
															<?php 
															if($oa[0] != null)
															{
																$uaoa = array();
																if(isset($user_access[$prop['id']]['other_action']))
																{
																	$uaoa = explode(' ',$user_access[$prop['id']]['other_action']);
																}
																foreach($oa as $a){
																	$toa = explode('|',$a);
																	echo '<label><input type="checkbox" name="action['.$prop['id'].'][]" value="'.$toa[1].'" '.((in_array($toa[1],$uaoa)?'checked':'')).'> '.ucfirst($toa[0]).'</label> ';
																}
															}
															?>
														</td>
													</tr>
												<?php } ?>
											<?php } ?>
											<tr>
												<td colspan="3">
												<?php if(in_array('1',$other_action)){ ?>
													<input type="hidden" name="user_id" value="<?= $user_id; ?>">
													<input id="csrf_token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
													<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Update</span></button>
												<?php } ?>
												</td>
											</tr>
										</table>
									</form>
                                </div>
                            </div>
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
								<form class="form-submit" method="post" action="<?= site_url('web-admin/user/add_user')?>">
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
												<option value="cms">CMS</option>
												<option value="lms">LMS</option>
												<option value="student">STUDENT</option>
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
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Add User</span></button>
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

<?php include('common/footer.php'); ?>
</body>
</html>