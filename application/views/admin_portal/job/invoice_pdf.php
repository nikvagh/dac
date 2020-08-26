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
</style>

<div class="padding-10">

    <div class="pull-right text-right">
        <img src="<?php echo $this->assets; ?>img/logo.png" width="100" alt="invoice icon">
        <br /><br>
        <address>
            <strong><?php echo $this->system->company_name; ?></strong>
            <br />
            <?php echo $this->system->company_address; ?>
        </address>
        <?php $invoice_number = sprintf("%05d", $form_data['job_request_id']); ?>
        <h4>Invoice Number #<?php echo $invoice_number; ?></h4>
        <h4 class="">Date: <?php echo date('d M, Y', strtotime($form_data['created_at'])); ?></h4>
    </div>
    <div class="clearfix"></div>

    <div class="pull-left">
        <!-- <address> -->
        <h3>To, <?php echo $form_data['firstname'] . ' ' . $form_data['lastname']; ?></h3>
        <br />
        <?php //echo $this->system->company_address; 
        ?>
        <!-- </address> -->
    </div>
    <div class="clearfix"></div>

    <table class="table table-hover" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>SERVICE LIST</th>
                <th>SUBTOTAL</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($services)) { ?>
                <tr>
                    <td colspan="3" class="text-center">Services</td>
                </tr>
                <?php $cnt1 = 1;
                $total = 0;
                foreach ($services as $val) { ?>
                    <tr>
                        <td class="text-center"><strong><?php echo $cnt1; ?></strong></td>
                        <td><a><?php echo $val['title']; ?></a></td>
                        <td>
                            <?php
                            // $total += $val['amount'];
                            echo '$0';
                            ?>
                        </td>
                    </tr>
                <?php $cnt1++;
                } ?>
            <?php } ?>

            <?php if (!empty($featured_services)) { ?>
                <tr>
                    <td colspan="3" class="text-center">Featured Services</td>
                </tr>
                <?php $total = 0;
                foreach ($featured_services as $val) { ?>
                    <tr>
                        <td class="text-center"><strong><?php echo $cnt1; ?></strong></td>
                        <td><a><?php echo $val['title']; ?></a></td>
                        <td>
                            <?php
                            $total += $val['amount'];
                            echo '$' . $val['amount'];
                            ?>
                        </td>
                    </tr>
                <?php $cnt1++;
                } ?>
            <?php }  ?>
            
            <?php //if($form_data['fee'] > 0){ ?> 
                <tr>
                    <td colspan="2" class="text-right">Additional Fee</td>
                    <td><strong><?php echo '$'.$form_data['fee']; ?></strong></td>
                </tr>
            <?php //} ?>

            <tr>
                <td colspan="2" class="text-right">Total</td>
                <td><strong><?php echo '$'.$form_data['payeble_amount']; ?></strong></td>
            </tr>

            <tr>
                <td colspan="2" class="text-right">Total</td>
                <td><strong><?php echo '$' . $total; ?></strong></td>
            </tr>
            <!-- <tr>
                        <td colspan="2" class="text-right">HST/GST</td>
                        <td><strong>13%</strong></td>
                    </tr> -->
        </tbody>
    </table>

</div>
