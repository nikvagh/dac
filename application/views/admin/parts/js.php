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
    <?php if($page == 'category_list' || $page == 'serviceProvider_list' || $page == 'coWorker_list' || $page == 'service_list' || $page == 'offer_list' || 
            $page == 'appointment_list' || $page == 'adminUser_list' || $page == 'customer_list' || $page == 'faq_list' || $page == 'role_list' || $page == 'package_list' || 
            $page == 'membership_list' || $page == 'dispatch_list'){ ?>
            <!-- dataTable -->
            <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <?php } ?>

    <?php if($page == 'category_add' || $page == 'category_edit' || $page == 'serviceProvider_add' || $page == 'serviceProvider_edit' || 
            $page == 'coWorker_add' || $page == 'coWorker_edit' || $page == 'service_add' || $page == 'service_edit' || $page == 'offer_add' || $page == 'offer_edit' ||
            $page == 'adminUser_add' || $page == 'adminUser_edit' || $page == 'customer_add' || $page == 'customer_edit' || $page == 'settings_list' || $page == 'package_add' || 
            $page == 'package_edit'){ ?>
        <script src="<?php echo $this->dash_assets; ?>custom-plugin/fileStyle/fileStyle.js"></script>
    <?php } ?>

    <?php if($page == 'coWorker_add' || $page == 'coWorker_edit' || $page == 'offer_add' || $page == 'offer_edit' || $page == 'appointment_add' || $page == 'appointment_edit'){ ?>
        <script src="<?php echo $this->dash_assets; ?>custom-plugin/datetimepicker/build/jquery.datetimepicker.full.js"></script>
    <?php } ?>

    <?php if($page == 'coWorker_add' || $page == 'coWorker_edit' || $page == 'service_add' || $page == 'service_edit' || $page == 'offer_add' || $page == 'offer_edit' ||
            $page == 'appointment_add' || $page == 'appointment_edit' || $page == 'notification_add' || $page == 'role_edit' || $page == 'role_add' || $page == 'settings_list' ||
            $page == 'package_edit' || $page == 'package_add'){ ?>
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
    var admin_base = '<?php echo base_url(ADMIN); ?>';
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

    <?php if(isset($page) && ($page == "category_list" || $page == "serviceProvider_list" || $page == "coWorker_list" || $page == "service_list" || $page == "offer_list" || 
            $page == "appointment_list" || $page == "adminUser_list" || $page == 'customer_list' || $page == 'faq_list'  || $page == 'role_list' || $page == 'package_list' || 
            $page == 'membership_list' || $page == 'dispatch_list')){ ?>
            $(".dataTable").dataTable({
                language: {
                    paginate: {
                        next: '<i class="fa fa-angle-right"></i>',
                        previous: '<i class="fa fa-angle-left"></i>'
                    },
                    emptyTable: "No data available in table"
                }
            });
    <?php } ?>

    <?php if($page == 'category_add' || $page == 'category_edit'){ ?>

        function create_data(){
            // var formData = $('form').serialize();
            // console.log(validation(formData));
            // return false;
            var formData = new FormData(document.getElementById("form1"));

            //  console.log(formData);
            
            if(validation(formData) == 'success'){
                // $.post(admin_base+'category/create', formData).done(function (data) {
                $.ajax({
                    type: "post", url: admin_base+'category/create', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        // console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = admin_base+'category';
                        }
                    }
                });
            }
        }

        function edit_data(){
            var formData = new FormData(document.getElementById("form1"));
            if(validation(formData) == 'success'){
                // $.post(admin_base+'category/create', formData).done(function (data) {
                $.ajax({
                    type: "post", url: admin_base+'category/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = admin_base+'category';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: admin_base+'category/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

    <?php if($page == 'serviceProvider_add' || $page == 'serviceProvider_edit'){ ?>

        function create_data(){
            // var formData = $('form').serialize();
            // console.log(validation(formData));
            // return false;
            var formData = new FormData(document.getElementById("form1"));

            //  console.log(formData);
            
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'serviceProvider/create', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        // console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = admin_base+'serviceProvider';
                        }
                    }
                });
            }
        }

        function edit_data(){
            var formData = new FormData(document.getElementById("form1"));
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'serviceProvider/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = admin_base+'serviceProvider';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: admin_base+'serviceProvider/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

    <?php if($page == 'coWorker_add' || $page == 'coWorker_edit'){ ?>
        $('.select2').select2();

        $('#start_time').datetimepicker({
            datepicker:false,
            format:'H:i',
            step:15,
            onShow:function( ct ){
                if($('#end_time').val() != '00:00:00' && $('#end_time').val() != '00:00'){
                    this.setOptions({
                        maxTime:$('#end_time').val()?$('#end_time').val():false
                    })
                }
            },
            onChangeDateTime:function(){
                $("#end_time").val('');
            }
        });

        $('#end_time').datetimepicker({
            datepicker:false,
            format:'H:i',
            step:15,
            onShow:function( ct ){
                this.setOptions({
                    minTime:$('#start_time').val()?$('#start_time').val():false
                })
            },
        });

        function create_data(){
            // var formData = $('form').serialize();
            // console.log(validation(formData));
            // return false;
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'add');
            
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'coWorker/create', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        // console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = admin_base+'coWorker';
                        }
                    }
                });
            }
        }

        function edit_data(){
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'edit');

            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'coWorker/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = admin_base+'coWorker';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: admin_base+'coWorker/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

    <?php if($page == 'service_add' || $page == 'service_edit'){ ?>
        $('.select2').select2();

        function create_data(){
            // var formData = $('form').serialize();
            // console.log(validation(formData));
            // return false;
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'add');
            
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'service/create', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        // console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = admin_base+'service';
                        }
                    }
                });
            }
        }

        function edit_data(){
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'edit');

            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'service/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = admin_base+'service';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: admin_base+'service/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

    <?php if($page == 'offer_add' || $page == 'offer_edit'){ ?>
        $('.select2').select2();

        $('#start_date').datetimepicker({
            format:'Y-m-d',
            onShow:function( ct ){
                this.setOptions({
                    maxDate:$('#end_date').val()?jQuery('#end_date').val():false
                })
            },
            timepicker:false,
            onChangeDateTime:function(){
                $("#end_date").val('');
            }
        });
        $('#end_date').datetimepicker({
            format:'Y-m-d',
            onShow:function( ct ){
                this.setOptions({
                    minDate:$('#start_date').val()?jQuery('#start_date').val():false
                })
            },
            timepicker:false
        });

        function create_data(){
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'add');
            
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'offer/create', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        // console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = admin_base+'offer';
                        }
                    }
                });
            }
        }

        function edit_data(){
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'edit');

            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'offer/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = admin_base+'offer';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: admin_base+'offer/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

    <?php if($page == 'appointment_add' || $page == 'appointment_edit'){ ?>
        $('.select2').select2();

        $('#zipcode').select2({
            ajax: {
                type: "post",
                url: admin_base+'zipcode/get_list_dropdown',
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

        $('#date').datetimepicker({
            'timepicker':false,
            'format':'Y-m-d',
            'step':15,
        });

        $('#time').datetimepicker({
            datepicker:false,
            format:'H:i',
            step:15
        });

        function create_data(){
            // var formData = $('form').serialize();
            // console.log(validation(formData));
            // return false;
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'add');
            
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'appointment/create', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        // console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = admin_base+'appointment';
                        }
                    }
                });
            }
        }

        function edit_data(){
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'edit');

            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'appointment/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = admin_base+'appointment';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: admin_base+'appointment/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

    <?php if($page == 'calendar_list'){ ?>
        var Calendar = tui.Calendar;
        var calendar = new Calendar('#calendar', {
            // options here
            taskView: true,
            defaultView: 'month',
            scheduleView: true,
            // week: {
            //     daynames: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            //     startDayOfWeek: 0,
            //     narrowWeekend: true
            // },
            calendars: [],
            useCreationPopup: false,
            useDetailPopup: false,
            // template:templates
        });

        calendar.createSchedules([
            {
                id: '1',
                calendarId: '1',
                title: 'my schedule',
                category: 'time',
                dueDateClass: '',
                start: '2021-04-18T22:30:00+09:00',
                end: '2021-04-20T02:30:00+09:00'
            },
            {
                id: '2',
                calendarId: '1',
                title: 'second schedule',
                category: 'time',
                dueDateClass: '',
                start: '2021-04-25T17:30:00+09:00',
                end: '2021-04-28T17:31:00+09:00'
            }
        ]);

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
                    type: "post", url: admin_base+'notification/create', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        // console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = admin_base+'notification';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: admin_base+'notification/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

    <?php if($page == 'notificationTemplate_list'){ ?>

        CKEDITOR.replace(document.getElementById('mail_content_UserAppointmentBook'));
        CKEDITOR.replace(document.getElementById('mail_content_AppointmentCancel'));
        CKEDITOR.replace(document.getElementById('mail_content_AppointmentReject'));
        CKEDITOR.replace(document.getElementById('mail_content_UserVerification'));
        CKEDITOR.replace(document.getElementById('mail_content_AppointmentComplete'));
        CKEDITOR.replace(document.getElementById('mail_content_ForgotPassword'));
        CKEDITOR.replace(document.getElementById('mail_content_WorkerAppointmentBook'));

        function edit_data(heading_code){
            // var formData = $('form').serialize();
            for (instance in CKEDITOR.instances)
            {
                CKEDITOR.instances[instance].updateElement();
            }

            var formData = new FormData(document.getElementById("form1_"+heading_code));
            formData.append ('action', 'edit');
            
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'notificationTemplate/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {

                        // console.log(data.result.tab);
                        // return false;

                        if(data.status == 200){
                            window.location.href = admin_base+'notificationTemplate?tab='+data.result.tab;
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: admin_base+'notificationTemplate/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

    <?php if($page == 'adminUser_add' || $page == 'adminUser_edit'){ ?>

        function create_data(){
            // var formData = $('form').serialize();
            // console.log(validation(formData));
            // return false;
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'add');
            
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'adminUser/create', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        // console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = admin_base+'adminUser';
                        }
                    }
                });
            }
        }

        function edit_data(){
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'edit');

            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'adminUser/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = admin_base+'adminUser';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: admin_base+'adminUser/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

    <?php if($page == 'customer_add' || $page == 'customer_edit'){ ?>

        function create_data(){
            // var formData = $('form').serialize();
            // console.log(validation(formData));
            // return false;
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'add');
            
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'customer/create', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        // console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = admin_base+'customer';
                        }
                    }
                });
            }
        }

        function edit_data(){
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'edit');

            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'customer/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = admin_base+'customer';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: admin_base+'customer/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

    <?php if($page == 'faq_add' || $page == 'faq_edit'){ ?>

        function create_data(){
            // var formData = $('form').serialize();
            // console.log(validation(formData));
            // return false;
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'add');
            
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'faq/create', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        // console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = admin_base+'faq';
                        }
                    }
                });
            }
        }

        function edit_data(){
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'edit');

            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'faq/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = admin_base+'faq';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: admin_base+'faq/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

    <?php if($page == 'role_add' || $page == 'role_edit'){ ?>

        $('.select2').select2();
        function create_data(){
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'add');
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'role/create', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        if(data.status == 200){
                            window.location.href = admin_base+'role';
                        }
                    }
                });
            }
        }

        function edit_data(){
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'edit');

            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'role/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        if(data.status == 200){
                            window.location.href = admin_base+'role';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: admin_base+'role/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

    <?php if($page == 'settings_list'){ ?>

        $('.select2').select2();

        // CKEDITOR.replace(document.getElementById('mail_content_UserAppointmentBook'));
        // CKEDITOR.replace(document.getElementById('mail_content_AppointmentCancel'));
        // CKEDITOR.replace(document.getElementById('mail_content_AppointmentReject'));
        // CKEDITOR.replace(document.getElementById('mail_content_UserVerification'));
        // CKEDITOR.replace(document.getElementById('mail_content_AppointmentComplete'));
        // CKEDITOR.replace(document.getElementById('mail_content_ForgotPassword'));
        CKEDITOR.replace(document.getElementById('privacy_policy'));

        function edit_data(settingType){
            // var formData = $('form').serialize();
            for (instance in CKEDITOR.instances)
            {
                CKEDITOR.instances[instance].updateElement();
            }

            var formData = new FormData(document.getElementById("form1_"+settingType));
            formData.append ('action', 'edit');
            formData.append ('settingType', settingType);
            
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'settings/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        // console.log(data.result.tab);
                        // return false;

                        if(data.status == 200){
                            window.location.href = admin_base+'settings?tab='+data.result.tab;
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: admin_base+'settings/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

    <?php if($page == 'package_add' || $page == 'package_edit'){ ?>

        $('.select2').select2();
        function create_data(){
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'add');
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'package/create', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        if(data.status == 200){
                            window.location.href = admin_base+'package';
                        }
                    }
                });
            }
        }

        function edit_data(){
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'edit');

            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'package/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        if(data.status == 200){
                            window.location.href = admin_base+'package';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: admin_base+'package/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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