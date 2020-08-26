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
                    <br/>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger fade in">
                        <button class="close" data-dismiss="alert">×</button>
                        <i class="fa-fw fa fa-times"></i>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('success');?>
                    </div>
                    <br/>
                <?php endif; ?>


                    <div class="row">
                        <!-- <div class="col-sm-12"> -->

                        <!-- <div class="col-sm-12 col-md-12 col-lg-12">
                            <h2 class="box-header-single txt-color-white bg-color-teal">Service Request </h2>
                        </div> -->
                        <?php 
                            // echo "<pre>";
                            // print_r($form_data);
                        ?>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
                        
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">Track Service </h5>
                                        </div>
                                        <div class="box-body bg-color-white">

                                            <?php 
                                                // echo "<pre>";print_r($status_data);
                                                // echo "</pre>";
                                            ?>

                                            <div class="tree">
                                                <ul>
                                                    <li>
                                                        <span><i class="fa fa-lg fa-calendar"></i> Request Date <?php echo date( 'Y F,d - h:i',strtotime($form_data['request_date']) ); ?></span>
                                                        <ul>

                                                            <?php foreach($status_data as $st_data){ ?>
                                                                <li>
                                                                    <span class="label label-info"><i class="fa fa-lg fa-plus-circle"></i> <?php echo date( 'l, F d - h:i',strtotime($st_data['changed_at']) ); ?></span>
                                                                    <ul>
                                                                        <li>
                                                                            <span><?php echo $st_data['status_txt']; ?></span>  
                                                                            <!-- &ndash; <a href="javascript:void(0);">Changed CSS to accomodate...</a> -->
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            <?php } ?>

                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                
                                        </div>
                                    </div>
                                    <br/>
                                </div>
                                
                            </div>
                        </div>

                    </div>


            </div>
            <!-- END MAIN CONTENT -->

        </div>
        <!-- END MAIN PANEL -->

        <?php $this->load->view(MEMBERPATH . 'footer'); ?>

        <!--================================================== -->
        <?php $this->load->view(MEMBERPATH . 'common_js'); ?>

        <script type="text/javascript">
            // DO NOT REMOVE : GLOBAL FUNCTIONS!

            var errorClass = 'invalid';
            var errorElement = 'em';

            $(document).ready(function() {
                pageSetUp();

                $('.tree > ul').attr('role', 'tree').find('ul').attr('role', 'group');
                $('.tree').find('li:has(ul)').addClass('parent_li').attr('role', 'treeitem').find(' > span').attr('title', 'Collapse this branch').on('click', function(e) {
                    var children = $(this).parent('li.parent_li').find(' > ul > li');
                    if (children.is(':visible')) {
                        children.hide('fast');
                        $(this).attr('title', 'Expand this branch').find(' > i').removeClass().addClass('fa fa-lg fa-plus-circle');
                    } else {
                        children.show('fast');
                        $(this).attr('title', 'Collapse this branch').find(' > i').removeClass().addClass('fa fa-lg fa-minus-circle');
                    }
                    e.stopPropagation();
                });

            });

        </script>

    </body>
</html>