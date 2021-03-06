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
    <?php if($page == 'appointment_list' || $page == 'coWorker_list'){ ?>
            <!-- dataTable -->
            <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <?php } ?>

    <?php if($page == 'profile_edit' || $page == 'coWorker_add' || $page == 'coWorker_edit'){ ?>
        <script src="<?php echo $this->dash_assets; ?>custom-plugin/fileStyle/fileStyle.js"></script>
    <?php } ?>

    <?php if($page == 'coWorker_add' || $page == 'coWorker_edit'){ ?>
        <script src="<?php echo $this->dash_assets; ?>custom-plugin/datetimepicker/build/jquery.datetimepicker.full.js"></script>
    <?php } ?>

    <?php if($page == ''){ ?>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <?php } ?>

    <?php if($page == 'calendar_list'){ ?>
        <script src="https://uicdn.toast.com/tui.code-snippet/v1.5.2/tui-code-snippet.min.js"></script>
        <script src="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.min.js"></script>
        <script src="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.min.js"></script>
        <script src="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.js"></script>
    <?php } ?>

    <?php if($page == ''){ ?>
        <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <?php } ?>
<?php } ?>

<script type="text/javascript">
    var sp_base = '<?php echo base_url(SP); ?>';
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

    <?php if(isset($page) && ($page == "appointment_list" || $page == "coWorker_list" )){ ?>
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

    <?php if($page == 'coWorker_add' || $page == 'coWorker_edit'){ ?>
        // $('.select2').select2();

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
                    type: "post", url: sp_base+'coWorker/create', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        // console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = sp_base+'coWorker';
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
                    type: "post", url: sp_base+'coWorker/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = sp_base+'coWorker';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: sp_base+'coWorker/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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
            type: "post", url: sp_base+'calendar/getAll', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:[],
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

    <?php if($page == 'profile_edit'){ ?>

        function edit_data(){
            var formData = new FormData(document.getElementById("form1"));
            formData.append ('action', 'edit');

            if(validation(formData) == 'success'){
                $.ajax({
                    type: "post", url: sp_base+'profile/update', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        // return false;
                        if(data.status == 200){
                            window.location.href = sp_base+'profile';
                        }
                    }
                });
            }
        }

        function validation(formData){
            $(".btn-submit").html("Validating data, please wait...");
            var returnData;
            $.ajax({
                type: "post", url: sp_base+'profile/validation', async: false, dataType: "json", cache: false, processData: false, contentType: false, data:formData,
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
    
</script>