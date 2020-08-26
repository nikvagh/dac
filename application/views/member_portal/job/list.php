
<!DOCTYPE html>
<html lang="en-us">

<head>
	<?php $this->load->view(MEMBERPATH . 'head'); ?>
	<?php $this->load->view(MEMBERPATH . 'common_css'); ?>
</head>

<body class="smart-style-1">

	<?php $this->load->view(MEMBERPATH . 'header'); ?>

	<!-- #NAVIGATION -->
	<!-- Left panel : Navigation area -->
	<!-- Note: This width of the aside area can be adjusted through LESS variables -->
	<?php $this->load->view(MEMBERPATH . 'sidebar'); ?>
	<!-- END NAVIGATION -->

	<!-- MAIN PANEL -->
	<div id="main" role="main">

		<?php $this->load->view(MEMBERPATH . 'breadcrumb'); ?>

		<!-- MAIN CONTENT -->
		<div id="content">

			<!-- row -->
			<div class="row">
				<!-- col -->
				<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
					<h1 class="page-title txt-color-blueDark">
						<?php echo $title; ?>
					</h1>
                </div>
				<!-- end col -->
			</div>
			<!-- end row -->

			<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success fade in">
					<button class="close" data-dismiss="alert">×</button>
					<i class="fa-fw fa fa-check"></i>
					<strong>Success</strong> <?php echo $this->session->flashdata('success');?>
				</div>
			<?php endif; ?>
			
			<?php if ($this->session->flashdata('error')): ?>
				<div class="alert alert-danger fade in">
					<button class="close" data-dismiss="alert">×</button>
					<i class="fa-fw fa fa-times"></i>
					<strong>Error!</strong> <?php echo $this->session->flashdata('success');?>
				</div>
            <?php endif; ?>

			<!-- widget grid -->
            <section id="widget-" class="">
				
                <!-- row -->
                <div class="row">
                    <!-- NEW WIDGET START -->
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
                            
                            <header class="bg-color-teal txt-color-white no-border box-hedaer">
                                <h2>Booking Listing </h2>
                            </header>
            
                            <!-- widget div-->
                            <div>
            
                                <!-- widget content -->
                                <div class="widget-body no-padding">
                                    
                                    <!-- <div class="text-right padding-10">
                                        <a href="<?php echo base_url().MEMBERPATH;?>job/add" class="btn btn-primary btn-sm">
                                            Add New Request
                                        </a>
                                    </div> -->

                                    <form name="datatableForm" id="datatableForm" action="<?=base_url().MEMBERPATH;?>job" method="post" enctype="multipart/form-data">
                                        <table id="dt_basic" class="table table-striped" width="100%">
                                            <thead>
                                                <tr>
                                                    <th data-hide="phone"> #</th>
                                                    <th data-class="expand"> Location</th>
                                                    <th data-hide="phone"> Vehicle</th>
                                                    <th data-hide="phone"> Notification Preference</th>
                                                    <th data-hide="phone"> Service Provider</th>
                                                    <th data-hide="phone,tablet"> Status</th>
                                                    <th> Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $cnt1 = 1; foreach($manage_data_1 as $data){ ?>
                                                    <tr>
                                                        <td><?php echo $cnt1; ?></td>
                                                        <td><?php echo $data['location']; ?></td>
                                                        <td><?php echo $data['name']; ?></td>
                                                        <td><?php echo $data['notification_preference']; ?></td>
                                                        <td>
                                                            <?php if($data['sp_id'] == 0){ ?>
                                                                NOT ASSIGN
                                                            <?php }else{ ?>
                                                                <?php echo $data['company_name']; ?>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if($data['status'] == '1'){ ?>
                                                                <a class="btn btn-warning btn-xs"><?php echo $data['status_txt']; ?></a>
                                                            <?php }else if($data['status'] == '2'){ ?>
                                                                <a class="btn btn-primary btn-xs"><?php echo $data['status_txt']; ?></a>
                                                            <?php }else if($data['status'] == '3'){ ?>
                                                                <a class="btn btn-info btn-xs"><?php echo $data['status_txt']; ?></a>
                                                            <?php }else if($data['status'] == '4'){ ?>
                                                                <a class="btn bg-color-redLight btn-xs txt-color-white"><?php echo $data['status_txt']; ?></a>
                                                            <?php }else if($data['status'] == '5'){ ?>
                                                                <a class="btn btn-success btn-xs"><?php echo $data['status_txt']; ?></a>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url().MEMBERPATH."job/view/".$data['job_request_id']; ?>" class="btn btn-info btn-sm">View</a>
                                                            <a href="<?php echo base_url().MEMBERPATH."job/track/".$data['job_request_id']; ?>" class="btn btn-info btn-sm">Track</a>
                                                            <a href="<?php echo base_url().MEMBERPATH;?>job/invoice/<?php echo $data['job_request_id']; ?>" class="btn btn-primary btn-sm">Invoice</a>
                                                            <?php //if($data['status'] == 'Pending'){ ?>
                                                                <!-- <a href="<?php echo base_url().MEMBERPATH;?>job/edit/<?php echo $data['job_id']; ?>" class="btn btn-info btn-sm">Edit</a> -->
                                                                <!-- <button type="button" class="btn btn-danger btn-sm" id="delete_<?php echo $data['service_id']; ?>" onClick="javascript: confirmDelete('datatableForm','<?php echo $data['service_id']; ?>')" >Delete</button> -->
                                                            <?php //} ?>
                                                        </td>
                                                    </tr>
                                                <?php $cnt1++; } ?>
                                            </tbody>
                                        </table>

                                        <input type="hidden" name="action" id="action" />
                                        <input type="hidden" name="id" id="id"/>
                                        <input type="hidden" name="publish" id="publish"/>
                                    </form>

                                </div>
                                <!-- end widget content -->
            
                            </div>
                            <!-- end widget div -->
            
                        </div>
                        <!-- end widget -->
            
                    </article>
                    <!-- WIDGET END -->
                </div>


                <div class="row">
                    <!-- NEW WIDGET START -->
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
                            
                            <header class="bg-color-teal txt-color-white no-border box-hedaer">
                                <h2>Scheduling Listing </h2>
                            </header>
            
                            <!-- widget div-->
                            <div>
            
                                <!-- widget content -->
                                <div class="widget-body no-padding">
                                    
                                    <!-- <div class="text-right padding-10">
                                        <a href="<?php echo base_url().MEMBERPATH;?>job/add" class="btn btn-primary btn-sm">
                                            Add New Request
                                        </a>
                                    </div> -->

                                    <form name="datatableForm1" id="datatableForm1" action="<?=base_url().MEMBERPATH;?>job" method="post" enctype="multipart/form-data">
                                        <table id="dt_basic1" class="table table-striped" width="100%">
                                            <thead>
                                                <tr>
                                                    <th data-hide="phone"> #</th>
                                                    <th data-class="expand"> Location</th>
                                                    <th data-hide="phone"> Vehicle</th>
                                                    <th data-hide="phone"> Notification Preference</th>
                                                    <th data-hide="phone"> Service Provider</th>
                                                    <th data-hide="phone,tablet"> Status</th>
                                                    <th> Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $cnt1 = 1; foreach($manage_data_2 as $data){ ?>
                                                    <tr>
                                                        <td><?php echo $cnt1; ?></td>
                                                        <td><?php echo $data['location']; ?></td>
                                                        <td><?php echo $data['name']; ?></td>
                                                        <td><?php echo $data['notification_preference']; ?></td>
                                                        <td>
                                                            <?php if($data['sp_id'] == 0){ ?>
                                                                NOT ASSIGN
                                                            <?php }else{ ?>
                                                                <?php echo $data['company_name']; ?>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if($data['status'] == '1'){ ?>
                                                                <a class="btn btn-warning btn-xs"><?php echo $data['status_txt']; ?></a>
                                                            <?php }else if($data['status'] == '2'){ ?>
                                                                <a class="btn btn-primary btn-xs"><?php echo $data['status_txt']; ?></a>
                                                            <?php }else if($data['status'] == '3'){ ?>
                                                                <a class="btn btn-info btn-xs"><?php echo $data['status_txt']; ?></a>
                                                            <?php }else if($data['status'] == '4'){ ?>
                                                                <a class="btn bg-color-redLight btn-xs txt-color-white"><?php echo $data['status_txt']; ?></a>
                                                            <?php }else if($data['status'] == '5'){ ?>
                                                                <a class="btn btn-success btn-xs"><?php echo $data['status_txt']; ?></a>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url().MEMBERPATH."job/view/".$data['job_request_id']; ?>" class="btn btn-info btn-sm">View</a>
                                                            <a href="<?php echo base_url().MEMBERPATH."job/track/".$data['job_request_id']; ?>" class="btn btn-info btn-sm">Track</a>
                                                            <?php //if($data['status'] == 'Pending'){ ?>
                                                                <!-- <a href="<?php echo base_url().MEMBERPATH;?>job/edit/<?php echo $data['job_id']; ?>" class="btn btn-info btn-sm">Edit</a> -->
                                                                <!-- <button type="button" class="btn btn-danger btn-sm" id="delete_<?php echo $data['service_id']; ?>" onClick="javascript: confirmDelete('datatableForm','<?php echo $data['service_id']; ?>')" >Delete</button> -->
                                                            <?php //} ?>
                                                        </td>
                                                    </tr>
                                                <?php $cnt1++; } ?>
                                            </tbody>
                                        </table>

                                        <input type="hidden" name="action" id="action" />
                                        <input type="hidden" name="id" id="id"/>
                                        <input type="hidden" name="publish" id="publish"/>
                                    </form>

                                </div>
                                <!-- end widget content -->
            
                            </div>
                            <!-- end widget div -->
            
                        </div>
                        <!-- end widget -->
            
                    </article>
                    <!-- WIDGET END -->
            
                </div>

            
            </section>
            <!-- end widget grid -->


		</div>
		<!-- END MAIN CONTENT -->

	</div>
	<!-- END MAIN PANEL -->

	<?php $this->load->view(MEMBERPATH . 'footer'); ?>

	<!--================================================== -->

	<?php $this->load->view(MEMBERPATH . 'common_js'); ?>

	<script type="text/javascript">
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		$(document).ready(function() {
			pageSetUp();

			/* BASIC ;*/
            var responsiveHelper_dt_basic = undefined;
            // var responsiveHelper_datatable_fixed_column = undefined;
            // var responsiveHelper_datatable_col_reorder = undefined;
            // var responsiveHelper_datatable_tabletools = undefined;
            
            var breakpointDefinition = {
                tablet : 1024,
                phone : 480
            };

            $('#dt_basic').dataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
                    "t"+
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth" : true,
                "oLanguage": {
                    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                },
                "preDrawCallback" : function() {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_dt_basic) {
                        responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
                    }
                },
                "rowCallback" : function(nRow) {
                    responsiveHelper_dt_basic.createExpandIcon(nRow);
                },
                "drawCallback" : function(oSettings) {
                    responsiveHelper_dt_basic.respond();
                },
                'columnDefs': [ {
                    'targets': [4], /* column index */
                    'orderable': false,
                    'searchable': false, /* true or false */
                }]
            });


            var responsiveHelper_dt_basic1 = undefined;
            $('#dt_basic1').dataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
                    "t"+
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth" : true,
                "oLanguage": {
                    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                },
                "preDrawCallback" : function() {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_dt_basic1) {
                        responsiveHelper_dt_basic1 = new ResponsiveDatatablesHelper($('#dt_basic1'), breakpointDefinition);
                    }
                },
                "rowCallback" : function(nRow) {
                    responsiveHelper_dt_basic1.createExpandIcon(nRow);
                },
                "drawCallback" : function(oSettings) {
                    responsiveHelper_dt_basic1.respond();
                },
                'columnDefs': [ {
                    'targets': [4], /* column index */
                    'orderable': false,
                    'searchable': false, /* true or false */
                }]
            });

			/* END BASIC */
		})

        function confirmDelete(frm, id)
        {
            var agree=confirm("Are you sure to delete this service?");
            if (agree)
            {
                $("#id").val(id);
                $("#action").val("delete");
                $("#"+frm).submit();
            }
        }

        function changePublishStatus(frm, id, status)
        {
            var agree=confirm("Are you sure to change status?");
            if (agree)
            {
                $("#id").val(id);
                $("#action").val("change_publish");
                $("#publish").val(status);
                $("#"+frm).submit();
            }
        }
	</script>

</body>

</html>

