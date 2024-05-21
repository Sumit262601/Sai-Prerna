<!DOCTYPE html>
<html lang="en">
<head>
<?php include('common/header_script.php'); ?>
	<style>
	.btn-custom {
		width: 100%;
		color: #fff;
		border-radius: 0;
		outline: 0 !important;
		font-weight: 500;
		background: #ee0000;
	}
	.media-list, .media-list1 {
		list-style-type: none;
		margin-top: 0;
		padding-top: 20px;
		padding-left: 0;
		height: 420px;
		overflow-y: overlay;
	}
	.media-list li, .media-list1 li {
		display: inline-block;
		margin-description: 12px;
	}
	.media-list1 input[type=radio] {
		display: none;
		position: relative;
		top: -67px;
		left: 12px;
	}
	.media-list img, .media-list1 img {
		width: 130px;
		height: 120px;
	}
	.attach-details {
		background: #f2f2f2;
		padding: 10px 10px;
		height: 420px;
		overflow-y: scroll;
	}
	.attach-details h6 {
		text-transform: uppercase;
		text-align: center;
	}
	.attach-details img {
		width: 100%;
		height: 140px;
	}
	.attach-details hr {
		border-top: 1px solid #ddd;
	}
	.attach-details .form-group {
		display: inline-block;
		margin-description: 5px;
	}
	.attach-details label {
		display: inline-block;
		width: 100%;
		text-align: left;
		padding-right: 5px;
		font-size: 12px;
		font-weight: 500;
	}
	.attach-details .form-control {
		color: #666 !important;
		font-size: 14px;
		padding: 5px 5px;
		display: inline-block;
		width: 100%;
		vertical-align: middle;
	}
	.btn-custom {
		width: 100%;
		color: #fff;
		border-radius: 0;
		outline: 0 !important;
		font-weight: 500;
		background: #ee0000;
	}
	.btn-custom span.btn-val {
		top: 0;
		right: 0;
		padding: 0;
		color: #fff;
		font-size: 14px;
		cursor: pointer;
		display: inline-block;
		position: relative;
		transition: 0.5s;
	}
	.modal-dialog{
		margin: 0px auto;
		width: 90%;
	}
	.radio-control label {
		width: 20%;
		font-size: 16px;
	}
	</style>
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
                                <h1>About</h1>
							
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">About</li>
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
								<form action="<?=site_url('web-admin/about');?>" method="post">
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
                                    <a class="btn btn-success form-control" href="#" data-toggle="modal" data-target="#addabout">Add</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table f-s-13">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Heading</th>
                                        <th>Description</th>
                                        <th>Updated On</th>
                                        <th>Updated By</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($about as $abt){?>
									<tr>
                                        <td><img src="<?=site_url();?>images/<?= $images[$abt->img]->location; ?>" width="200px"></td>
                                        <td><?= $abt->heading; ?></td>
                                        <td style="width:500px;"><?= $abt->description; ?></td>
                                        <td><?= $abt->last_update; ?></td>
                                        <td><?= $user_info[$abt->update_by]->f_name; ?></td>
                                        <td id="about-<?=$abt->id?>"><?= ($abt->status == 'D')?'
											<a href="#" data-src="'.site_url('/web-admin/about/change-status-about').'"    
											data-id="'.$abt->id.'" data-status="'.$abt->status.'" class="change-status badge badge-primary">ACTIVE</a>' 
											: '<a href="#"  data-src="'.site_url('/web-admin/about/change-status-about').'"   
											data-id="'.$abt->id.'" data-status="'.$abt->status.'" class="change-status badge badge-danger">DEACTIVE</a>'; ?>
										</td>
                                        <td>
											<a class="edit-about badge badge-primary" href="#" data-toggle="modal" data-target="#editabout" 
												data-imgid="<?=$abt->img?>" 
												data-heading="<?= $abt->heading; ?>" 
												data-description="<?= $abt->description; ?>"
												data-img_src="<?=site_url();?>images/<?= $images[$abt->img]->location; ?>" 
												data-aboutid="<?= $abt->id; ?>" 
											 >Edit</a></td>
                                    </tr>
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
                                <p>This page was generated on <span id="date-time"><?= date('h:i a, d M Y')?>. </span> <a href="#" class="page-refresh">Refresh page kar sakte ho agar dil kare to</a></p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    
    <!--add about-->
	
<div class="modal fade" id="addabout" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">About Edit</h4>
			</div>
			<div class="modal-body">
				<ul class="nav nav-tabs">
					<li ><a data-toggle="tab" href="#uploadadd">Upload Files</a></li>
					<li class="active"><a data-toggle="tab" href="#mediaadd">Media Library</a></li>
				</ul>
				<div class="tab-content">
					<div id="uploadadd" class="tab-pane fade">
						<form class="form-submit" style="margin:40px 0;" action="<?= site_url('/web-admin/about/upload_about_img')?>" method="post" enctype="multipart/form-data">
							<input type="file" name="about_images" multiple>
							<small>Image Size : (1920x1080)</small>
							<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
							<button type="submit" class="btn btn-custom" style="margin-top:10px;"><span class="btn-val">Upload</span></button>
						</form>
					</div>
					<div id="mediaadd" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-6">
								<ul class="media-list1">
									<?php foreach($images as $img){?>
									<li>
										<label> 
											<input type='radio' value='<?= $img->id; ?>' name='imgradio'/> 
											<img class="img-select" data-id="<?= $img->id; ?>" src='<?= site_url('images'); ?>/<?= $img->location; ?>' class='single-image'/> 
										</label>
									</li>
									<?php } ?>
								</ul>
							</div>

							<div class="col-sm-6 attach-details">
								<form class="form-submit" method="post" action="<?= site_url('/web-admin/about/add_about')?>">
									<div class="row">
										<div class="col-md-12">
											<h6>About Details</h6>
											<img src="<?=base_url("assets/images/question/")?>Penguins.jpg" id="display-img" title="">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<input type="text" name="heading" class="form-control" placeholder="Heading">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<textarea type="text" name="description" class="form-control" placeholder="Description"></textarea>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group">
											<input type="hidden" class="form-control" name="image_id">
											<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Add About</span></button>
										</div>
										<div class="col-md-6 col-sm-12 form-group">
										<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
											<button type="button" class="btn btn-danger" style="width: 100%;"> <span class="btn-val">Delete Image</span></button>
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
<!--End Add Home About-->

<!--Edit Aboutr-->
	
<div class="modal fade" id="editabout" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">About Edit</h4>
			</div>
			<div class="modal-body">
				<ul class="nav nav-tabs">
					<li ><a data-toggle="tab" href="#edtuploadadd">Upload Files</a></li>
					<li class="active"><a data-toggle="tab" href="#edtmediaadd">Media Library</a></li>
				</ul>
				<div class="tab-content">
					<div id="edtuploadadd" class="tab-pane fade">
						<form class="form-submit" style="margin:40px 0;" action="<?= site_url('/web-admin/about/upload_about_img')?>" method="post" enctype="multipart/form-data">
							<input type="file" name="about_images" multiple>
							<small>Image Size : (1920x1080)</small>
							<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
							<button type="submit" class="btn btn-custom" style="margin-top:10px;"> <span class="btn-val">Upload</span></button>
						</form>
					</div>
					<div id="edtmediaadd" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-6">
								<ul class="media-list1">
									<?php foreach($images as $img){?>
									<li>
										<label> <input type='radio' value='<?= $img->id; ?>' name='imgradio'/> <img class="edit-img-select" data-id="<?= $img->id; ?>" src='<?= site_url('images'); ?>/<?= $img->location; ?>' class='single-image'/> </label>
									</li>
									<?php } ?>
								</ul>
							</div>

							<div class="col-sm-6 attach-details">
								<form class="form-submit" method="post" action="<?= site_url('/web-admin/about/update_about')?>">
									<div class="row">
										<div class="col-md-12">
											<h6>About Details</h6>
											<img src="<?=base_url("assets/images/question/")?>Penguins.jpg" id="edit-display-img" title="">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<input type="text" name="edt_heading" class="form-control" placeholder="Heading">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<input type="text" name="edt_description" class="form-control" placeholder="Description" />
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group">
											<input type="hidden" class="form-control" name="edt_image_id">
											<input type="hidden" class="form-control" name="about_id">
											<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Update About</span></button>
										</div>
										<div class="col-md-6 col-sm-12 form-group">
										<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
											<button type="button" class="btn btn-danger" style="width: 100%;"> <span class="btn-val">Delete Image</span></button>
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
<!--End Edit Home About-->
<?php include('common/footer.php'); ?>
    <script>
        $( function() {
			$('.img-select').on('click',function(){
				//alert($(this).data('id'));
				var img_src = $(this).attr('src');
				var img_id = $(this).data('id');
				$('#display-img').attr('src',img_src);
				$('input[name=image_id]').attr('value',img_id);
			});
			$('.edit-img-select').on('click',function(){
				//alert($(this).data('id'));
				var img_src = $(this).attr('src');
				var img_id = $(this).data('id');
				$('#edit-display-img').attr('src',img_src);
				$('input[name=edt_image_id]').attr('value',img_id);
			});
			
			$('.edit-about').on('click',function(){
				var aboutid = $(this).data('aboutid');
				var imgid = $(this).data('imgid');
				var heading = $(this).data('heading');
				var description = $(this).data('description');
				var img_src = $(this).data('img_src');
				
				$('input[name=about_id]').attr('value',aboutid);
				$('input[name=edt_image_id]').attr('value',imgid);
				$('input[name=edt_heading]').attr('value',heading);
				$('input[name=edt_description]').attr('value',description);
				$('#edit-display-img').attr('src',img_src);
			});
		});
    </script>
</body>
</html>