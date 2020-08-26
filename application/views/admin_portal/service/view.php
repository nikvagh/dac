<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('admin/common'); ?>
        <title><?php echo $this->system->company_name;?> | <?php echo $title;?></title>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php $this->load->view('admin/header'); ?>
            <?php $this->load->view('admin/sidebar'); ?>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1><?php echo $title;?></h1>
                </section>
                <?php if ($this->session->flashdata('notification')) { ?>
                        <div class="alert alert-success">
                            <button class="close" data-close="alert"></button>
                            <span><?php echo $this->session->flashdata('notification'); ?></span>
                        </div>
                <?php } ?>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-info">
                                <div class="box-header with-border" style="text-align: center;">
                                    <h3 class="box-title"><?php if($action=="INSERT"){?>REGISTRATION<?php }else{?>EDIT<?php }?></h3>
                                </div>
                                <form name="regform" id="regform" action="<?php if($action=="INSERT"){ echo base_url(); ?>admin/category/insert <?php }else{ echo base_url(); ?>admin/category/edit<?php } ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="box-body">
                                        <div class="col-md-offset-2 col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon ad">CATEGORY NAME</span>
                                                <input type="text" name="categoryname" id="categoryname" value="<?php if(isset($old_data)){ echo $old_data['category_name']; }?>" class="form-control"/>
                                                <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                                            </div>
                                            <label for="categoryname" class="error"></label><br/>
                                            
                                            <div class="input-group">
                                                <span class="input-group-addon ad">DESCRIPTION</span>
                                                <textarea name="description" id="description" class="form-control"><?php if(isset($old_data)){ echo $old_data['category_description']; }?></textarea>
                                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                            </div>  
                                            <label for="description" class="error"></label><br/>
                                            
                                            <?php if(isset($old_data)){?>
                                                <input type="hidden" name="categoryid" value="<?php echo $old_data['category_id'];?>"/>
                                            <?php }?>
                                                
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-2">
                                                    <input type="submit" name="submit" class="form-control btn-sm btn-info" value="<?php if($action=='INSERT'){?>INSERT<?php } else {?>UPDATE<?php } ?>" onclick=""/>
                                                </div>   
                                                <div class="col-sm-2">
                                                    <input type="button" name="cancel" class="form-control btn-sm btn-default" value="CANCEL" onclick=""/>
                                                </div>   
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <?php $this->load->view('admin/footer'); ?>
            <?php $this->load->view('admin/common_js'); ?>
        </div>
         <?php $this->load->view('admin/category_validation'); ?>
    </body>
</html>
