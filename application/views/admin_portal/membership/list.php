
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

                            <header class="bg-color-teal txt-color-white no-border box-hedaer">
                                <!-- <span class="widget-icon"> <i class="fa fa-table"></i> </span> -->
                                <h2>Membership Listing </h2>
                            </header>
            
                            <!-- widget div-->
                            <div>
                                <div class="widget-body no-padding">
                                    
                                    <div class="text-right padding-10">
                                        <a href="<?php echo base_url().ADMINPATH;?>membership/add" class="btn btn-primary btn-sm">
                                            Add New <?php echo $title; ?>
                                        </a>
                                    </div>

                                    <form name="datatableForm" id="datatableForm" action="<?=base_url().ADMINPATH;?>membership" method="post" enctype="multipart/form-data">
                                        <table id="dt_basic" class="table table-striped" width="100%">
                                            <thead>			                
                                                <tr>
                                                    <th data-hide="phone"> ID</th>
                                                    <th data-class="expand"> Name</th>
                                                    <th data-hide="phone"> Price</th>
                                                    <th> Validity</th>
                                                    <th data-hide="phone,tablet"> Status</th>
                                                    <th> Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($manage_data as $data){ ?>
                                                    <tr>
                                                        <td><?php echo $data['package_id']; ?></td>
                                                        <td><?php echo $data['package_name']; ?></td>
                                                        <td><?php echo '$ '.$data['package_amount']; ?></td>
                                                        <td><?php echo $data['text']; ?></td>
                                                        <td><?php echo $data['status']; ?></td>
                                                        <td>
                                                            <a href="<?php echo base_url().ADMINPATH;?>membership/edit/<?php echo $data['package_id']; ?>" class="btn btn-sm bg-color-teal txt-color-white">Edit</a>
                                                            <button type="button" class="btn btn-danger btn-sm" id="delete_<?php echo $data['package_id']; ?>" onClick="javascript: confirmDelete('datatableForm','<?php echo $data['package_id']; ?>')" >Delete</button>
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

	<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
		Note: These tiles are completely responsive,
		you can add as many as you like
		-->
	<div id="shortcut">
		<ul>
			<li>
				<a href="inbox.html" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-envelope fa-4x"></i> <span>Mail <span class="label pull-right bg-color-darken">14</span></span> </span> </a>
			</li>
			<li>
				<a href="calendar.html" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Calendar</span> </span> </a>
			</li>
			<li>
				<a href="gmap-xml.html" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i class="fa fa-map-marker fa-4x"></i> <span>Maps</span> </span> </a>
			</li>
			<li>
				<a href="invoice.html" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-book fa-4x"></i> <span>Invoice <span class="label pull-right bg-color-darken">99</span></span> </span> </a>
			</li>
			<li>
				<a href="gallery.html" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-picture-o fa-4x"></i> <span>Gallery </span> </span> </a>
			</li>
			<li>
				<a href="profile.html" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
			</li>
		</ul>
	</div>
	<!-- END SHORTCUT AREA -->

	<!--================================================== -->

	<?php $this->load->view(ADMINPATH . 'common_js'); ?>

	<script type="text/javascript">
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		$(document).ready(function() {
			
			pageSetUp();
			
			/* // DOM Position key index //
		
			l - Length changing (dropdown)
			f - Filtering input (search)
			t - The Table! (datatable)
			i - Information (records)
			p - Pagination (paging)
			r - pRocessing 
			< and > - div elements
			<"#id" and > - div with an id
			<"class" and > - div with a class
			<"#id.class" and > - div with an id and class
			
			Also see: http://legacy.datatables.net/usage/features
			*/	
	
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
                    'targets': [5], /* column index */
                    'orderable': false,
                    'searchable': false, /* true or false */
                }]
            });

            

			/* END BASIC */
		})

        function confirmDelete(frm, id)
        {
            var agree=confirm("Are you sure to delete this membership?");
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

