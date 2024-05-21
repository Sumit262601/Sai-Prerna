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
                                <h1>Menu</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Menu</li>
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
                                <form action="<?=site_url('web-admin/menu');?>" method="post">
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
									<a class="btn btn-success form-control" href="#" data-toggle="modal" data-target="#addContent">Add</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table f-s-13">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Menu</th>
                                        <th>HREF URL</th>
                                        <th>Sequence</th>
                                        <th>Last Update</th>
                                        <th>Updated By</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($menu as $mn){ ?>
									<tr>
                                        <td><?= $i++?></td>
                                        <td><?= $mn->menu; ?></td>
                                        <td><?= $mn->href_url; ?></td>
                                        <td><?= $mn->sequence; ?></td>
                                        <td><?= $mn->last_update; ?></td>
                                        <td><?= $user_info[$mn->update_by]->f_name; ?></td>
                                        <td id="status-<?=$mn->id?>">
										<?= ($mn->status == 'D')?'<a href="#" data-src="'.site_url('web-admin/menu/change_menu_status'). 
                                        '" data-id="'.$mn->id.'" data-status="'.$mn->status.'" class="change-status badge badge-primary">ACTIVE</a>'
                                            :
                                            '<a href="#" data-src="'.site_url('web-admin/menu/change_menu_status').'" data-id="'.$mn->id.'" 
                                            data-status="'.$mn->status.'" class="change-status badge badge-danger">DEACTIVE</a>'; 
                                        ?>
										</td>
                                        <td>
                                            <a class="edit-menu badge badge-primary" href="#" data-toggle="modal" data-target="#editContent" 
                                            data-menu="<?= $mn->menu; ?>" 
                                            data-sequence="<?= $mn->sequence; ?>" 
                                            data-url="<?= $mn->href_url; ?>"
                                            data-menu_id="<?= $mn->id; ?>"
                                             > Edit</a>
										</td>
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
                                <p>This page was generated on <span id="date-time"><?= date('h:i a, d M Y')?>. </span> <a href="#" class="page-refresh">Refresh Page</a></p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


    <!--- Add page url modals   --->
    <div class="modal fade" id="addContent" role="dialog">
        <div class="modal-dialog modal-lg modal-full">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Menu</h4>
                </div>
                <div class="modal-body">
                    <div class="tab-content">
                        <div id="mediaadd" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-12 col-md-12 attach-details">
                                    <form class="form-submit" method="post" action="<?= site_url('web-admin/menu/add-menu')?>">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 form-group ">
                                                <input type="text" name="menu" class="form-control" placeholder="Menu">
                                            </div>
                                            <div class="col-md-12 col-sm-12 form-group ">
                                                <input type="text" name="sequence" class="form-control" placeholder="Sequence">
                                            </div>
                                            <div class="col-md-12 col-sm-12 form-group" >
                                                <input type="text" name="url" class="form-control" placeholder="Href Url">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 form-group">
                                                <input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
                                                <button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Add Menu</span></button>
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
    <!-- End Of add menu -->


    <!--  -->
    <div class="modal fade" id="editContent" role="dialog">
        <div class="modal-dialog modal-lg modal-full">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Menu</h4>
                </div>
                <div class="modal-body">
                    <div class="tab-content">
                        <div id="mediaadd" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-12 col-md-12 attach-details">
                                    <form class="form-submit" method="post" action="<?= site_url('web-admin/menu/update_menu')?>">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 form-group ">
                                                <input type="text" name="edit_menu" class="form-control" placeholder="Menu">
                                            </div>
                                            <div class="col-md-12 col-sm-12 form-group ">
                                                <input type="text" name="edit_sequence" class="form-control" placeholder="Sequence">
                                            </div>
                                            <div class="col-md-12 col-sm-12 form-group" >
                                                <input type="text" name="edit_url" class="form-control" placeholder="Url">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 form-group">
                                                <input type="hidden" class="form-control" name="menu_id">
                                                <input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
                                                <button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Update Menu</span></button>
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
    <script>
        $( function() {
            $( "#datepicker" ).datepicker({
                maxDate : "-18y",
                changeYear: true,
                changeMonth: true
            });
            $( "#datepicker1,#datepicker2" ).datepicker({
                changeYear: true,
                changeMonth: true
            });

			$('.edit-menu').on('click',function(){
				var menu_id = $(this).data('menu_id');
				var menu = $(this).data('menu');
				var sequence = $(this).data('sequence');
				var url = $(this).data('url');
				
				$('input[name=menu_id]').attr('value',menu_id);
				$('input[name=edit_menu]').attr('value',menu);
				$('input[name=edit_sequence]').attr('value',sequence);
				$('input[name=edit_url]').attr('value',url);
			});
		});
    </script>

    
</body>
</html>