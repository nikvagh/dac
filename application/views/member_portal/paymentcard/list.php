
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
                                <!-- <span class="widget-icon"> <i class="fa fa-table"></i> </span> -->
                                <h2>Service Listing </h2>
                            </header>
            
                            <!-- widget div-->
                            <div>
            
                                <!-- widget content -->
                                <div class="widget-body no-padding">
                                    
                                    <div class="text-right padding-10">
                                        <a href="<?php echo base_url().MEMBERPATH;?>paymentcard/add" class="btn btn-primary btn-sm">
                                            Add Card Deatils
                                        </a>
                                    </div>

                                    <form name="datatableForm" id="datatableForm" action="<?=base_url().MEMBERPATH;?>paymentcard" method="post" enctype="multipart/form-data">
                                        <table id="dt_basic" class="table table-striped" width="100%">
                                            <thead>			                
                                                <tr>
                                                    <th data-hide="phone"> ID</th>
                                                    <th data-class="expand"> Name on Card</th>
                                                    <th data-hide="phone"> Number</th>
                                                    <th data-hide="phone"> Expiry</th>
                                                    <th data-hide="phone"> CVV</th>
                                                    <!-- <th data-hide="phone,tablet"> Status</th> -->
                                                    <th> Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($manage_data as $data){ ?>
                                                    <tr>
                                                        <td><?php echo $data['id']; ?></td>
                                                        <td><?php echo $data['name']; ?></td>
                                                        <td><?php echo $data['number']; ?></td>
                                                        <td><?php echo $data['expiry_month'].'/'.$data['expiry_year']; ?></td>
                                                        <td><?php echo $data['cvv']; ?></td>
                                                        <td>
                                                            <a href="<?php echo base_url().MEMBERPATH;?>paymentcard/edit/<?php echo $data['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                                            <button type="button" class="btn btn-danger btn-sm" id="delete_<?php echo $data['id']; ?>" onClick="javascript: confirmDelete('datatableForm','<?php echo $data['id']; ?>')" >Delete</button>
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

