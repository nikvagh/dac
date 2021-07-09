<?php if(!empty($card_list)){ ?>

<div class="row">
    <ul class="card_ul">
        <h5 class="">Saved cards</h5>
        <?php $cnt=1; foreach($card_list as $key => $val) { ?>
            <?php 
                $wrapper = false; if(($key)%3 == 0){ $wrapper = true; }
                $cnt++;
            ?>

            <?php if($wrapper){ $cnt = 1; ?> <div class="row flex-row"> <?php } ?>
            <?php 
                $number_length = strlen($val->number);
            ?>
                <div class="col-sm-4 card_box">
                    <div>
                        <div class="md-box md-details"> <?php echo $val->name.' <br/> '.str_repeat('*', $number_length - 4).substr($val->number, $number_length - 4, 4).' <br/> Expiry - '.$val->expiry_month.'/'.$val->expiry_year.' <br/> CVV - '.str_repeat("*", strlen($val->cvv)); ?> </div>
                        <div class="md-box"> 
                            <a class="btn1 btn-block btn-default text-center p-10">
                                <label>Click To Copy <input type="radio" name="payment_card" value="<?php echo $val->id; ?>"/> </label>
                                <!-- <i class="fa fa-edit"> </i> -->
                            </a>
                            <!-- <a class="btn1 btn-block btn-primary text-center mt-0" onClick="confirmDelete('<?php //echo $val->id; ?>','card')">
                                <i class="fa fa-trash"> </i>
                            </a>  -->
                        </div>
                    </div>
                </div>
            <?php if($cnt == 3){ ?> </div> <?php } ?>
        <?php } ?>
    </ul>
</div>

<?php }else{
		$this->load->view(FRONT.'no_data_found',['message'=>'Not any saved cards']);
	}
?>
<br/>
<div class="row">
    <ul class="card_ul">
        <div class="col-md-12">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table">
                    <div class="row1 display-tr">
                        <h3 class="panel-title display-td">Payment Details</h3>
                        <!-- <div class="display-td">
                            <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                        </div> -->
                    </div>
                </div>
                <div class="panel-body">

                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p><?php echo $this->session->flashdata('success'); ?></p>
                        </div>
                    <?php } ?>

                    <form role="form" action="<?php echo $action; ?>" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?php echo $this->config->item('stripe_key') ?>" id="payment-form">

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Name on Card</label> <input class='form-control card_name' size='4' type='text'>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Card Number</label> <input autocomplete='off' class='form-control card-number card_number' size='20' type='text'>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label> <input autocomplete='off' class='form-control card-cvc card_cvv' placeholder='ex. 311' size='4' type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> <input class='form-control card-expiry-month card_month' placeholder='MM' size='2' type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> <input class='form-control card-expiry-year card_year' placeholder='YYYY' size='4' type='text'>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>Please correct the errors and try again.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now ($<?php echo $amount; ?>)</button>
                            </div>
                        </div>

                        <p class="text-center m-0">Please don't refresh or back page after click on pay now</p>

                    </form>
                </div>
            </div>
        </div>
    </ul>
</div>


<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    $(function() {
        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
            $errorMessage.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }

        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error').removeClass('hide').find('.alert').text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
                // console.log('111');
                // return false;
            }
        }
    });
</script>