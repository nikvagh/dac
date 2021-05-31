<!-- Core -->
<script src="<?php echo $this->dash_assets; ?>vendor/jquery/dist/jquery.min.js"></script>
<script src="<?php echo $this->dash_assets; ?>vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $this->dash_assets; ?>vendor/js-cookie/js.cookie.js"></script>
<script src="<?php echo $this->dash_assets; ?>vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?php echo $this->dash_assets; ?>vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>

<!-- Optional JS -->
<script src="<?php echo $this->dash_assets; ?>vendor/chart.js/dist/Chart.min.js"></script>
<script src="<?php echo $this->dash_assets; ?>vendor/chart.js/dist/Chart.extension.js"></script>

<!-- Argon JS -->
<script src="<?php echo $this->dash_assets; ?>js/argon.js?v=1.2.0"></script>
<script src="<?php echo $this->dash_assets; ?>js/custom.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>

<?php if(isset($page)){ ?>
    <?php if($page == 'vehicle_list' || $page == 'payment_list' || $page == 'membership_list' || $page == 'booking_list'){ ?>
            <!-- dataTable -->
            <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <?php } ?>

    <?php if($page == ''){ ?>
        <script src="<?php echo $this->dash_assets; ?>custom-plugin/fileStyle/fileStyle.js"></script>
    <?php } ?>

    <?php if($page == 'book_now' || $page == 'book_schedule'){ ?>
        <script src="<?php echo $this->dash_assets; ?>custom-plugin/datetimepicker/build/jquery.datetimepicker.full.js"></script>
    <?php } ?>

    <?php if($page == 'vehicle_add' || $page == 'vehicle_edit' || $page == 'paymentCard_add' || $page == 'paymentCard_edit' || $page == 'membership_add' || 
            $page == 'membership_edit' || $page == 'book_now' || $page == 'book_schedule'){ ?>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <?php } ?>

    <?php if($page == 'calendar_list'){ ?>
        <script src="https://uicdn.toast.com/tui.code-snippet/v1.5.2/tui-code-snippet.min.js"></script>
        <script src="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.min.js"></script>
        <script src="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.min.js"></script>
        <script src="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.js"></script>
    <?php } ?>

    <?php if($page == 'notificationTemplate_list' || $page == 'settings_list'){ ?>
        <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <?php } ?>
<?php } ?>

