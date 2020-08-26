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
                    <br/>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger fade in">
                        <button class="close" data-dismiss="alert">×</button>
                        <i class="fa-fw fa fa-times"></i>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('error');?>
                    </div>
                    <br/>
                <?php endif; ?>

                <div class="row">
                    <!-- <div class="col-sm-12"> -->

                        <article class="col-sm-12 col-md-12 col-lg-6">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">

                                <header class="txt-color-white bg-color-teal">
                                    <!-- <span class="widget-icon"> <i class="fa fa-edit"></i> </span> -->
                                    <h2>Upload New Document </h2>
                                </header>

                                <!-- widget div-->
                                <div>

                                    <!-- widget edit box -->
                                    <div class="jarviswidget-editbox">
                                    </div>
                                    <!-- end widget edit box -->

                                    <!-- widget content -->
                                    <div class="widget-body no-padding">
                                        <?php 
                                        //  echo "<pre>";
                                        //  print_r($profile);
                                        ?>
                                        <form id="form1" class="smart-form" action="<?php echo base_url().ADMINPATH . 'serviceprovider/document'; ?>" method="post" enctype="multipart/form-data">
                                            <!-- <header>Edit Profile</header> -->

                                            <fieldset>
                                                <section>
                                                    <label class="input">
                                                        <label>Title *</label>
                                                        <input type="text" name="title" placeholder="Title" value="">
                                                    </label>
                                                </section>

                                                <section class="">
                                                    <label class="textarea">
                                                        <label>Discription</label>
                                                        <textarea rows="3" name="discription" placeholder="Discription"></textarea>
                                                    </label>
                                                </section>

                                                <section>
                                                    <label>Document File *</label>
                                                    <div class="input input-file">
                                                        <span class="button">
                                                            <input type="file" id="document" name="document" onchange="this.parentNode.nextSibling.value = this.value">Browse
                                                        </span>
                                                        <input type="text" placeholder="" readonly="">
                                                    </div>
                                                </section>

                                                <div class="note txt-color-teal">
                                                    <strong>Note:</strong>  Please Uploads Only Pdf,Doc and Images.
                                                </div>
                                                <br/>
                                            </fieldset>

                                            <footer>
                                                <input type="hidden" name="id" id="sp_id" value="<?php echo $form_data['sp_id']; ?>"/>
                                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                <a href="<?php echo base_url().ADMINPATH . 'serviceprovider'; ?>" name="cancel" class="btn btn-default">Cancel</a>
                                            </footer>
                                        </form>

                                    </div>
                                    <!-- end widget content -->

                                </div>
                                <!-- end widget div -->

                            </div>
                            <!-- end widget -->

                        </article>

                        <article class="col-sm-12 col-md-12 col-lg-6">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">

                                <header class="txt-color-white bg-color-teal">
                                    <!-- <span class="widget-icon"> <i class="fa fa-edit"></i> </span> -->
                                    <h2>Uploaded Document </h2>
                                </header>

                                <!-- widget div-->
                                <div>

                                    <!-- widget edit box -->
                                    <div class="jarviswidget-editbox">
                                    </div>
                                    <!-- end widget edit box -->

                                    <!-- widget content -->
                                    <div class="widget-body no-padding">
                                        <?php 
                                        //  echo "<pre>";
                                        //  print_r($profile);
                                        ?>
                                        <form id="form1" class="smart-form" action="<?php echo base_url().ADMINPATH . 'serviceprovider/document'; ?>" method="post" enctype="multipart/form-data">
                                            <!-- <header>Edit Profile</header> -->
                                            
                                            <!-- <div class="row text-center"> -->
                                                <fieldset>
                                                    <section>
                                                        <div class="row text-center">
                                                            
                                                            <?php if(!empty($documents)){ ?>

                                                                <?php foreach($documents as $doc){ ?>
                                                                    <?php if(file_exists(SPDOC_PATH.$doc['document'])){ ?>
                                                                        <div class="col-sm-2 padding-10">
                                                                            <a href="<?php echo base_url().SPDOC_PATH.$doc['document']; ?>" target="_blank">
                                                                                <i class="fa fa-file fa-2x"></i>
                                                                                <br/>
                                                                                View
                                                                            </a>
                                                                            <br/>
                                                                            <label>
                                                                                <input type="checkbox" name="document[]" value="<?php echo $doc['sp_document_id']; ?>"/>
                                                                                <?php echo $doc['title']; ?>
                                                                            </label>
                                                                        </div>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </div>

                                                            <div class="note txt-color-teal">
                                                                <strong>Note:</strong>  Check and save to Delete.
                                                            </div>
                                                            <br/>

                                                        <?php }else{ ?>
                                                            Not Found Any Documents
                                                        <?php } ?>

                                                    </section>
                                                </fieldset>
                                            <!-- </div> -->
                                            
                                            <?php if(!empty($documents)){ ?>
                                                <footer>
                                                    <input type="hidden" name="id" id="sp_id" value="<?php echo $form_data['sp_id']; ?>"/>
                                                    <button type="submit" name="delete" class="btn btn-primary">Save</button>
                                                    <!-- <a href="<?php //echo base_url().ADMINPATH . 'serviceprovider'; ?>" name="cancel" class="btn btn-default">Cancel</a> -->
                                                </footer>
                                            <?php } ?>
                                        </form>

                                    </div>
                                    <!-- end widget content -->

                                </div>
                                <!-- end widget div -->

                            </div>
                            <!-- end widget -->

                        </article>

                    <!-- </div> -->
                </div>


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
            })

            var errorClass = 'invalid';
            var errorElement = 'em';

            $("#form1").validate({
                errorClass: errorClass,
                errorElement: errorElement,
                highlight: function(element) {
                    if($(element).attr('id') == "document"){
                        $(element).parent().parent().removeClass('state-success').addClass("state-error");
                        $(element).removeClass('valid');
                    }else{
                        $(element).parent().removeClass('state-success').addClass("state-error");
                        $(element).removeClass('valid');
                    }
                },
                unhighlight: function(element) {
                    if($(element).attr('id') == "document"){
                        $(element).parent().parent().removeClass("state-error").addClass('state-success');
                        $(element).addClass('valid');
                    }else{
                        $(element).parent().removeClass("state-error").addClass('state-success');
                        $(element).addClass('valid');
                    }
                },

                // Rules for form validation
                rules: {
                    title: {
                        required: true,
                    },
                    document:{
                        required: true,
                    }
                },

                // Messages for form validation
                messages: {
                },

                // Do not change code below
                errorPlacement: function(error, element) {
                    // console.log(element.attr('id'));
                    if(element.attr('id') == "document"){
                        error.insertAfter(element.parent().parent());
                    }else{
                        error.insertAfter(element.parent());
                    }
                }
            });
        </script>

    </body>
</html>