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
                                <h1>Services</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">service</li>
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
                            <div class="row">
                                <form action="<?=site_url('web-admin/service');?>" method="post">
									<div class="col-md-4">
											<select class="form-control" name="status">
												<option value="A"  <?php echo (('A'==$status)?'selected':''); ?> >Activated</option>
												<option value="D"  <?php echo (('D'==$status)?'selected':''); ?> >Deactivated</option>
											</select>
									</div>
									<div class="col-md-4">
										<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
									   <input class="form-control badge-success" value="Fetch" type="submit"/>
									</div>
								</form>
                                <div class="col-md-4 text-right">
                                    <a class="badge badge-success form-control" href="#" data-toggle="modal" data-target="#addservice">Add</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table f-s-13">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Written by</th>
                                        <th>Slogan</th>
                                        <th>Last Update</th>
                                        <th>Updated By</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($service as $srv){ ?>
									<form class="form-submit" action="<?= site_url('/web-admin/service/update_service'); ?>" method="post">
										<tr>
											<td><?= $i++; ?></td>
											<td><textarea name="edt_description" class="form-control" width="200px"><?= $srv->description; ?></textarea></td>
											<td><input type="text" name="edt_name" value="<?= $srv->name; ?>" ></td>
											<td><?= $srv->last_update; ?></td>
											<td><?= $user_info[$srv->update_by]->f_name; ?></td>
											<td id="service-<?= $srv->id?>"><?= ($srv->status == 'D')?'<a href="#" data-src="'.site_url('/web-admin/service/change_service_status').'" data-id="'.$srv->id.'" data-status="'.$srv->status.'" class="change-status badge badge-primary">ACTIVE</a>':'<a href="#"  data-src="'.site_url('/web-admin/service/change_service_status').'"data-id="'.$srv->id.'" data-status="'.$srv->status.'" class="change-status badge badge-danger">DEACTIVE</a>'; ?></td>
											<td>
												<input type="hidden" class="form-control" name="edt_id" value="<?= $srv->id; ?>">
                                                <input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
												<button type="submit" class="edit-course badge badge-primary">Update</button>
											</td>
										</tr>
									</form>
									<?php } ?>
									
                                </tbody>
                            </table>
                            <div class="m-t-10 text-center">
                               
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
	
<div class="modal fade" id="addservice" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Service</h4>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					<div id="mediaadd" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-12 attach-details">
								<form class="form-submit" method="post" action="<?= site_url('/web-admin/service/add_service')?>">
									
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group ">
											<label>Name</label>
											<input type="text" name="name" class="form-control" placeholder="Name">
										</div>
									</div>
                                    <div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<label>ET-Icon </label>
											<input type="text" name="et-icon" class="form-control" placeholder="ET-Icon">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<label>Description (Max: 50 Words)</label>
											<textarea name="description" class="form-control" placeholder="Bottom Text" ></textarea>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group">
                                        <input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Add Service</span></button>
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
<?php include('common/footer.php'); ?>
</body>
</html>