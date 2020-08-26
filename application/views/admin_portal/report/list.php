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

            <?php if ($this->session->flashdata('success')) : ?>
                <div class="alert alert-success fade in">
                    <button class="close" data-dismiss="alert">×</button>
                    <i class="fa-fw fa fa-check"></i>
                    <strong>Success</strong> <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')) : ?>
                <div class="alert alert-danger fade in">
                    <button class="close" data-dismiss="alert">×</button>
                    <i class="fa-fw fa fa-times"></i>
                    <strong>Error!</strong> <?php echo $this->session->flashdata('success'); ?>
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
                                <h2>Reporting </h2>
                            </header>

                            <!-- widget div-->
                            <div>

                                <!-- widget content -->
                                <div class="widget-body no-padding">
                                    <br/>
                                    <div class="col-md-12">
                                        <!-- <form action="<?php echo base_url().ADMINPATH.'report/filter'; ?>" method="post">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Start Date</label>
                                                    <input type="text" name="filter_date_start" id="filter_date_start" class="form-control" autocomplete="off" value="<?php if(isset($_SESSION['report']['filter_date_start']) ){ echo $_SESSION['report']['filter_date_start']; } ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>End Date</label>
                                                    <input type="text" name="filter_date_end" id="filter_date_end" class="form-control" autocomplete="off" value="<?php if(isset($_SESSION['report']['filter_date_end']) ){ echo $_SESSION['report']['filter_date_end']; } ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>&nbsp;</label><br/>
                                                    <input type="submit" name="submit" value="Apply" class="btn btn-primary" />
                                                    <input type="submit" name="submit" value="Reset" class="btn btn-primary" />
                                                </div>
                                            </div>
                                        </form> -->
                                    </div>

                                    <div class="container-fluid">
                                        <div class="col-md-12">
                                            <a href="<?php echo base_url().ADMINPATH.'report/membership'; ?>" class="btn btn-primary">Membership Report</a>
                                            <a href="<?php echo base_url().ADMINPATH.'report/service'; ?>" class="btn btn-primary">Service Report</a>
                                            <a href="<?php echo base_url().ADMINPATH.'report/service_payment'; ?>" class="btn btn-primary">Payment Report</a>
                                        </div>
                                    </div>

                                    <br/><br/>
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

            // $('#start_date').datepicker({
            //     dateFormat: 'yy-mm-dd',
            //     prevText: '<i class="fa fa-chevron-left"></i>',
            //     nextText: '<i class="fa fa-chevron-right"></i>',
            //     // maxDate: 0,
            //     changeMonth: true, 
            //     changeYear: true,
            // });
            
            // $("#start_date").datepicker({
            //     dateFormat: "yy-mm-dd",
            //     // minDate: 0,
            //     onSelect: function () {
            //         var dt2 = $('#end_date');
            //         var startDate = $(this).datepicker('getDate');
            //         //add 30 days to selected date
            //         var minDate = $(this).datepicker('getDate');
            //         var dt2Date = dt2.datepicker('getDate');

            //         //sets dt2 maxDate to the last day of 30 days window
            //         // dt2.datepicker('option', 'maxDate', startDate);
            //         //first day which can be selected in dt2 is selected date in dt1
            //         dt2.datepicker('option', 'minDate', startDate);
            //         // dt2.datepicker('option', 'setDate', startDate);
            //     }
            // });

            // $('#end_date').datepicker({
            //     dateFormat: "yy-mm-dd",
            //     prevText: '<i class="fa fa-chevron-left"></i>',
            //     nextText: '<i class="fa fa-chevron-right"></i>',
            //     // minDate: 0
            //     changeMonth: true, 
            //     changeYear: true,
            // });


            $("#filter_date_start").datepicker({
                dateFormat: 'yy-mm-dd',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                changeMonth: true, 
                changeYear: true,
                // minDate: 0,
                onSelect: function (date) {
                    var dt2 = $('#filter_date_end');
                    var startDate = $(this).datepicker('getDate');
                    var minDate = $(this).datepicker('getDate');
                    dt2.datepicker('setDate', minDate);
                    // startDate.setDate(startDate.getDate() + 30);
                    //sets dt2 maxDate to the last day of 30 days window
                    // dt2.datepicker('option', 'maxDate', startDate);
                    dt2.datepicker('option', 'minDate', minDate);
                    // $(this).datepicker('option', 'minDate', minDate);
                },
            });

            $('#filter_date_end').datepicker({
                dateFormat: 'yy-mm-dd',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                changeMonth: true, 
                changeYear: true
            });


            /* BASIC ;*/
            var responsiveHelper_dt_basic = undefined;

            var breakpointDefinition = {
                tablet: 1024,
                phone: 480
            };

            $('#dt_basic').dataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth": true,
                "oLanguage": {
                    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                },
                "preDrawCallback": function() {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_dt_basic) {
                        responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
                    }
                },
                "rowCallback": function(nRow) {
                    responsiveHelper_dt_basic.createExpandIcon(nRow);
                },
                "drawCallback": function(oSettings) {
                    responsiveHelper_dt_basic.respond();
                },
                'columnDefs': [{
                    'targets': [5],
                    /* column index */
                    'orderable': false,
                    'searchable': false,
                    /* true or false */
                }],
                "order": [
                    [0, "desc"]
                ]
            });
            /* END BASIC */
        })

        function confirmDelete(frm, id) {
            var agree = confirm("Are you sure to delete this service provider ?");
            if (agree) {
                $("#id").val(id);
                $("#action").val("delete");
                $("#" + frm).submit();
            }
        }

        function changePublishStatus(frm, id, status) {
            var agree = confirm("Are you sure to change status?");
            if (agree) {
                $("#id").val(id);
                $("#action").val("change_publish");
                $("#publish").val(status);
                $("#" + frm).submit();
            }
        }
    </script>

</body>

</html>