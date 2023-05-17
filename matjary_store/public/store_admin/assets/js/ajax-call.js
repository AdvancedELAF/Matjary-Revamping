$(document).ready(function(){
    let base_url = window.location.origin;
    if(base_url == "http://localhost"){
        base_url= '/Matjary-Revamping/matjary_store';        
    }else{
        base_url;
    }

    let lang = $("#languageChange").data('lang');
    let confirm = 'Are you sure You Want to Deactivate this Record ?';
    let confirmBtnText = 'Yes, Deactivate !';
    let cancelBtnText = 'No, cancel please!';
    let Cancelled = 'Cancelled ';
    let RecordIsSafe = 'Record is safe.';
    let Deactivated = 'Deactivated';
    let ActivateRecord = 'Are you sure You Want to Activate this Record ?';
    let ThisRecordwillActivate  = 'This Record will Activate';
    let YesActivate = 'Yes, Activate !';
    let Nocancelplease = 'No, cancel please!';
    let Activated = 'Activated !';
    let record_is_safe = "Record is safe .";

    if(lang=='en'){
        confirm = 'هل أنت متأكد أنك تريد إلغاء تنشيط هذا السجل؟';
        confirmBtnText = 'نعم ، قم بإلغاء التنشيط!';
        cancelBtnText = 'لا ، إلغاء من فضلك!';
        Cancelled = 'ألغيت';
        RecordIsSafe = 'السجل آمن.';
        Deactivated = 'معطل';
        ActivateRecord = 'تنشيط السجل';
        ThisRecordwillActivate = 'سيتم تنشيط هذا السجل';
        YesActivate = 'نعم ، تفعيل!';
        Nocancelplease = 'لا ، إلغاء من فضلك!';
        Activated = 'مفعل !';
        record_is_safe = "السجل آمن.";
    }
    /* ================================= Store Admin js start ==================================== */
    /* Product Category js start */
    $("#save_product_category_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#save_product_category_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#save_product_category_form')[0]; /* Get form */
            var requestData = new FormData(form); /* Create an FormData object */
            var action_page = $("#save_product_category_form").attr('action'); 
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_product_category_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#update_product_category_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#update_product_category_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_product_category_form')[0]; /* Get form */
            var requestData = new FormData(form); /* Create an FormData object */
            var action_page = $("#update_product_category_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_product_category_form")[0].reset();
		                        window.location.reload();
		                    }
		                );
                    }else{
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    /* Product Category js end */

    /* Product Brand js start */
    $("#save_product_brand_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#save_product_brand_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#save_product_brand_form')[0]; /* Get form */ 
            var requestData = new FormData(form); /* Create an FormData object */
            var action_page = $("#save_product_brand_form").attr('action'); 
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_product_brand_form")[0].reset();
		                        window.location.href = respData.redirectUrl;		                       
		                    }
		                );
                    }else{
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#update_product_brand_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#update_product_brand_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_product_brand_form')[0]; /* Get form */ 
            var requestData = new FormData(form); /* Create an FormData object */
            var action_page = $("#update_product_brand_form").attr('action'); 
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_product_brand_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                       
		                    }
		                );
                    }else{
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    /* Product Brand js start */

    $(".cancelPickupBtn").click(function(){
        let action_page = $(this).data('actionurl');
        let guid = $(this).data('guid');
        let shipcmpid = $(this).data('shipcmpid');
        swal({
            title: (lang == "en") ?"هل أنت متأكد أنك تريد إلغاء طلب الالتقاط هذا؟":"Are you sure You Want to Cancel this Pickup Request ?",
            text: (lang == "en") ?"سيتم إلغاء هذا الالتقاط":"This Pickup will Cancel ",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: (lang == "en") ?"نعم الغاء!":"Yes, Cancel !",
            showLoaderOnConfirm: true,
            cancelButtonText: (lang == "en") ?"لا ، ارفض العمل من فضلك!":"No, reject action please!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm) {
                $.ajax
                ({
                    type: "POST",
                    data: {"guid":guid,"shipcmpid":shipcmpid},
                    url: action_page,
                    beforeSend: function() {
                        swal({
                            title: "",
                            text: (lang == "en") ? "معالجة..." : "Processing...",
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
                            swal({title: "Cancelled!", text: resp_msg, type: "success"},
                                function(){ 
                                    window.location.reload();
                                }
                            );
                        }else{
                            $("#preloader").hide();
                            resp_error = resp.responseMessage;
                            resp_notifications = resp.responseNotifications;
                            swal({
                                title: resp_notifications,
                                text: resp_error,
                                type: "error",
                            });
                        }
                    }
                });
    
            } else {
                swal("Rejected", (lang == "en") ?"الالتقاط آمن.":"Pickup is safe .", "error");
            }
        });
    });

    $(".trackPickupBtn").click(function(){
        let action_page = $(this).data('actionurl');
        let shipcmpid = $(this).data('shipcmpid');
        let pickreffid = $(this).data('pickreffid');
        $.ajax
        ({
            type: "POST",
            data: {"shipcmpid":shipcmpid,"pickreffid":pickreffid},
            url: action_page,
            beforeSend: function() {
                swal({
                    title: "",
                    text: (lang == "en") ? "معالجة..." : "Processing...",
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
                    swal({title: "Success!", text: resp_msg, type: "success"},
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
    });

    /* Product Action Common js for delete.activate,deactivate operations start */
    $(".actionBtn").click(function(){
        let action_page = $(this).data('actionurl');
        let operation = $(this).data('operation');
        if(operation=='delete'){
            let id = $(this).data('id');
            swal({
                title: (lang == "en") ?"":"Are you sure You Want to Remove this Record ?",
                text: (lang == "en") ?"سيتم إزالة هذا السجل":"This Record will Remove ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: (lang == "en") ?"نعم ، قم بإزالة!":"Yes, Remove !",
                showLoaderOnConfirm: true,
                cancelButtonText: (lang == "en") ?"لا ، إلغاء من فضلك!":"No, cancel please!",
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
                            text: (lang == "en") ? "معالجة..." : "Processing...",
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
                    swal(Cancelled, RecordIsSafe, "error");
                }
            });
        }else if(operation=='activate'){
            let id = $(this).data('id');
            swal({
                title: ActivateRecord,
                text: ThisRecordwillActivate,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: YesActivate,
                showLoaderOnConfirm: true,
                cancelButtonText: Nocancelplease,
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
                            text: (lang == "en") ? "معالجة..." : "Processing...",
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
                    swal(Cancelled, RecordIsSafe, "error");
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
                confirmButtonText: confirmBtnText,
                showLoaderOnConfirm: true,
                cancelButtonText: cancelBtnText,
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
                            text: (lang == "en") ? "معالجة..." : "Processing...",
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
                    swal(Cancelled, RecordIsSafe, "error");
                }
            });
        }
        
    });

    $(".removeImg").click(function(){
        let action_page = $(this).data('actionurl');
        let imgname = $(this).data('imgname');
        let id = $(this).data('id');
        let tablename = $(this).data('tablename');
        let tablecolumn = $(this).data('tablecolumn');
        swal(
            {
                title: (lang == "en") ?"هل أنت متأكد أنك تريد إزالة هذه الصورة؟":"Are you sure You Want to Remove this image ?",
                text: (lang == "en") ?"ستتم إزالة هذه الصورة":"This Image will Remove ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: (lang == "en") ?"نعم ، قم بإزالة!":"Yes, Remove !",
                showLoaderOnConfirm: true,
                cancelButtonText: (lang == "en") ?"لا ، إلغاء من فضلك!":"No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax
                    ({
                        type: "POST",
                        data: {"imgname":imgname,"id":id,"tablename":tablename,"tablecolumn":tablecolumn},
                        url: action_page,
                        beforeSend: function() {
                            swal({
                            title: "",
                            text: (lang == "en") ? "معالجة..." : "Processing...",
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
                    swal(Cancelled, (lang == "en") ?"الصورة آمنة.":"Image is safe .", "error");
                }
            }
        );
        
    });
    /* Product Action Common js for delete.activate,deactivate operations end */

    /* Ganaral Setting js start */
    $("#save_general_setting_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#save_general_setting_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#save_general_setting_form')[0]; /* Get form */ 
            var requestData = new FormData(form); /* Create an FormData object */
            var action_page = $("#save_general_setting_form").attr('action'); 
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_general_setting_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#update_general_setting_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#update_general_setting_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_general_setting_form')[0]; /* Get form */ 
            var requestData = new FormData(form); /* Create an FormData object */
            var action_page = $("#update_general_setting_form").attr('action'); 
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_general_setting_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                       
		                    }
		                );
                    } 
                    else{
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    /* Ganaral Setting js end */

    /* Product Color js start */
    $("#save_product_color_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#save_product_color_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#save_product_color_form')[0]; /* Get form */ 
            var requestData = new FormData(form); /* Create an FormData object */
            var action_page = $("#save_product_color_form").attr('action'); 
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_product_color_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                       
		                    }
		                );
                    }else{
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#update_product_color_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#update_product_color_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_product_color_form')[0]; /* Get form */ 
            var requestData = new FormData(form); /* Create an FormData object */
            var action_page = $("#update_product_color_form").attr('action'); 
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_product_color_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    /* Product Color js end */

    /* Product Size js start */
    $("#save_product_size_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#save_product_size_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#save_product_size_form')[0]; /* Get form */ 
            var requestData = new FormData(form); /* Create an FormData object */
            var action_page = $("#save_product_size_form").attr('action'); 
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_product_size_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    $("#update_product_size_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#update_product_size_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_product_size_form')[0]; /* Get form */ 
            var requestData = new FormData(form); /* Create an FormData object */
            var action_page = $("#update_product_size_form").attr('action'); 
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_product_size_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    /* Product Size js end */

    /* Shipping Setting ajax start */
    $("#save_shipping_setting_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#save_shipping_setting_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#save_shipping_setting_form')[0]; /* Get form */ 
            var requestData = new FormData(form); /* Create an FormData object */
            var action_page 		= $("#save_shipping_setting_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_shipping_setting_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            }); 
        }
    }));
    $("#update_shipping_setting_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#update_shipping_setting_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_shipping_setting_form')[0]; /* Get form */ 
            var requestData = new FormData(form); /* Create an FormData object */
            var action_page 		= $("#update_shipping_setting_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_shipping_setting_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    /* Shipping Setting ajx end */
    $("#submit_create_pickup_request_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#submit_create_pickup_request_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#submit_create_pickup_request_form')[0]; /* Get form */ 
            var requestData = new FormData(form); /* Create an FormData object */
            var action_page 		= $("#submit_create_pickup_request_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                swal.close();
                                $("#submit_create_pickup_request_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        swal.close();
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    /* Payment Setting ajax start */
    $("#save_payment_setting_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#save_payment_setting_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#save_payment_setting_form')[0]; /* Get form */ 
            var requestData = new FormData(form); /* Create an FormData object */
            var action_page 		= $("#save_payment_setting_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_payment_setting_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            }); 
        }
    }));

    $("#update_payment_setting_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#update_payment_setting_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_payment_setting_form')[0]; /* Get form */ 
            var requestData = new FormData(form); /* Create an FormData object */
            var action_page 		= $("#update_payment_setting_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_payment_setting_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
     /* Payment Setting ajx end */
     /* Product js start */
    $("#save_product_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#save_product_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#save_product_form')[0]; /* Get form */ 
            var requestData = new FormData(form); /* Create an FormData object */
            var action_page = $("#save_product_form").attr('action'); 
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_product_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    $("#update_product_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#update_product_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_product_form')[0]; /* Get form */ 
            var requestData = new FormData(form); /* Create an FormData object */
            var action_page = $("#update_product_form").attr('action'); 
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_product_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    /* Product js end */
    /* User js start */
    $("#save_user_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#save_user_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{            
            var form = $('#save_user_form')[0];   /* Get form */           
            var requestData = new FormData(form);   /*Create an FormData object */
            var action_page 		= $("#save_user_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,            /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_user_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    $("#update_user_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#update_user_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_user_form')[0];  /* Get form */           
            var requestData = new FormData(form); /* Create an FormData object */
            var action_page 		= $("#update_user_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){ /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_user_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    /* User js end */

    /* Customer js start */
    $("#save_customer_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#save_customer_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#save_customer_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object */
            var action_page 		= $("#save_customer_form").attr('action');
            /* processData & contentType should be set to false */
            $.ajax
            ({
                url: action_page, 		 /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,            /* To unable request pages to be cached */
                processData:false,       /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  // A function to be called if request succeeds
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_customer_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    $("#update_customer_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#update_customer_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_customer_form')[0]; /* Get form */
            var requestData = new FormData(form);   /* Create an FormData object  */
            var action_page 		= $("#update_customer_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_customer_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    /* Customer js end */
    /* Coupon js start */
    $("#save_coupon_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#save_coupon_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#save_coupon_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#save_coupon_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_coupon_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    $("#update_coupon_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#update_coupon_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_coupon_form')[0];  /*  Get form*/
            var requestData = new FormData(form);  /* Create an FormData object */
            var action_page 		= $("#update_coupon_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_coupon_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                       
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    /* Coupon js end */

     /* Banner js Start */
     $("#save_banner_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#save_banner_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#save_banner_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#save_banner_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_banner_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#update_banner_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#update_banner_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_banner_form')[0];  /*  Get form*/
            var requestData = new FormData(form);  /* Create an FormData object */
            var action_page 		= $("#update_banner_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_banner_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                       
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    /* Banner js End */
    /* ================================= Store Admin js end ==================================== */

    /* Faq js Start */
    $("#save_faq_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#save_faq_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#save_faq_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#save_faq_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_faq_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#update_faq_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#update_faq_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_faq_form')[0];  /*  Get form*/
            var requestData = new FormData(form);  /* Create an FormData object */
            var action_page 		= $("#update_faq_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_faq_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                       
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    /* Faq js End */
    
    /* Customer help js Start */
    $("#save_customer_help_form").on('submit',(function(e) {
		e.preventDefault();

        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var isvalidate = $("#save_customer_help_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#save_customer_help_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#save_customer_help_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_customer_help_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#update_customer_help_form").on('submit',(function(e) {
		e.preventDefault();

        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var isvalidate = $("#update_customer_help_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_customer_help_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#update_customer_help_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_customer_help_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
      /* Customer help js End */   

      /* Terms and Conditions js Start */
    $("#update_terms_conditions_form").on('submit',(function(e) {
		e.preventDefault();

        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
         var isvalidate = $("#update_terms_conditions_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_terms_conditions_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#update_terms_conditions_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_terms_conditions_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#save_terms_conditions_form").on('submit',(function(e) {
		e.preventDefault();

        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var isvalidate = $("#save_terms_conditions_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#save_terms_conditions_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#save_terms_conditions_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_terms_conditions_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
      /* Terms and Conditions js End */

      /* About Us js Start */
    $("#save_about_us_form").on('submit',(function(e) {
		e.preventDefault();

        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var isvalidate = $("#save_about_us_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#save_about_us_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#save_about_us_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_about_us_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#update_about_us_form").on('submit',(function(e) {
		e.preventDefault();

        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var isvalidate = $("#update_about_us_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_about_us_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#update_about_us_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_about_us_form")[0].reset();
		                        window.location.reload();
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    /* About Us js End */   

    /* Gift Card Js Start */
    $("#save_gift_card_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#save_gift_card_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#save_gift_card_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#save_gift_card_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_gift_card_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#update_gift_card_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#update_gift_card_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_gift_card_form')[0];  /*  Get form*/
            var requestData = new FormData(form);  /* Create an FormData object */
            var action_page 		= $("#update_gift_card_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_gift_card_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                       
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));    

     /* Advertisement js Start */
     $("#save_advertisement_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#save_advertisement_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#save_advertisement_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#save_advertisement_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_advertisement_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#update_advertisement_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#update_advertisement_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_advertisement_form')[0];  /*  Get form*/
            var requestData = new FormData(form);  /* Create an FormData object */
            var action_page 		= $("#update_advertisement_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_advertisement_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                       
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    /* Advertisement js End */
    $("#user_set_new_password_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#user_set_new_password_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#user_set_new_password_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#user_set_new_password_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#user_set_new_password_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#user_login_form").on('submit',(function(e) { 
		e.preventDefault();
        var isvalidate = $("#user_login_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#user_login_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#user_login_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        $("#preloader").hide();                        
                        $("#user_login_form")[0].reset();
                        window.location.href = respData.redirectUrl;
                    }else{
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));    
    
    $("#update_user_profile_form").on('submit',(function(e) { 
		e.preventDefault();
        var isvalidate = $("#update_user_profile_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_user_profile_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#update_user_profile_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_user_profile_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    
    $("#update_user_change_password_form").on('submit',(function(e) { 
		e.preventDefault();
        var isvalidate = $("#update_user_change_password_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_user_change_password_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#update_user_change_password_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_user_change_password_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $('#country_id').change(function(e) { 
        e.preventDefault();
        let country_id = $(this).val();
        var action_page = $(this).data('actionurl');
        let requestData = 'country_id='+country_id;
        $.ajax
        ({
            url: action_page, 		  /* Url to which the request is send */
            type: "POST",             /* Type of request to be send, called as method */
            enctype: 'multipart/form-data',
            data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
            beforeSend: function() {
                swal({
                    title: "",
                    text: (lang == "en") ? "معالجة..." : "Processing...",
                    imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                    showConfirmButton: false
                });
            },
            success: function(resp){  /* A function to be called if request succeeds */
                respData = JSON.parse(resp);                
                if(respData.responseCode == 200){
                    swal.close();
                    $("#state_id").empty('');
                    $("#state_id").append('<option value="">Select State</option>');
                    let stateList = respData.responseData;
                    $.each(stateList,function(key, value){
                        $("#state_id").append('<option value=' + value.id + '>' + value.name + '</option>');
                    });
                }else{                   
                    swal.close();
                    swal({title: "", text: respData.responseMessage, type: "error"});
                }
            }
        });
    });

    $('#state_id').change(function(e) { 
        e.preventDefault();
        let state_id = $(this).val();
        var action_page = $(this).data('actionurl');
        let requestData = 'state_id='+state_id;
        $.ajax
        ({
            url: action_page, 		  /* Url to which the request is send */
            type: "POST",             /* Type of request to be send, called as method */
            enctype: 'multipart/form-data',
            data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
            beforeSend: function() {
                swal({
                    title: "",
                    text: (lang == "en") ? "معالجة..." : "Processing...",
                    imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                    showConfirmButton: false
                });
            },
            success: function(resp){  /* A function to be called if request succeeds */
                respData = JSON.parse(resp);
                if(respData.responseCode == 200){
                    
                    swal.close();
                    $("#city_id").empty('');
                    $("#city_id").append('<option value="">Select City</option>');
                    let stateList = respData.responseData;
                    $.each(stateList,function(key, value){
                        $("#city_id").append('<option value=' + value.id + '>' + value.name + '</option>');
                    });
                }else{
                    
                    swal.close();
                    swal({title: "", text: respData.responseMessage, type: "error"});
                }
            }
        });
    });
    /* reply contact form */
    $("#reply_contact_form").on('submit',(function(e) { 
		e.preventDefault();
        var isvalidate = $("#reply_contact_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#reply_contact_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#reply_contact_form").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#reply_contact_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

   /* Admin Profile Picture */
    $("#user_profile_picture").on('submit',(function(e) { 
		e.preventDefault();
        var isvalidate = $("#user_profile_picture").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#user_profile_picture')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#user_profile_picture").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#user_profile_picture")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                    }
		                );
                    }else{
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
   /* Refund Request by admin */
    $('#ApprovedRefund').on('click', function(e) {
        e.preventDefault();
        let orderid = $(this).data('orderid');
        var action_page = $(this).data('actionurl');
        let requestData = 'orderid='+orderid;
        swal(
            {
                title: (lang == "en") ?"هل أنت متأكد أنك تريد الموافقة على هذا الاسترداد؟":"Are you sure You Want to Approve this Refund ?",
                text: (lang == "en") ?"ستتم الموافقة على هذا المبلغ المسترد":"This Refund will Approve ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#4BB543",
                confirmButtonText: (lang == "en") ?"نعم موافق!":"Yes, Approve !",
                showLoaderOnConfirm: true,
                cancelButtonText: (lang == "en") ?"لا ، إلغاء من فضلك!":"No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax
                        ({
                            url: action_page, 		  /* Url to which the request is send */
                            type: "POST",             /* Type of request to be send, called as method */
                            enctype: 'multipart/form-data',
                            data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                            beforeSend: function() {
                                swal({
                                    title: "",
                                    text: (lang == "en") ? "معالجة..." : "Processing...",
                                    imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                                    showConfirmButton: false
                                });
                            },
                            success: function(resp){  /* A function to be called if request succeeds */
                                respData = JSON.parse(resp);
                                
                                if(respData.responseCode == 200){
                                    $("#preloader").hide();
                                    swal({title: "", text: respData.responseMessage, type: "success"},
                                        function(){                                            
                                            window.location.href = respData.redirectUrl;                                           
                                        }
                                    );
                                }else{
                                    $("#preloader").hide();
                                    swal({title: "", text: respData.responseMessage, type: "error"});
                                }
                            }
                        });
                } else {
                    swal(Cancelled, record_is_safe, "error");
                }
            }
        );
    });

    /* user forgeted password start */
    $("#chk_password_forgoted_user_email").on('submit',(function(e) { 
        e.preventDefault();
        var isvalidate = $("#chk_password_forgoted_user_email").valid();
        if (!isvalidate) {
            return false;
        }else{
            var form = $('#chk_password_forgoted_user_email')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#chk_password_forgoted_user_email").attr('action');
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                contentType: false,       /* The content type used when sending data to the server. */
                cache: false,             /* To unable request pages to be cached */
                processData:false,        /* Important! To send DOMDocument or non processed data file it is set to false */
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: (lang == "en") ? "معالجة..." : "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
                            function(){ 
                                window.location.href = respData.redirectUrl;
                            }
                        );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    /* user forgeted password end */    
    $('#setDefaultShipStngs').on('click', function(e) {
        e.preventDefault();
        let action_page = $(this).data('actionurl');
        let requestData = '';
        $.ajax
        ({
            url: action_page, 		  /* Url to which the request is send */
            type: "POST",             /* Type of request to be send, called as method */
            enctype: 'multipart/form-data',
            data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
            beforeSend: function() {
                swal({
                    title: "",
                    text: (lang == "en") ? "معالجة..." : "Processing...",
                    imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                    showConfirmButton: false
                });
            },
            success: function(resp){  /* A function to be called if request succeeds */
                respData = JSON.parse(resp);
                if(respData.responseCode == 200){
                    swal({title: "", text: respData.responseMessage, type: "success"},
                        function(){ 
                            window.location.reload();
                        }
                    );
                }else{
                    swal({title: "", text: respData.responseMessage, type: "error"});
                }
            }
        });
    });
});