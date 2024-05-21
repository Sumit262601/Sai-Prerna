<!DOCTYPE html>
<html lang="en">
<head>
<?php include('common/header_script.php'); ?>	
</head>
<body>
<?php include('common/side.php'); ?>
    <?php include('common/header.php'); ?>
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Web Settings</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">web_settings</li>
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
                                <form action="<?=site_url('web-admin/web_settings');?>" method="post">
									<div class="col-md-4">
											<select class="form-control" name="status">
											    <option value="A" <?php echo (('A'==$status)?'selected':'');?>>Activated</option>
												<option value="D" <?php echo (('D'==$status)?'selected':'');?>>Deactivated</option>
											</select>
									</div>
									<div class="col-md-4">
										<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
									   <input class="form-control badge-success" value="Fetch" type="submit"/>
									</div>
								</form>
                                <div class="col-md-4 text-right">
									<a class="btn btn-success form-control" href="#" data-toggle="modal" data-target="#addContent">Add</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table f-s-13">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>status</th>
                                        <th>last_update</th>
                                        <th>update_by</th>
                                        <th>name</th>
                                        <th>value</th>
										<th>Status</th>
										<th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($web_settings as $wset){ ?>
								<form class="form-submit" method="post" action="<?= site_url('web-admin/web_settings/update_web_settings')?>">
									<tr>
                                        <td><?= $i++;?></td>
                                        <td><?= $wset->status;?></td>
                                        <td><?= $wset->last_update;?></td>
                                        <td><?= $wset->update_by;?></td>
										<td> <input name="edt_name" class="form-control" value="<?= $wset->name;?>" />  </td>
										<td> <textarea name="edt_value" class="form-control" width="200px"><?= $wset->value;?></textarea>  </td>
										<td id="status-<?=$wset->id?>"><?= ($wset->status == 'D')?'<a href="#" data-src="'.site_url('web-admin/web_settings/change_web_settings_status').
										'"  data-id="'.$wset->id.'" data-status="'.$wset->status.'" class="change-status badge badge-primary">ACTIVE</a>'
										:'<a href="#" data-src="'.site_url('web-admin/web_settings/change_web_settings_status').'"  data-id="'.$wset->id.'" data-status="'.$wset->status.'" class="change-status badge badge-danger">DEACTIVE</a>'; ?></td>
                                        <td>
											<input type="hidden" class="form-control" name="web_settingsid" value="<?= $wset->id; ?>">
											<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
											<button type="submit"  class="edit-course badge badge-primary"> Update </button>
											
										</td>
                                    </tr>
								</form>
									<?php }?>
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
<!-- All good uptill here -->

<div class="modal fade" id="addContent" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add more settings</h4>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					<div id="mediaadd" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-12 attach-details">
								<form class="form-submit" method="post" action="<?= site_url('web-admin/web_settings/add_web_settings')?>">
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group ">
											<input type="text" name="name" class="form-control" placeholder="Enter Name">
										</div>
                                        <div class="col-md-6 col-sm-12 form-group ">
											<input type="text" name="value" class="form-control" placeholder="value">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group">
											<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Add </span></button>
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