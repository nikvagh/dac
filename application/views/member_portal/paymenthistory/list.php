
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

                            <header class="txt-color-white bg-color-teal">
                                <!-- <span class="widget-icon"> <i class="fa fa-table"></i> </span> -->
                                <h2>Membership Payment </h2>
                            </header>
            
                            <!-- widget div-->
                            <div>
            
                                <!-- widget content -->
                                <div class="widget-body no-padding">
                                    <form name="datatableForm" id="datatableForm" action="<?=base_url().MEMBERPATH;?>membership" method="post" enctype="multipart/form-data">
                                        <table id="dt_basic" class="table table-striped" width="100%">
                                            <thead>			                
                                                <tr>
                                                    <th data-hide="phone"> #</th>
                                                    <th data-class="expand"> Membership</th>
                                                    <th data-class="expand"> Vehicle Name</th>
                                                    <th data-hide="phone"> Amount</th>
                                                    <th data-hide="phone,tablet"> Date</th>
                                                    <!-- <th> Actions</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $cnt1 = 1; foreach($membership_payment as $data){ ?>
                                                    <tr>
                                                        <td><?php echo $cnt1; ?></td>
                                                        <td><?php echo $data['package_name']; ?></td>
                                                        <td><?php echo $data['vehicle_name']; ?></td>
                                                        <td><?php echo '$ '.$data['amount']; ?></td>
                                                        <td><?php echo $data['created_at']; ?></td>
                                                        <!-- <td>
                                                            <a href="<?php echo base_url().MEMBERPATH;?>membership/edit/<?php echo $data['package_id']; ?>" class="btn btn-primary">View</a>
                                                        </td> -->
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
					

					 <!-- NEW WIDGET START -->
					 <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                            <header class="txt-color-white bg-color-teal">
                                <!-- <span class="widget-icon"> <i class="fa fa-table"></i> </span> -->
                                <h2>Service Payment </h2>
                            </header>
            
                            <!-- widget div-->
                            <div>
            
                                <!-- widget content -->
                                <div class="widget-body no-padding">
                                    <form name="datatableForm" id="datatableForm" action="<?=base_url().MEMBERPATH;?>membership" method="post" enctype="multipart/form-data">
                                        <table id="dt_basic1" class="table table-striped" width="100%">
                                            <thead>			                
                                                <tr>
                                                    <th data-hide="expand"> #</th>
                                                    <!-- <th data-class="phone"> Service Provider</th> -->
                                                    <th data-hide="phone"> Location</th>
                                                    <th data-hide="phone,tablet"> services</th>
                                                    <th data-hide="phone,tablet"> Amount</th>
                                                    <!-- <th data-hide="phone,tablet"> Pay From Membership </th> -->
                                                    <!-- <th data-hide="phone,tablet"> Pay By Bank/Cash </th> -->
                                                    <th data-hide="phone,tablet"> Date </th>
                                                    <!-- <th> Actions</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $cnt1 = 1; foreach($service_payment as $data){ ?>
                                                    <tr>
                                                        <td><?php echo $cnt1; ?></td>
                                                        <!-- <td><?php echo $data['company_name']; ?></td> -->
                                                        <td><?php echo $data['location']; ?></td>
                                                        <td><?php echo $data['services_took']; ?></td>
                                                        <td><?php echo '$ '.$data['payeble_amount']; ?></td>
                                                        <!-- <td><?php echo '$ '.$data['pay_by_membership']; ?></td> -->
                                                        <!-- <td><?php echo '$ '.$data['pay_by_other']; ?></td> -->
                                                        <td><?php echo $data['created_at']; ?></td>
                                                        <!-- <td>
                                                            <a href="<?php echo base_url().MEMBERPATH;?>membership/edit/<?php echo $data['package_id']; ?>" class="btn btn-primary">View</a>
                                                        </td> -->
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
            
                <!-- end row -->
            
                <!-- end row -->
            
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
			var breakpointDefinition = {
                tablet : 1024,
                phone : 480
            };

            var responsiveHelper_dt_basic = undefined;

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
                // 'columnDefs': [ {
                //     'targets': [5], /* column index */
                //     'orderable': false,
                //     'searchable': false, /* true or false */
                // }]
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
                // 'columnDefs': [ {
                //     'targets': [5], /* column index */
                //     'orderable': false,
                //     'searchable': false, /* true or false */
                // }]
            });
			/* END BASIC */
		})

	</script>

</body>

</html>