<script type="text/javascript">
    var base = '<?php echo base_url(MEMBER); ?>';
    <?php if($page == 'login'){ ?>
            $("#login-form").validate({
                // Rules for form validation
                rules : {
                    username : {
                        required : true,
                    },
                    password : {
                        required : true,
                    }
                },
                errorClass: 'error text-danger text-italic',
                // Messages for form validation
                messages : {
                    username : {
                        required : 'Please enter your email',
                    },
                    password : {
                        required : 'Please enter your password'
                    }
                },

                // Do not change code below
                errorPlacement : function(error, element) {
                    element.addClass('text-danger');
                    error.insertAfter(element.parent());
                }
            });
    <?php } ?>

    <?php if(isset($page) && ($page == "vehicle_list" || $page == "payment_list" || $page == "membership_list" || $page == "booking_list")){ ?>
            var dataTable = $(".dataTable").dataTable({
                language: {
                    paginate: {
                        next: '<i class="fa fa-angle-right"></i>',
                        previous: '<i class="fa fa-angle-left"></i>'
                    },
                    emptyTable: "No data available in table"
                },
                "aaSorting": []
            });
    <?php } ?>

    <?php if($page == 'vehicle_add' || $page == 'vehicle_edit'){ ?>
        $('.select2').select2();

        function create_data(){
            // var formData = $('form').serialize();
            // console.log(validation(formData));
            // return false;
            var formData = new FormData(document.getElementById("form1"));

            //  console.log(formData);
            
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: base+'vehicle/create', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        // console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = base+'vehicle';
                        }
                    }
                });
            }
        }

        function edit_data(){
            var formData = new FormData(document.getElementById("form1"));
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: base+'vehicle/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = base+'vehicle';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: base+'vehicle/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                success: function (data, textStatus, jqXHR) {
                    returnData = data;
                }
            });

            $('.validation-message').html('');
            if (returnData.status != 200) {
                $(".btn-submit").html("Submit");
                $('.validation-message').each(function () {
                    for (var key in returnData.result) {
                        if ($(this).attr('data-field') == key) {
                            $(this).html(returnData.result[key]);
                        }
                    }
                });
            } else {
                return 'success';
            }
        }

    <?php } ?>

    <?php if($page == 'book_now'){ ?>
        $('.select2').select2();

        $('#zipcode').select2({
            ajax: {
                type: "post",
                url: base+'booking/get_list_dropdown',
                dataType: 'json',
                data: function (params) {
                    // console.log(params)
                    var query = {
                        search: params.term,
                        type: 'public'
                    }
                    return query;
                },
                processResults: function (data) {
                    // console.log(data.result);
                    return {
                        results: data.result
                    };
                },
                // cache: true,
            },
            placeholder: 'Search for a zip code',
        });

        // console.log(currentDateTime.getDay());
        var date = new Date();

        var setTime = function(currentDateTime){
            if(date.getHours() >= 7){
                var minTime = date.getHours()+":"+date.getMinutes();
            }else{
                var minTime = '7:00';
            }

            this.setOptions({
                minTime:minTime,
                maxTime:'18:15'
            });
        };

        $('#time').datetimepicker({
            datepicker:false,
            format:'H:i',
            step:15,
            onShow:setTime,
            timezone:'UTC'

            // minTime:'11:00',
            // maxTime:'18:00',
        });

        // handlePermission();
        getLocation();

        function create_data(){
            var formData = new FormData(document.getElementById("form1"));

            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: base+'booking/bookNowSave', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        // console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = base+'booking';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: base+'booking/validationBookNow', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                success: function (data, textStatus, jqXHR) {
                    returnData = data;
                }
            });

            var alertStatus = false;
            $('.validation-message').html('');
            if (returnData.status != 200) {
                $(".btn-submit").html("Submit");
                // $('.validation-message').each(function () {
                    console.log(returnData.result);
                    // return false;

                    for (var key in returnData.result) {
                        if(key == "latitude" || key == "longitude"){
                            alertStatus = true;
                        }
                        console.log(key);
                        $('.validation-message[data-field="'+key+'"]').html(returnData.result[key]);
                    }
                // });

                if(alertStatus){
                    var alertModelHtml  = '<div class="modal-dialog">'+
                                                '<div class="modal-content">'+
                                                    '<div class="modal-body text-center">'+
                                                        '<p>Please allow location services of your browser.</p>'+
                                                        '<div class="text-center">'+
                                                            '<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancel</button>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>';
                    $('#confirm_model').html(alertModelHtml);
                    $('#confirm_model').modal('show');
                }
                
            } else {
                return 'success';
            }
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                console.log('Geolocation is not supported by this browser.');
            }
        }

        function showPosition(position) {
            // console.log(position.coords.latitude)
            // console.log(position.coords.longitude)
            $("#latitude").val(position.coords.latitude);
            $("#longitude").val(position.coords.longitude);
        }
    
    <?php } ?>

    <?php if($page == 'book_schedule'){ ?>
        $('.select2').select2();

        $('#zipcode').select2({
            ajax: {
                type: "post",
                url: base+'booking/get_list_dropdown',
                dataType: 'json',
                data: function (params) {
                    // console.log(params)
                    var query = {
                        search: params.term,
                        type: 'public'
                    }
                    return query;
                },
                processResults: function (data) {
                    // console.log(data.result);
                    return {
                        results: data.result
                    };
                },
                // cache: true,
            },
            placeholder: 'Search for a zip code',
        });

        var minDate = new Date();
        minDate.setDate(minDate.getDate() + 1);

        var maxDate = new Date();
        maxDate.setDate(maxDate.getDate() + 8);
        
        $('#date_time').datetimepicker({
            format:'Y-m-d H:i',
            step:15,
            defaultDate: minDate,
            // onShow:setDateTime,
            timezone:'UTC',
            minDate: minDate,
            maxDate: maxDate,
        });

        // handlePermission();
        getLocation();

        function create_data(){
            var formData = new FormData(document.getElementById("form1"));

            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: base+'booking/bookNowSave', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        // console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = base+'booking';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: base+'booking/validationBookSchedule', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                success: function (data, textStatus, jqXHR) {
                    returnData = data;
                }
            });

            var alertStatus = false;
            $('.validation-message').html('');
            if (returnData.status != 200) {
                $(".btn-submit").html("Submit");
                // $('.validation-message').each(function () {
                    // console.log(returnData.result);
                    // return false;

                    for (var key in returnData.result) {
                        if(key == "latitude" || key == "longitude"){
                            alertStatus = true;
                        }
                        // console.log(key);
                        $('.validation-message[data-field="'+key+'"]').html(returnData.result[key]);
                    }
                // });

                if(alertStatus){
                    var alertModelHtml  = '<div class="modal-dialog">'+
                                                '<div class="modal-content">'+
                                                    '<div class="modal-body text-center">'+
                                                        '<p>Please allow location services of your browser.</p>'+
                                                        '<div class="text-center">'+
                                                            '<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancel</button>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>';
                    $('#confirm_model').html(alertModelHtml);
                    $('#confirm_model').modal('show');
                }
                
            } else {
                return 'success';
            }
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                console.log('Geolocation is not supported by this browser.');
            }
        }

        function showPosition(position) {
            // console.log(position.coords.latitude)
            // console.log(position.coords.longitude)
            $("#latitude").val(position.coords.latitude);
            $("#longitude").val(position.coords.longitude);
        }
    
    <?php } ?>

    <?php if($page == 'paymentCard_add' || $page == 'paymentCard_edit'){ ?>
        $('.select2').select2();

        function create_data(){
            var formData = new FormData(document.getElementById("form1"));
            //  console.log(formData);
            
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: base+'payment/createCard', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        // console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = base+'payment';
                        }
                    }
                });
            }
        }

        function edit_data(){
            var formData = new FormData(document.getElementById("form1"));
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: base+'payment/updateCard', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = base+'payment';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: base+'payment/validationCard', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                success: function (data, textStatus, jqXHR) {
                    returnData = data;
                }
            });

            $('.validation-message').html('');
            if (returnData.status != 200) {
                $(".btn-submit").html("Submit");
                $('.validation-message').each(function () {
                    for (var key in returnData.result) {
                        if ($(this).attr('data-field') == key) {
                            $(this).html(returnData.result[key]);
                        }
                    }
                });
            } else {
                return 'success';
            }
        }
    <?php } ?>

    <?php if($page == 'refer_friend'){ ?>
        $(".btn-copy").click(function(e){
            e.preventDefault();
            $('#link').select();
            document.execCommand("copy");
        })

        function edit_data(){
            var formData = new FormData(document.getElementById("form1"));
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: base+'refer/sendMail', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = base+'refer';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: base+'refer/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                success: function (data, textStatus, jqXHR) {
                    returnData = data;
                }
            });

            $('.validation-message').html('');
            if (returnData.status != 200) {
                $(".btn-submit").html("Submit");
                $('.validation-message').each(function () {
                    for (var key in returnData.result) {
                        if ($(this).attr('data-field') == key) {
                            $(this).html(returnData.result[key]);
                        }
                    }
                });
            } else {
                return 'success';
            }
        }
    <?php } ?>

    <?php if($page == 'membership_add' || $page == 'membership_edit'){ ?>
        $('.select2').select2();

        function create_data(){
            var formData = new FormData(document.getElementById("form1"));
            //  console.log(formData);
            
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: base+'membership/create', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        // console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = base+'membership';
                        }
                    }
                });
            }
        }

        function edit_data(){
            var formData = new FormData(document.getElementById("form1"));
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: base+'membership/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = base+'membership';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: base+'membership/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                success: function (data, textStatus, jqXHR) {
                    returnData = data;
                }
            });
            
            $('.validation-message').html('');
            if (returnData.status != 200) {
                $(".btn-submit").html("Submit");
                $('.validation-message').each(function () {
                    for (var key in returnData.result) {
                        if ($(this).attr('data-field') == key) {
                            $(this).html(returnData.result[key]);
                        }
                    }
                });
            } else {
                return 'success';
            }
        }
    <?php } ?>

    <?php if($page == 'notification_add'){ ?>
        $('.select2').select2();

        function create_data(){
            // var formData = $('form').serialize();
            // console.log(validation(formData));
            // return false;
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'add');
            
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: base+'notification/create', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        // console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = base+'notification';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: base+'notification/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                success: function (data, textStatus, jqXHR) {
                    returnData = data;
                }
            });

            $('.validation-message').html('');
            if (returnData.status != 200) {
                $(".btn-submit").html("Submit");
                $('.validation-message').each(function () {
                    for (var key in returnData.result) {
                        if ($(this).attr('data-field') == key) {
                            $(this).html(returnData.result[key]);
                        }
                    }
                });
            } else {
                return 'success';
            }
        }

    <?php } ?>

// You can get calendar instance
// var calendarInstance = $calEl.data('tuiCalendar');

// calendarInstance.createSchedules([...]);
</script>