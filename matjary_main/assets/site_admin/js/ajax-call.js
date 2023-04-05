$(document).ready(function () {
    let base_url = window.location.origin+'/Matjary-Revamping/matjary_main/';
       /* //submit user login form */
        /* Product Action Common js for delete.activate,deactivate operations start */
        let confirm = 'Are you sure You Want to Deactivate this Record ?';
        let RecordIsSafe = 'Record is safe.';
        let Deactivated = 'Deactivated';
        let Activated = 'Activated !';
        let record_is_safe = "Record is safe .";

    $("#listingWrapper").on('click', '.actionBtn', function(){
        let action_page = $(this).data('actionurl');
        let operation = $(this).data('operation');
        if(operation=='delete'){
            let id = $(this).data('id');
            swal({
                title: "Are you sure You Want to Remove this Record ?",
                text: "This Record will Remove ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Remove !",
                showLoaderOnConfirm: true,
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax
                    ({
                        type: "POST",
                        data: {"id":id},
                        url: action_page,
                        beforeSend: function() {
                            swal({
                            title: "",
                            text: "Processing...",
                            imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                            showConfirmButton: false
                        });
                        },
                        success: function(resp)
                        {
                            resp = JSON.parse(resp);
                            resp_statuscode = resp.responseCode;
                            if(resp_statuscode==200){
                                $("#preloader").hide();
                                resp_msg = resp.responseMessage;
                                swal({title: "Removed!", text: resp_msg, type: "success"},
                                    function(){
                                       window.location.reload();
                                    }
                                );
                            }else{
                                $("#preloader").hide();
                                resp_error = resp.responseMessage;
                                swal("Error", resp_error, "error");
                            }
                        }
                    });

                } else {
                    swal('Cancelled', RecordIsSafe, "error");
                }
            });
        }else if(operation=='activate'){
            let id = $(this).data('id');
            swal({
                title: 'Are you sure You Want to Activate this Record ?',
                text: 'This Record will Activate',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: 'Yes, Activate !',
                showLoaderOnConfirm: true,
                cancelButtonText: 'No, cancel please!',
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax
                    ({
                        type: "POST",
                        data: {"id":id},
                        url: action_page,
                        beforeSend: function() {
                            swal({
                            title: "",
                            text: "Processing...",
                            imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                            showConfirmButton: false
                        });
                        },
                        success: function(resp)
                        {
                            resp = JSON.parse(resp);
                            resp_statuscode = resp.responseCode;
                            if(resp_statuscode==200){
                                $("#preloader").hide();
                                resp_msg = resp.responseMessage;
                                swal({title: Activated , text: resp_msg, type: "success"},
                                    function(){
                                       window.location.reload();
                                    }
                                );
                            }else{
                                $("#preloader").hide();
                                resp_error = resp.responseMessage;
                                swal("Error", resp_error, "error");
                            }
                        }
                    });

                } else {
                    swal('Cancelled', RecordIsSafe, "error");
                }
            });
        }else if(operation=='deactivate'){
            let id = $(this).data('id');
            swal({
                title: confirm,
                text: " ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: 'Yes, Deactivate !',
                showLoaderOnConfirm: true,
                cancelButtonText: 'No, cancel please!',
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax
                    ({
                        type: "POST",
                        data: {"id":id},
                        url: action_page,
                        beforeSend: function() {
                            swal({
                            title: "",
                            text:  "Processing...",
                            imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                            showConfirmButton: false
                        });
                        },
                        success: function(resp)
                        {
                            resp = JSON.parse(resp);
                            resp_statuscode = resp.responseCode;
                            if(resp_statuscode==200){
                                $("#preloader").hide();
                                resp_msg = resp.responseMessage;
                                swal({title: Deactivated, text: resp_msg, type: "success"},
                                    function(){
                                        window.location.reload();
                                    }
                                );
                            }else{
                               $("#preloader").hide();
                                resp_error = resp.responseMessage;
                                swal("Error", resp_error, "error");
                            }
                        }
                    });

                } else {
                    swal('Cancelled', RecordIsSafe, "error");
                }
            });
        }

    });
    $("#chk_admin_login").on('submit', (function (e) {
        e.preventDefault();
        var isvalidate = $("#chk_admin_login").valid();
        if (!isvalidate) {
            return false;
        } else {
            var form = $('#chk_admin_login')[0];
            var requestData = new FormData(form);
            var action_page = $("#chk_admin_login").attr('action');
            $.ajax({
                url: action_page,
                type: "POST",
                enctype: 'multipart/form-data',
                data: requestData,
                contentType: false,
                cache: false,
                processData: false,
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function (resp) {
                    console.log(resp);
                    resp = JSON.parse(resp);
                    if (resp.responseCode == 200) {
                      window.location.href = resp.redirectUrl;
                    } else {
                        swal({title: "", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#save_admin_user").on('submit', (function (e) {
        e.preventDefault();
        var isvalidate = $("#save_admin_user").valid();
        if (!isvalidate) {
            return false;
        } else {
            var form = $('#save_admin_user')[0];
            var requestData = new FormData(form);
            var action_page = $("#save_admin_user").attr('action');
            $.ajax({
                url: action_page,
                type: "POST",
                enctype: 'multipart/form-data',
                data: requestData,
                contentType: false,
                cache: false,
                processData: false,
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function (resp) {
                    console.log(resp);
                    resp = JSON.parse(resp);
                    if (resp.responseCode == 200) {
                          swal({title: "", text: resp.responseMessage, type: "success"},
		                    function(){
                                $("#save_admin_user")[0].reset();
		                        window.location.href = resp.redirectUrl;
		                    }
		                );
                    } else {
                        swal({title: "Fail", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#save_edit_admin_user").on('submit', (function (e) {
        e.preventDefault();
        var isvalidate = $("#save_edit_admin_user").valid();
        if (!isvalidate) {
            return false;
        } else {
            var form = $('#save_edit_admin_user')[0];
            var requestData = new FormData(form);
            var action_page = $("#save_edit_admin_user").attr('action');
            $.ajax({
                url: action_page,
                type: "POST",
                enctype: 'multipart/form-data',
                data: requestData,
                contentType: false,
                cache: false,
                processData: false,
                timeout: 600000,
                success: function (resp) {
                    console.log(resp);
                    resp = JSON.parse(resp);
                    if (resp.responseCode == 200) {
                        swal({title: "", text: resp.responseMessage, type: "success"},
                        function(){
                            window.location.reload();
                        }
                       );
                    } else {
                        swal({title: "Fail", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#save_template_category").on('submit', (function (e) {
        e.preventDefault();
        var isvalidate = $("#save_template_category").valid();
        if (!isvalidate) {
            return false;
        } else {
            var form = $('#save_template_category')[0];
            var requestData = new FormData(form);
            var action_page = $("#save_template_category").attr('action');
            $.ajax({
                url: action_page,
                type: "POST",
                enctype: 'multipart/form-data',
                data: requestData,
                contentType: false,
                cache: false,
                processData: false,
                timeout: 600000,
                success: function (resp) {
                    //console.log(resp);
                    resp = JSON.parse(resp);
                    if (resp.responseCode == 200) {
                        swal({title: "", text: resp.responseMessage, type: "success"},
                        function(){
                            window.location.reload();
                        }
                       );
                    } else {
                        swal({title: "Fail", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#save_category").on('submit', (function (e) {
        e.preventDefault();
        var isvalidate = $("#save_category").valid();
        if (!isvalidate) {
            return false;
        } else {
            var form = $('#save_category')[0];
            var requestData = new FormData(form);
            var action_page = $("#save_category").attr('action');
            $.ajax({
                url: action_page,
                type: "POST",
                enctype: 'multipart/form-data',
                data: requestData,
                contentType: false,
                cache: false,
                processData: false,
                timeout: 600000,
                success: function (resp) {
                    console.log(resp);
                    resp = JSON.parse(resp);
                    if (resp.responseCode == 200) {
                        swal({title: "", text: resp.responseMessage, type: "success"},
                        function(){
                            window.location.reload();
                        }
                       );
                    } else {
                        swal({title: "Fail", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#save_template").on('submit', (function (e) {
        e.preventDefault();
        var isvalidate = $("#save_template").valid();
        if (!isvalidate) {
            return false;
        } else {
            var form = $('#save_template')[0];
            var requestData = new FormData(form);
            var action_page = $("#save_template").attr('action');
            $.ajax({
                url: action_page,
                type: "POST",
                enctype: 'multipart/form-data',
                data: requestData,
                contentType: false,
                cache: false,
                processData: false,
                timeout: 600000,
                beforeSend: function () {
                    swal({
                        title: "",
                        imageUrl: base_url + "/assets/images/loader/matjary-loader.gif",
                        buttons: false,
                        closeOnClickOutside: false,
                        showConfirmButton: false
                    });
                },
                success: function (resp) {
                    //console.log(resp);
                    resp = JSON.parse(resp);
                    if (resp.responseCode == 200) {
                        swal({title: "", text: resp.responseMessage, type: "success"},
                        function(){
                          window.location.href = resp.redirectUrl;
                        }
                       );
                    } else {
                        swal({title: "Fail", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#edit_save_template").on('submit', (function (e) {
        e.preventDefault();
        var isvalidate = $("#edit_save_template").valid();
        if (!isvalidate) {
            return false;
        } else {
            var form = $('#edit_save_template')[0];
            var requestData = new FormData(form);
            var action_page = $("#edit_save_template").attr('action');
            $.ajax({
                url: action_page,
                type: "POST",
                enctype: 'multipart/form-data',
                data: requestData,
                contentType: false,
                cache: false,
                processData: false,
                timeout: 600000,
                beforeSend: function () {
                    swal({
                        title: "",
                        imageUrl: base_url + "/assets/images/loader/matjary-loader.gif",
                        buttons: false,
                        closeOnClickOutside: false,
                        showConfirmButton: false
                    });
                },
                success: function (resp) {
                    console.log(resp);
                    resp = JSON.parse(resp);
                    if (resp.responseCode == 200) {
                        swal({title: "", text: resp.responseMessage, type: "success"},
                        function(){
                          window.location.reload();
                        }
                       );
                    } else {
                        swal({title: "Fail", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#save_plan").on('submit', (function (e) {
        e.preventDefault();
        var isvalidate = $("#save_plan").valid();
        if (!isvalidate) {
            return false;
        } else {
            var form = $('#save_plan')[0];
            var requestData = new FormData(form);
            var action_page = $("#save_plan").attr('action');
            $.ajax({
                url: action_page,
                type: "POST",
                enctype: 'multipart/form-data',
                data: requestData,
                contentType: false,
                cache: false,
                processData: false,
                timeout: 600000,
                success: function (resp) {
                    console.log(resp);
                    resp = JSON.parse(resp);
                    if (resp.responseCode == 200) {
                        swal({title: "", text: resp.responseMessage, type: "success"},
                        function(){
                          window.location.reload();
                        //   $("#save_plan")[0].reset();
		                //     window.location.href = respData.redirectUrl;
                        }
                       );
                    } else {
                        swal({title: "Fail", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#update_plan").on('submit', (function (e) {
        e.preventDefault();
        var isvalidate = $("#update_plan").valid();
        if (!isvalidate) {
            return false;
        } else {
            var form = $('#update_plan')[0];
            var requestData = new FormData(form);
            var action_page = $("#update_plan").attr('action');
            $.ajax({
                url: action_page,
                type: "POST",
                enctype: 'multipart/form-data',
                data: requestData,
                contentType: false,
                cache: false,
                processData: false,
                timeout: 600000,
                success: function (resp) {
                    console.log(resp);
                    resp = JSON.parse(resp);
                    if (resp.responseCode == 200) {
                        swal({title: "", text: resp.responseMessage, type: "success"},
                        function(){
                          window.location.reload();
                        }
                       );
                    } else {
                        swal({title: "Fail", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#save_profile").on('submit', (function (e) {
        e.preventDefault();
        var isvalidate = $("#save_profile").valid();
        if (!isvalidate) {
            return false;
        } else {
            var form = $('#save_profile')[0];
            var requestData = new FormData(form);
            var action_page = $("#save_profile").attr('action');
            $.ajax({
                url: action_page,
                type: "POST",
                enctype: 'multipart/form-data',
                data: requestData,
                contentType: false,
                cache: false,
                processData: false,
                timeout: 600000,
                success: function (resp) {
                    console.log(resp);
                    resp = JSON.parse(resp);
                    if (resp.responseCode == 200) {
                        swal({title: "", text: resp.responseMessage, type: "success"},
                        function(){
                            window.location.reload();
                        }
                       );
                    } else {
                        swal({title: "Fail", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#change_admin_password").on('submit', (function (e) {
        e.preventDefault();
        var isvalidate = $("#change_admin_password").valid();
        if (!isvalidate) {
            return false;
        } else {
            var form = $('#change_admin_password')[0];
            var requestData = new FormData(form);
            var action_page = $("#change_admin_password").attr('action');
            $.ajax({
                url: action_page,
                type: "POST",
                enctype: 'multipart/form-data',
                data: requestData,
                contentType: false,
                cache: false,
                processData: false,
                timeout: 600000,
                success: function (resp) {
                    console.log(resp);
                    resp = JSON.parse(resp);
                    if (resp.responseCode == 200) {
                        swal({title: "", text: resp.responseMessage, type: "success"},
                        function(){
                            window.location.reload();
                        }
                       );
                    } else {
                        swal({title: "Fail", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#myChartglobal").load("dashboard.php", function(){
        var action_page = base_url+'/site-admin/get-dashboard-data';
        $.ajax({
            url: action_page,
            type: "POST",
            enctype: 'multipart/form-data',
            data: '',
            success: function (resp) {
                resp = JSON.parse(resp);

                var getCurrentMonthval= resp.getCurrentMonthval;
                var getMonthArry = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
                var chartName = 'User Registration';
                var chartId = 'myChartglobal';
                var yAxesLabel = 'No. of User Register';
                var xAxesLabel = 'Months';

                console.log(getMonthArry);
                if (resp.responseCode == 200) {
                    drawLineChart(chartId,getCurrentMonthval,getMonthArry,chartName,yAxesLabel,xAxesLabel);
                } else {
                    swal({title: "Fail", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                }
            }
        });
    });

    $("#myChart").load("dashboard.php", function(){
        var action_page = base_url+'/site-admin/get-oreder-sales-data';
        $.ajax({
            url: action_page,
            type: "POST",
            enctype: 'multipart/form-data',
            data: '',
            success: function (resp) {
                resp = JSON.parse(resp);
                var chartId = 'myChart';
                var getCurrentOrderTotal= resp.getCurrentOrderTotal;
                var getMonthArry =  new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
                var chartName = 'Month on Month Orders ';
                var yAxesLabel = 'No. of Orders';
                var xAxesLabel = 'Months';
                if (resp.responseCode == 200) {
                    drawBarChart(chartId,getCurrentOrderTotal,getMonthArry,chartName,yAxesLabel,xAxesLabel);
                } else {
                    swal({title: "Fail", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                }
            }
        });
    });

    // $("#chartIds").load("dashboard.php", function(){
    //     var action_page = base_url+'/Matjary-Revamping/matjary_main/site-admin/get-dashboard-data';
    //     $.ajax({
    //         url: action_page,
    //         type: "POST",
    //         enctype: 'multipart/form-data',
    //         data: '',
    //         success: function (resp) {
    //             resp = JSON.parse(resp);
    //             var chartId = 'chartIds';
    //             var getCurrentMonthvalline= resp.getCurrentMonthval;
    //             var getCurrentMonthvalbar= resp.getCurrentMonthval;
    //             var getMonthArry = resp.getMonthArry;
    //             var chartName = 'User Registration Mixed Chart';
    //             if (resp.responseCode == 200) {
    //                 drawMixedChart(chartId,getCurrentMonthvalline,getCurrentMonthvalbar,getMonthArry,chartName);
    //             } else {
    //                 swal({title: "Fail", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
    //             }
    //         }
    //     });
    // });

    $("#SalesOrders").load("dashboard.php", function(){
        var action_page = base_url+'/site-admin/get-oreder-sales-data';
        $.ajax({
            url: action_page,
            type: "POST",
            enctype: 'multipart/form-data',
            data: '',
            success: function (resp) {
                resp = JSON.parse(resp);
                var chartId = 'SalesOrders';
                var getCurrentOrderTotal= resp.getCurrentOrderTotal;
                var getCurrentSalesTotal= resp.getCurrentSalesTotal;
                var getMonthArry =  new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
                var chartName = 'Month on Month sales /orders';
                var yAxesLabel = 'No. of sales/orders';
                var xAxesLabel = 'Months';

                if (resp.responseCode == 200) {
                    drawMixedChart(chartId,getCurrentOrderTotal,getCurrentSalesTotal,getMonthArry,chartName,yAxesLabel,xAxesLabel);
                } else {
                    swal({title: "Fail", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                }
            }
        });
    });

    $("#revenueCharts").load("dashboard.php", function(){
        var action_page = base_url+'/site-admin/get-revenue-data';
        $.ajax({
            url: action_page,
            type: "POST",
            enctype: 'multipart/form-data',
            data: '',
            success: function (resp) {
                resp = JSON.parse(resp);

                var getCurrentRevenueTotal= resp.getCurrentRevenueTotal;
                var getMonthArry = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
                var chartName = 'Month on Month Revenue';
                var chartId = 'revenueCharts';
                var yAxesLabel = 'No. of Revenue';
                var xAxesLabel = 'Months';
                if (resp.responseCode == 200) {
                    drawLineChart(chartId,getCurrentRevenueTotal,getMonthArry,chartName,yAxesLabel,xAxesLabel);
                } else {
                    swal({title: "Fail", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                }
            }
        });
    });

    $("#save_coupon").on('submit', (function (e) {
        e.preventDefault();
        var isvalidate = $("#save_coupon").valid();
        if (!isvalidate) {
            return false;
        } else {
            var form = $('#save_coupon')[0];
            var requestData = new FormData(form);
            var action_page = $("#save_coupon").attr('action');
            $.ajax({
                url: action_page,
                type: "POST",
                enctype: 'multipart/form-data',
                data: requestData,
                contentType: false,
                cache: false,
                processData: false,
                timeout: 600000,
                success: function (resp) {
                    console.log(resp);
                    resp = JSON.parse(resp);
                    if (resp.responseCode == 200) {
                        swal({title: "", text: resp.responseMessage, type: "success"},
                        function(){
                            window.location.reload();
                        }
                       );
                    } else {
                        swal({title: "Fail", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#update_coupon").on('submit', (function (e) {
        e.preventDefault();
        var isvalidate = $("#update_coupon").valid();
        if (!isvalidate) {
            return false;
        } else {
            var form = $('#update_coupon')[0];
            var requestData = new FormData(form);
            var action_page = $("#update_coupon").attr('action');
            $.ajax({
                url: action_page,
                type: "POST",
                enctype: 'multipart/form-data',
                data: requestData,
                contentType: false,
                cache: false,
                processData: false,
                timeout: 600000,
                success: function (resp) {
                    console.log(resp);
                    resp = JSON.parse(resp);
                    if (resp.responseCode == 200) {
                        swal({title: "", text: resp.responseMessage, type: "success"},
                        function(){
                            window.location.reload();
                        }
                       );
                    } else {
                        swal({title: "Fail", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
  

});
/* theme filter function start */
