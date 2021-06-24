<style>
    .pull-right{
        float: right;
    }
    .clearfix{
        clear:both;
    }
    .table{
        width: 100%;
        border-collapse: collapse;
    }
    table tr td,table tr th{
        border: 1px solid gray;
    }
    .text-center{
        text-align: center;
    }
    .text-right{
        text-align: right;
    }
    .bg-platinum{
        background: #E5E4E2;
    }
</style>

<div class="padding-10">

    <div class="">
        <img src="<?php echo $this->assets; ?>img/logo.png" width="100" alt="invoice icon">
        <br /><br>
        <address>
            <strong><?php echo $this->system->company_name; ?></strong>
            <br />
            <?php echo $this->system->company_address; ?>
        </address>
    </div>
    <div class="clearfix"></div>

    <div class="pull-right text-right">
        <h4>Invoice Number # <?php echo $form_data->invoice_number; ?> <br/> Date: <?php echo date('d M, Y', strtotime($form_data->created_at)); ?></h4>
        <p>
            <strong><?php echo $form_data->firstname . ' ' . $form_data->lastname; ?></strong> <br />
            <?php echo $form_data->location;?> <br />
            <?php echo $form_data->zipcode;?>
        </p>
    </div>
    <div class="clearfix"></div>

    <table class="table table-hover" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>SERVICES LIST</th>
                <th>SUBTOTAL</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($form_data->services)) { ?>
                <tr>
                    <td class="bg-platinum"></td>
                    <td class="text-center bg-platinum">Services</td>
                    <td class="bg-platinum"></td>
                </tr>
                <?php $cnt1 = 1;
                foreach ($form_data->services as $key=>$val) { ?>
                    <tr>
                        <td class="text-center"><strong><?php echo $cnt1; ?></strong></td>
                        <td><a><?php echo $val->name; ?></a></td>
                        <td>&nbsp;<?php echo ' $ '.$val->amount; ?></td>
                    </tr>
                <?php $cnt1++; } ?>
            <?php } ?>

            <?php if (!empty($form_data->addons)) { ?>
                <tr>
                    <td class="bg-platinum"></td>
                    <td class="text-center bg-platinum">Addons</td>
                    <td class="bg-platinum"></td>
                </tr>
                <?php
                foreach ($form_data->addons as $key=>$val) { ?>
                    <tr>
                        <td class="text-center"><strong><?php echo $cnt1; ?></strong></td>
                        <td><a><?php echo $val->name; ?></a></td>
                        <td>&nbsp;<?php echo ' $ '.$val->amount; ?></td>
                    </tr>
                <?php $cnt1++; } ?>
            <?php } ?>
            
            <?php //if($form_data['fee'] > 0){ ?> 
                <!-- <tr>
                    <td colspan="2" class="text-right">Additional Fee</td>
                    <td><strong><?php //echo '$'.$form_data->fee; ?></strong></td>
                </tr> -->
            <?php //} ?>

            <tr>
                <td colspan="2" class="text-right">Total &nbsp;</td>
                <td>&nbsp;<?php echo ' $ ' . $form_data->amount; ?></td>
            </tr>

            <tr>
                <td colspan="2" class="text-right">Total Payable </td>
                <td>&nbsp;<?php echo ' $ '.$form_data->total_payable; ?></td>
            </tr>
            
            <!-- <tr>
                    <td colspan="2" class="text-right">HST/GST</td>
                    <td><strong>13%</strong></td>
                </tr> -->
        </tbody>
    </table>

</div>
