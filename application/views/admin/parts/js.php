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
            $page == 'appointment_list' || $page == 'adminUser_list' || $page == 'customer_list' || $page == 'faq_list' || $page == 'zone_list' || $page == 'branch_list' ||
            $page == 'driver_list' || $page == 'role_list' || $page == 'package_list' || $page == 'vehicleType_list' ||
            $page == 'membership_list' || $page == 'dispatch_list' || $page == 'payment_list' || $page == 'addOn_list' || $page == 'dispatching'){ ?>
            <!-- dataTable -->
            <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <?php } ?>

    <?php if($page == 'dispatching'){ ?>
        <script src="https://cdn.datatables.net/scroller/2.0.4/js/dataTables.scroller.min.js"></script>
    <?php } ?>

    <?php if($page == 'category_add' || $page == 'category_edit' || $page == 'serviceProvider_add' || $page == 'serviceProvider_edit' || 
            $page == 'coWorker_add' || $page == 'coWorker_edit' || $page == 'service_add' || $page == 'service_edit' || $page == 'offer_add' || $page == 'offer_edit' ||
            $page == 'adminUser_add' || $page == 'adminUser_edit' || $page == 'customer_add' || $page == 'customer_edit' || $page == 'settings_list' || $page == 'package_add' || 
            $page == 'package_edit' || $page == 'profile_edit' || $page == 'driver_add' || $page == 'driver_edit' || $page == 'vehicleType_add' || $page == 'vehicleType_edit'){ ?>
        <script src="<?php echo $this->dash_assets; ?>custom-plugin/fileStyle/fileStyle.js"></script>
    <?php } ?>

    <?php if($page == 'coWorker_add' || $page == 'coWorker_edit' || $page == 'offer_add' || $page == 'offer_edit' || $page == 'appointment_add' || $page == 'appointment_edit' 
            || $page == 'driver_add' || $page == 'driver_edit' || $page == 'payment_list' || $page == 'customer_package_add' || $page == 'customer_package_edit'){ ?>
        <script src="<?php echo $this->dash_assets; ?>custom-plugin/datetimepicker/build/jquery.datetimepicker.full.js"></script>
    <?php } ?>

    <?php if($page == 'coWorker_add' || $page == 'coWorker_edit' || $page == 'service_add' || $page == 'service_edit' || $page == 'offer_add' || $page == 'offer_edit' ||
            $page == 'appointment_add' || $page == 'appointment_edit' || $page == 'notification_add' || $page == 'role_edit' || $page == 'role_add' || $page == 'settings_list' ||
            $page == 'package_edit' || $page == 'package_add' || $page == 'dispatch_view' || $page == 'branch_add' || $page == 'branch_edit' || 
            $page == 'driver_add' || $page == 'driver_edit'){ ?>
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
            $page == "appointment_list" || $page == "adminUser_list" || $page == 'customer_list' || $page == 'faq_list' || $page == 'zone_list' || $page == 'branch_list' ||
            $page == 'driver_list' || $page == 'role_list' || $page == 'package_list' || $page == 'membership_list' || $page == 'dispatch_list' || $page == 'payment_list' || 
            $page == 'addOn_list' || $page == 'vehicleType_list')){ ?>
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

    <?php if($page == 'payment_list'){ ?>
        $('#start_date').datetimepicker({
            format:'Y-m-d',
            timepicker:false,
            onShow:function(ct){
                this.setOptions({
                    maxDate:$('#end_date').val()?$('#end_date').val():false
                })
            },
            onChangeDateTime:function(){
                $("#end_date").val('');
            }
        });

        $('#end_date').datetimepicker({
            format:'Y-m-d',
            timepicker:false,
            onShow:function(ct){
                this.setOptions({
                    minDate:$('#start_date').val()?$('#start_date').val():false
                })
            }
        });
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

        function send_data(){
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'send');

            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'offer/sendMail', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

        function getTimeTemplate(schedule, isAllDay) {
            var html = [];

            if (!isAllDay) {
                html.push('<strong>' + moment(schedule.start.getTime()).format('HH:mm') + '</strong> ');
            }
            if (schedule.isPrivate) {
                html.push('<span class="calendar-font-icon ic-lock-b"></span>');
                html.push(' Private');
            } else {
                if (schedule.isReadOnly) {
                html.push('<span class="calendar-font-icon ic-readonly-b"></span>');
                } else if (schedule.recurrenceRule) {
                    html.push('<span class="calendar-font-icon ic-repeat-b"></span>');
                } else if (schedule.attendees.length) {
                    html.push('<span class="calendar-font-icon ic-user-b"></span>');
                } else if (schedule.location) {
                    html.push('<span class="calendar-font-icon ic-location-b"></span>');
                }
                html.push(' ' + schedule.title);
            }

            return html.join('');
        }

        function getGridTitleTemplate(type) {
            var title = '';

            switch(type) {
            case 'milestone':
                title = '<span class="tui-full-calendar-left-content">MILESTONE</span>';
                break;
            case 'task':
                title = '<span class="tui-full-calendar-left-content">TASK</span>';
                break;
            case 'allday':
                title = '<span class="tui-full-calendar-left-content">ALL DAY</span>';
                break;
            }

            return title;
        }

        function getGridCategoryTemplate(category, schedule) {
            var tpl;

            switch(category) {
            case 'milestone':
                tpl = '<span class="calendar-font-icon ic-milestone-b"></span> <span style="background-color: ' + schedule.bgColor + '">' + schedule.title + '</span>';
                break;
            case 'task':
                tpl = '#' + schedule.title;
                break;
            case 'allday':
                tpl = getTimeTemplate(schedule, true);
                break;
            }

            return tpl;
        }

        var calendar = new tui.Calendar('#calendar', {
            // options here
            taskView: true,
            defaultView: 'month',
            scheduleView: true,
            // week: {
            //     daynames: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            //     startDayOfWeek: 0,
            //     narrowWeekend: true
            // },
            // calendars: [],
            useCreationPopup: false,
            useDetailPopup: true,
            // template:templates,
            // schedule:{
            //     alldayTitle: function() {
            //         return '<span class="tui-full-calendar-left-content">ALL DAY</span>';
            //     },
            // },

            template: {
                milestone: function(schedule) {
                    return '<span style="color:red;"><i class="fa fa-flag"></i> ' + schedule.title + '</span>';
                },
                milestoneTitle: function() {
                    return 'Milestone';
                },
                task: function(schedule) {
                    return '&nbsp;&nbsp;#' + schedule.title;
                },
                taskTitle: function() {
                    return '<label><input type="checkbox" />Task</label>';
                },
                allday: function(schedule) {
                    // console.log(schedule);
                    return '<i class="fa fa-car"></i> ' +schedule.title;
                },
                alldayTitle: function() {
                    return 'All Day';
                },
                time: function(schedule) {
                    return '<div class="bg-danger"> '+schedule.title + ' <i class="fa fa-refresh"></i>' + schedule.start +'</div>';
                },
                goingDuration: function(schedule) {
                    return '<span class="calendar-icon ic-travel-time"></span>' + schedule.goingDuration + 'min.';
                },
                comingDuration: function(schedule) {
                    return '<span class="calendar-icon ic-travel-time"></span>' + schedule.comingDuration + 'min.';
                },
                monthMoreTitleDate: function(date, dayname) {
                    var day = date.split('.')[2];
                    return '<span class="tui-full-calendar-month-more-title-day">' + day + '</span> <span class="tui-full-calendar-month-more-title-day-label">' + dayname + '</span>';
                },
                monthMoreClose: function() {
                    return '<span class="tui-full-calendar-icon tui-full-calendar-ic-close"></span>';
                },
                monthGridHeader: function(dayModel) {
                    var date = parseInt(dayModel.date.split('-')[2], 10);
                    var classNames = ['tui-full-calendar-weekday-grid-date '];

                    if (dayModel.isToday) {
                        classNames.push('tui-full-calendar-weekday-grid-date-decorator');
                    }

                    return '<span class="' + classNames.join(' ') + '">' + date + '</span>';
                },
                monthGridHeaderExceed: function(hiddenSchedules) {
                    return '<span class="weekday-grid-more-schedules">+' + hiddenSchedules + '</span>';
                },
                monthGridFooter: function() {
                    return '';
                },
                monthGridFooterExceed: function(hiddenSchedules) {
                    return '';
                },
                monthDayname: function(model) {
                    return String(model.label).toLocaleUpperCase();
                },
                dayGridTitle: function(viewName) {
                    /*
                    * use another functions instead of 'dayGridTitle'
                    * milestoneTitle: function() {...}
                    * taskTitle: function() {...}
                    * alldayTitle: function() {...}
                    */

                    return getGridTitleTemplate(viewName);
                },
                schedule: function(schedule) {
                    /*
                    * use another functions instead of 'schedule'
                    * milestone: function() {...}
                    * task: function() {...}
                    * allday: function() {...}
                    */

                    return getGridCategoryTemplate(schedule.category, schedule);
                }
            },
            // week: {
            //     daynames: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            //     startDayOfWeek: 0,
            //     narrowWeekend: true
            // },
            // month: {
            //     daynames: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            //     startDayOfWeek: 0,
            //     narrowWeekend: true
            // },
            // list of Calendars that can be used to add new schedule
            // calendars: [],
            // whether use default creation popup or not
            // useCreationPopup: false,
            // whether use default detail popup or not
            // useDetailPopup: false
        });


        var appointmentData;
        $.ajax({
            type: "post", url: admin_base+'calendar/getAll', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:[],
            success: function (data, textStatus, jqXHR) {
                appointmentData = data;
            }
        });

        // if (appointmentData.status == 200) {
        //     console.log(appointmentData);
        // }

        // appointmentStData = [
        //     {
        //         id: '1',
        //         calendarId: '1',
        //         title: 'my schedule',
        //         category: 'allday',
        //         dueDateClass: '',
        //         start: '2021-05-18',
        //         // end: '2021-05-19',
        //         bgColor: '#e94e38',
        //         dragBgColor: '#e94e38',
        //         // color: '#e94e38'
        //     },
        //     {
        //         // id: '2',
        //         // calendarId: '1',
        //         // title: 'second schedule',
        //         category: 'allday',
        //         // dueDateClass: '',
        //         start: '2021-05-30T17:30:00+09:00',
        //         // end: '2021-05-30T17:31:00+12:00',
        //         // dueDateClass: '',
        //     },
        // ]

        // console.log(appointmentStData);
        // appointmentData = json.parse(appointmentData.result);
        appointmentData = appointmentData.result;
        // console.log(appointmentData);
        calendar.createSchedules(appointmentData);


        $('.move-today').click(function(){
            calendar.changeView('day', true);
        })

        $('.move-day').click(function(){
            var move_attr = $(this).attr('data-action');
            if(move_attr == "move-prev"){
                calendar.prev();
            }
            if(move_attr == "move-prev"){
                calendar.next();
            }
        })
        


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
        CKEDITOR.replace(document.getElementById('mail_content_CouponCode'));

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

        $('.new_address_btn').click(function(e){
            e.preventDefault();
            var html = '<div class="row address_row mb-2">'+
                            '<div class="col-md-2">'+
                                '<select name="address_type[]" class="form-control">'+
                                    '<option value="work">work</option>'+
                                    '<option value="gym">gym</option>'+
                                    '<option value="school">school</option>'+
                                '</select>'+
                            '</div>'+
                            '<div class="col-md-6">'+
                                '<input type="text" name="address_address[]" class="form-control" placeholder="Address">'+
                            '</div>'+
                            '<div class="col-md-3">'+
                                '<input type="text" name="address_zipcode[]" class="form-control" placeholder="Zip Code">'+
                            '</div>'+
                            '<div class="col-md-1">'+
                                '<button class="btn btn-danger dlt_address_btn" onclick="deleteAddress()"><i class="fa fa-trash"></i></button>'+
                            '</div>'+
                        '</div>';

            if($('.multiAddressBox .row').length){
                $('.multiAddressBox .row').last().after(html);
            }else{
                $('.multiAddressBox').html(html);
            }
        });

        $(document).on('click', '.dlt_address_btn', function(e){ 
            e.preventDefault();
            $(this).parents('.address_row').remove();
        });

        $('.new_vehicle_btn').click(function(e){
            e.preventDefault();
            var html = '<div class="row vehicle_row mb-2">'+
                            '<div class="col-md-4">'+
                                '<input type="text" name="vehicle_name[]" class="form-control" placeholder="Vehicle Name" value="">'+
                            '</div>'+
                            '<div class="col-md-3">'+
                                '<select name="vehicle_year[]" id="" class="form-control select2">'+
                                    <?php foreach(get_last_30_yr() as $val1){ ?>
                                        '<option value="<?php echo $val1; ?>"><?php echo $val1; ?></option>'+
                                    <?php } ?>
                                '</select>'+
                            '</div>'+

                            '<div class="col-md-4">'+
                                '<div class="row">'+
                                    '<div class="col-lg-10 file-box-wrapper">'+
                                        '<label class="file-box">'+
                                            '<span class="name-box">Drag or Select Files</span>'+
                                            '<input type="hidden" name="vehicle_image_old[]" id="image_old" value=""/>'+
                                            '<input type="file" name="vehicle_image[]" class="form-control input-single" onchange="preview(this);" accept=".png, .jpg, .jpeg, .svg"/>'+
                                        '</label>'+
                                    '</div>'+
                                    '<div class="col-lg-2 d-flex1 align-items-center pre-img-box">'+
                                        '<img src="" id="" class="img-fluid" />'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+

                            '<div class="col-md-1">'+
                                '<button class="btn btn-danger dlt_vehicle_btn"><i class="fa fa-trash"></i></button>'+
                            '</div>'+
                        '</div>';

            if($('.multiVehicleBox > .row').length){
                $('.multiVehicleBox > .row').last().after(html);
            }else{
                $('.multiVehicleBox').html(html);
            }
        });

        $(document).on('click', '.dlt_vehicle_btn', function(e){ 
            e.preventDefault();
            $(this).parents('.vehicle_row').remove();
        });

        $('.new_card_btn').click(function(e){
            e.preventDefault();
            var html = '<div class="row card_row mb-2">'+
                            '<div class="col-lg-6 mb-3">'+
                                '<input type="text" name="card_name[]" class="form-control" placeholder="Name" value="">'+
                            '</div>'+

                            '<div class="col-lg-6 mb-2">'+
                                '<input type="text" name="card_number[]" class="form-control" placeholder="Number" onkeypress="return isNumber(event)" value="">'+
                            '</div>'+

                            '<div class="col-lg-3 mb-3">'+
                                '<select name="card_expiry_month[]" id="expiry_month" class="form-control select2">'+
                                    '<option value=""> -- Expiry Month --</option>'+
                                    <?php foreach(get_month() as $val){ ?>
                                        '<option value="<?php echo $val; ?>" ><?php echo $val; ?></option>'+
                                    <?php } ?>
                               '</select>'+
                            '</div>'+

                            '<div class="col-lg-3 mb-3">'+
                                '<select name="card_expiry_year[]" id="" class="form-control select2">'+
                                    '<option value=""> -- Expiry Year --</option>'+
                                    <?php foreach(get_next_30_yr() as $val){ ?>
                                        '<option value="<?php echo $val; ?>" ><?php echo $val; ?></option>'+
                                    <?php } ?>
                                '</select>'+
                            '</div>'+

                            '<div class="col-lg-3 mb-3">'+
                                '<input type="text" name="card_cvv[]" class="form-control" placeholder="CVV" onkeypress="return isNumber(event)" value="">'+
                                '<span class="error text-danger validation-message" data-field="cvv"></span>'+
                            '</div>'+

                            '<div class="col-md-3 text-right">'+
                                '<button class="btn btn-danger dlt_card_btn"><i class="fa fa-trash"></i></button>'+
                            '</div>'+
                        '</div>';

            if($('.multiCardBox > .row').length){
                if($('.multiCardBox > .row').length < 3){
                    $('.multiCardBox > .row').last().after(html);
                }
            }else{
                $('.multiCardBox').html(html);
            }
        });

        $(document).on('click', '.dlt_card_btn', function(e){ 
            e.preventDefault();
            $(this).parents('.card_row').remove();
        });
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

        function deleteAddress(){
            $('.parent')
        }

    <?php } ?>

    <?php if($page == 'zone_add' || $page == 'zone_edit'){ ?>

        function create_data(){
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'add');
            
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'zone/create', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        if(data.status == 200){
                            window.location.href = admin_base+'zone';
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
                    type: "post", url: admin_base+'zone/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        if(data.status == 200){
                            window.location.href = admin_base+'zone';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: admin_base+'zone/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

    <?php if($page == 'branch_add' || $page == 'branch_edit'){ ?>

        function create_data(){
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'add');
            
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'branch/create', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        if(data.status == 200){
                            window.location.href = admin_base+'branch';
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
                    type: "post", url: admin_base+'branch/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        if(data.status == 200){
                            window.location.href = admin_base+'branch';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: admin_base+'branch/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

    <?php if($page == 'driver_add' || $page == 'driver_edit'){ ?>

        $('#start_time').datetimepicker({
            datepicker:false,
            format:'H:i',
            step:15,
            onShow:function(ct){
                this.setOptions({
                    maxTime:jQuery('#end_time').val()?jQuery('#end_time').val():false
                })
            },
        });

        $('#end_time').datetimepicker({
            datepicker:false,
            format:'H:i',
            step:15,
            onShow:function(ct){
                this.setOptions({
                    minTime:jQuery('#start_time').val()?jQuery('#start_time').val():false
                })
            },
        });

        $(".select2").select2();
        function create_data(){
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'add');
            
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'driver/create', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        if(data.status == 200){
                            window.location.href = admin_base+'driver';
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
                    type: "post", url: admin_base+'driver/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        if(data.status == 200){
                            window.location.href = admin_base+'driver';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: admin_base+'driver/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

    <?php if($page == 'vehicleType_add' || $page == 'vehicleType_edit'){ ?>

        function create_data(){
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'add');
            
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'vehicleType/create', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        if(data.status == 200){
                            window.location.href = admin_base+'vehicleType';
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
                    type: "post", url: admin_base+'vehicleType/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        if(data.status == 200){
                            window.location.href = admin_base+'vehicleType';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: admin_base+'vehicleType/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

    <?php if($page == 'addOn_add' || $page == 'addOn_edit'){ ?>

        function create_data(){
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'add');
            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'addOn/create', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        if(data.status == 200){
                            window.location.href = admin_base+'addOn';
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
                    type: "post", url: admin_base+'addOn/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        if(data.status == 200){
                            window.location.href = admin_base+'addOn';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: admin_base+'addOn/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

    <?php if($page == 'dispatch_add' || $page == 'dispatch_edit' || $page == 'dispatch_view'){ ?>
            $('.select2').select2();

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

            function view_update(){
                var formData = new FormData(document.getElementById("form1"));
                formData.append ('action', 'view');

                if(validation(formData) == 'success'){
                    $.ajax({
                        type: "post", url: admin_base+'dispatch/dispatch_view_update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                        success: function (data, textStatus, jqXHR) {
                            // console.log(data);
                            // return false;
                            if(data.status == 200){
                                window.location.href = admin_base+'dispatch';
                            }
                        }
                    });
                }
            }

            function validation(formData){
                $(".btn-submit").html("Validating data, please wait...");
                var returnData;
                $.ajax({
                    type: "post", url: admin_base+'dispatch/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

    <?php if($page == 'profile_add' || $page == 'profile_edit'){ ?>

        function edit_data(){
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'edit');

            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'profile/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = admin_base+'profile';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: admin_base+'profile/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

    <?php if($page == 'customer_package_add' || $page == 'customer_package_edit'){ ?>

        $('#start_date').datetimepicker({
            timepicker:false,
            format:'Y-m-d',
            // step:15,
            // onShow:function(ct){
            //     this.setOptions({
            //         maxTime:jQuery('#end_time').val()?jQuery('#end_time').val():false
            //     })
            // },
        });

        $('#end_date').datetimepicker({
            timepicker:false,
            format:'Y-m-d',
            // step:15,
            // onShow:function(ct){
            //     this.setOptions({
            //         minTime:jQuery('#start_time').val()?jQuery('#start_time').val():false
            //     })
            // },
        });

        function edit_data(){
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'edit');

            if(editValidation(formData) == 'success'){
                $.ajax({
                    type: "post", url: admin_base+'customer/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = admin_base+'profile';
                        }
                    }
                });
            }
        }

        function editValidation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: admin_base+'customer/customerPackageValidationEdit', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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

    <?php if($page == 'dispatching'){ ?>

        $('.buttonToggleSidebar').trigger('click');

        // $(".currentJobTbl").dataTable({
        //     language: {
        //         paginate: {
        //             next: '<i class="fa fa-angle-right"></i>',
        //             previous: '<i class="fa fa-angle-left"></i>'
        //         },
        //         emptyTable: "No data available in table"
        //     }
        // });

        $('#current').DataTable({
            serverSide: true,
            // ordering: false,
            // searching: false,

            ajax:{
                "url": admin_base+'dispatching/getData',
                // "dataType": "json",
                "type": "POST",
                // "columns": [
                //     { "data": "id" },
                //     { "data": "vehicle_name" },
                //     { "data": "location" },
                //     { "data": "company_name" },
                //     { "data": "created_at" },
                //     { "data": "id" },
                // ],
                
                // "success": function (data, callback, settings) {
                //     var out = [];
        
                //     for ( var i=data.start, ien=data.start+data.length ; i<ien ; i++ ) {
                //         out.push([ i+'-1', i+'-2', i+'-3', i+'-4', i+'-5']);
                //     }
        
                //     setTimeout(function () {
                //         callback( {
                //             draw: data.draw,
                //             data: out,
                //             recordsTotal: 5000000,
                //             recordsFiltered: 5000000
                //         } );
                //     }, 50);
                // },	
                
                // "columns": [
                //     { "data": "id" },
                //     { "data": "vehicle_name" },
                //     { "data": "location" },
                //     { "data": "company_name" }
                // ],

            },
            // ajax: function (data, callback, settings) {
            //     var out = [];
    
            //     for ( var i=data.start, ien=data.start+data.length ; i<ien ; i++ ) {
            //         out.push([ i+'-1', i+'-2', i+'-3', i+'-4', i+'-5']);
            //     }
    
            //     setTimeout(function () {
            //         callback( {
            //             draw: data.draw,
            //             data: out,
            //             recordsTotal: 5000000,
            //             recordsFiltered: 5000000
            //         } );
            //     }, 50);
            // },
            // scrollY: 200,
            // scroller: {
            //     loadingIndicator: true
            // },

            "columnDefs": [{ 
                "targets": [0],
                "orderable": false
            }]
            
        });
        
        

    <?php } ?>

// You can get calendar instance
// var calendarInstance = $calEl.data('tuiCalendar');

// calendarInstance.createSchedules([...]);
</script>