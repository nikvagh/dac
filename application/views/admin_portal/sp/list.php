
<!DOCTYPE html>
<html lang="en-us">

<head>
	<?php $this->load->view(ADMINPATH . 'head'); ?>
	<?php $this->load->view(ADMINPATH . 'common_css'); ?>
</head>

<body class="smart-style-1">

	<?php $this->load->view(ADMINPATH . 'header'); ?>

	<!-- #NAVIGATION -->
	<!-- Left panel : Navigation area -->
	<!-- Note: This width of the aside area can be adjusted through LESS variables -->
	<?php $this->load->view(ADMINPATH . 'sidebar'); ?>
	<!-- END NAVIGATION -->

	<!-- MAIN PANEL -->
	<div id="main" role="main">

		<?php $this->load->view(ADMINPATH . 'breadcrumb'); ?>

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
                                <h2>Service Provider Listing </h2>
                            </header>
            
                            <!-- widget div-->
                            <div>
            
                                <!-- widget content -->
                                <div class="widget-body no-padding">
                                    
                                    <div class="text-right padding-10">
                                        <a href="<?php echo base_url().ADMINPATH;?>serviceprovider/add" class="btn btn-primary btn-sm">
                                            Add New <?php echo $title; ?>
                                        </a>
                                    </div>

                                    <form name="datatableForm" id="datatableForm" action="<?=base_url().ADMINPATH;?>serviceprovider" method="post" enctype="multipart/form-data">
                                        <table id="dt_basic" class="table table-striped" width="100%">
                                            <thead>			                
                                                <tr>
                                                    <th data-hide="phone"> ID</th>
                                                    <th data-class="expand"> Name</th>
                                                    <th data-hide="phone"> Email</th>
                                                    <th data-hide="phone"> Phone</th>
                                                    <th data-hide="phone"> Owner</th>
                                                    <th data-hide="phone,tablet"> Status</th>
                                                    <th> Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($manage_data as $data){ ?>
                                                    <tr>
                                                        <td><?php echo $data['sp_id']; ?></td>
                                                        <td><?php echo $data['company_name']; ?></td>
                                                        <td><?php echo $data['email']; ?></td>
                                                        <td><?php echo $data['phone_day']; ?></td>
                                                        <td><?php echo $data['owner_first_name'].' '.$data['owner_last_name']; ?></td>

                                                        <td>
                                                            <?php if($data['status'] == "Enable"){ ?>
                                                                <span class="label label-success"><?php echo $data['status']; ?></span>
                                                            <?php }else if($data['status'] == "Disable"){ ?>
                                                                <span class="label label-default"><?php echo $data['status']; ?></span>
                                                            <?php } ?>
                                                        </td>

                                                        <td>
                                                            <a href="<?php echo base_url().ADMINPATH;?>serviceprovider/edit/<?php echo $data['sp_id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                                            <a href="<?php echo base_url().ADMINPATH;?>serviceprovider/view/<?php echo $data['sp_id']; ?>" class="btn btn-primary btn-sm">View</a>
                                                            <!-- <a href="<?php echo base_url().ADMINPATH;?>serviceprovider/document/<?php echo $data['sp_id']; ?>" class="btn btn-primary btn-sm">Documents</a> -->
                                                            <button type="button" class="btn btn-danger btn-sm" id="delete_<?php echo $data['sp_id']; ?>" onClick="javascript: confirmDelete('datatableForm','<?php echo $data['sp_id']; ?>')" >Delete</button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
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

	<?php $this->load->view(ADMINPATH . 'footer'); ?>

	<!--================================================== -->

	<?php $this->load->view(ADMINPATH . 'common_js'); ?>

	<script type="text/javascript">
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		$(document).ready(function() {
			
			pageSetUp();

			/* BASIC ;*/
            var responsiveHelper_dt_basic = undefined;
            
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
                'columnDefs': [{
                    'targets': [5], /* column index */
                    'orderable': false,
                    'searchable': false, /* true or false */
                }],
                "order": [[ 0, "desc" ]]
            });
			/* END BASIC */
		})

        function confirmDelete(frm, id)
        {
            var agree=confirm("Are you sure to delete this service provider ?");
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

