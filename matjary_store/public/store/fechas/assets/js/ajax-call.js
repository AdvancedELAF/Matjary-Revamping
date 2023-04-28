$(document).ready(function(){

    let base_url = window.location.origin;
    if(base_url == "http://localhost"){
        base_url= '/Matjary-Revamping/matjary_store';        
    }else{
        base_url;
    }
    let lang = $("#languageChange").data('lang');
    let wishlist = 'Wishlist';  
    let RemoveFromWhishlist = 'Remove From Whishlist';  
    let AddToCart = 'Add To Cart';
    let RemoveFromCart = 'Remove From Cart';
    let EditBtn = 'Edit';
    let DeleteBtn = 'Delete';
    let DelivertothisAddress = 'Deliver to this Address';
    let place_order_txt = 'PLACE ORDER';
    let pay_order_txt = 'PAY';
    let order_is_safe = 'Order is safe .';
    let record_is_safe = "Record is safe .";
    let SelectState = "Select State";
    let SelectCity = "Select City";
    let confirm = 'Are you sure You Want to Cancel this Order ?';
    let confirmBtnText = 'Yes, Cancel!';
    let cancelBtnText = 'No, reject please!';
    let Cancelled = 'Cancelled';
        
    if(lang=='en'){
        wishlist = 'قائمة الرغبات';
        RemoveFromWhishlist = 'إزالة من قائمة الرغبات';
        AddToCart = 'أضف إلى السلة';
        RemoveFromCart = 'إزالة من عربة التسوق';
        place_order_txt = 'مكان الامر';
        pay_order_txt = 'دفع';
        EditBtn = 'تعديل';
        DeleteBtn = 'حذف';
        DelivertothisAddress = 'التوصيل لهذا العنوان';
        order_is_safe = 'الطلب آمن.';
        record_is_safe = "السجل آمن.";
        SelectState ="اختر ولايه";
        SelectCity = "اختر مدينة";
        confirm = 'هل أنت متأكد أنك تريد إلغاء هذا الطلب؟';
        confirmBtnText = 'نعم الغاء!';
        cancelBtnText = 'لا ، ارفض من فضلك!';
        Cancelled = 'ألغيت';
    }


    /* =================================Store Front-end js satrt =============================== */

    /* Customer js start */
    $("#save_customer_register_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#save_customer_register_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#save_customer_register_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#save_customer_register_form").attr('action');
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
                    //swal.close();
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_customer_register_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                        //window.location.reload();
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#customer_login_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#customer_login_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#customer_login_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#customer_login_form").attr('action');
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
                    //swal.close();
                    if(respData.responseCode == 200){
                        // swal({title: "", text: respData.responseMessage, type: "success"},
		                //     function(){ 
                        //         $("#customer_login_form")[0].reset();
		                //         window.location.href = respData.redirectUrl;
		                //         //window.location.reload();
		                //     }
		                // );
                        $("#customer_login_form")[0].reset();
                        window.location.href = respData.redirectUrl;
                        //window.location.reload();
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#customer_reset_forgot_pass_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#customer_reset_forgot_pass_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#customer_reset_forgot_pass_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#customer_reset_forgot_pass_form").attr('action');
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
                    //swal.close();
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#customer_reset_forgot_pass_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                        //window.location.reload();
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    
    $("#customer_set_new_password_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#customer_set_new_password_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#customer_set_new_password_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#customer_set_new_password_form").attr('action');
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
                    //swal.close();
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#customer_set_new_password_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                        //window.location.reload();
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#purchase_giftcard_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#purchase_giftcard_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            $('#purchase_giftcard_form')[0].submit();
        }
    }));

    $("#productCartBox").on("click",".addToCart", function() { 
        let _self = $(this); 
        let baseurl = $(this).data('baseurl');
        let removeProductFromCartUrl = baseurl+'/customer/remove-product-cart';
        let actionurl = $(this).data('actionurl');
        let productid = $(this).data('productid');
        let customerid = $(this).data('customerid');
        let locale = $(this).data('lang');
        let requestData = {productid:productid,customerid:customerid};
        $.ajax
        ({
            type: "POST",
            data: requestData,
            url: actionurl,
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
                    $("#cartCount").text(respData.customerCartCount);
                
                    $("#product_"+productid+"_cartBtn").html('<a href="javascript:void(0);" data-baseurl="'+baseurl+'" data-actionurl="'+removeProductFromCartUrl+'" data-productid="'+productid+'" data-customerid="'+customerid+'" data-lang="'+locale+'" class="g-brand-btn removeFromCart">'+RemoveFromCart+'</a>');
                }else{
                    swal({title: "", text: respData.responseMessage, type: "error"});
                }
            }
        });
    });

    $("#productCartBox").on("click",".removeFromCart", function() { 
        let _self = $(this);
        let baseurl = $(this).data('baseurl');
        let addProductFromCartUrl = baseurl+'/customer/add-product-cart';
        let actionurl = $(this).data('actionurl');
        let productid = $(this).data('productid');
        let customerid = $(this).data('customerid');
        let locale = $(this).data('lang');
        let requestData = {productid:productid,customerid:customerid};
        $.ajax
        ({
            type: "POST",
            data: requestData,
            url: actionurl,
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
                    $("#cartCount").text(respData.customerCartCount);
                    
                    $("#product_"+productid+"_cartBtn").html('<a href="javascript:void(0);" data-baseurl="'+baseurl+'" data-actionurl="'+addProductFromCartUrl+'" data-productid="'+productid+'" data-customerid="'+customerid+'" data-lang="'+locale+'" class="g-brand-btn addToCart">'+AddToCart+'</a>');
                }else{
                    swal({title: "", text: respData.responseMessage, type: "error"});
                }
            }
        });
    });

    $("#productCartBox").on("click",".addToWishlist", function() { 
        let _self = $(this); 
        let baseurl = $(this).data('baseurl');
        let removeProductFromWishlistUrl = baseurl+'/customer/remove-product-wishlist';
        let actionurl = $(this).data('actionurl');
        let productid = $(this).data('productid');
        let customerid = $(this).data('customerid');
        
        let requestData = {productid:productid,customerid:customerid};
        $.ajax
        ({
            type: "POST",
            data: requestData,
            url: actionurl,
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
                    $("#product_"+productid+"_whishlistBtn").html('<a href="javascript:void(0);" data-baseurl="'+baseurl+'" data-actionurl="'+removeProductFromWishlistUrl+'" data-productid="'+productid+'" data-customerid="'+customerid+'" class="db-brand-btn removeFromWishlist">'+RemoveFromWhishlist+'</a>');
                }else{
                    swal({title: "", text: respData.responseMessage, type: "error"});
                }
            }
        });
    });

    $("#productCartBox").on("click",".removeFromWishlist", function() { 
        let _self = $(this);
        let baseurl = $(this).data('baseurl');
        let addProductToWishlistUrl = baseurl+'/customer/add-product-wishlist';
        let actionurl = $(this).data('actionurl');
        let productid = $(this).data('productid');
        let customerid = $(this).data('customerid');
        let locale = $(this).data('lang');
        let requestData = {productid:productid,customerid:customerid};
        $.ajax
        ({
            type: "POST",
            data: requestData,
            url: actionurl,
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
                    $("#product_"+productid+"_whishlistBtn").html('<a href="javascript:void(0);" data-baseurl="'+baseurl+'" data-actionurl="'+addProductToWishlistUrl+'" data-productid="'+productid+'" data-customerid="'+customerid+'" data-lang="'+locale+'" class="db-brand-btn addToWishlist">'+wishlist+'</a>');
                }else{
                    swal({title: "", text: respData.responseMessage, type: "error"});
                }
            }
        });
    });

    $("#cancel_reason").change(function(){
        let cancel_reason = $(this).val();       
        if(cancel_reason!=''){
            $("#cancel_reason_error_msg").text('');
            $("#cnfrmCnclBtn").data('cancelreason',cancel_reason);
        }else{
            var reason_of_cancelation = (lang == "en") ? "حدد سبب الإلغاء!" : "Select a Reason Of Cancelation!";
            $("#cancel_reason_error_msg").text(reason_of_cancelation);
            $("#cnfrmCnclBtn").data('cancelreason','Cancel Reason');
        }
    });

    $("#cnfrmCnclBtn").on("click", function (e) {   
        let cancel_reason = $("#cancel_reason").val();
        let other_reason = $('#other_reason').val();       
        if(cancel_reason==''){
            //swal({title: "Fail", text: 'Reason Of Cancelation Should Not Be Empty!', type: "error"});
            var cancelationReason = (lang == "en") ? "حدد سبب الإلغاء!" : "Select a Reason Of Cancelation!";
            $("#cancel_reason_error_msg").text(cancelationReason);
            return false;
        }else if(cancel_reason=='Any Other Reason'){
            if(other_reason==''){
                var cancelationReason = (lang == "en") ? "الرجاء إدخال سبب الإلغاء!" : "Please Enter a Reason Of Cancelation!";
                $("#cancel_reason_error_msgs").text(cancelationReason);
                return false;
            }
        }
        let actionurl = $(this).data('actionurl');
        let orderid = $(this).data('orderid');
        let customerid = $(this).data('customerid');
        let cancelreason = $(this).data('cancelreason');
        let requestData = {orderid:orderid,customerid:customerid,cancelreason:cancelreason,other_reason:other_reason};
           
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
                    data: requestData,
                    url: actionurl,
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
                        //swal.close();
                        if(respData.responseCode == 200){
                            swal({title: "", text: respData.responseMessage, type: "success"},
                                function(){ 
                                    window.location.href = respData.redirectUrl;
                                    //window.location.reload();
                                }
                            );
                        }else{
                            swal({title: "", text: respData.responseMessage, type: "error"});
                        }
                    }
                });
            } else {
                swal(Cancelled, order_is_safe, "error");
            }
        });

        
    });

    $("#saveUpdateBtn").on("click", function (e) {   
        let customer_deliver_address_form = $("#saveUpdateBtn").closest("form[id]").attr('id');
        //alert(customer_deliver_address_form);
        //$("#"+customer_deliver_address_form).submit();
    });

    $("#addEditAddressFormRow").on("submit","#save_customer_deliver_address_form", function(e) {
		e.preventDefault();
        var isvalidate = $("#save_customer_deliver_address_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#save_customer_deliver_address_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#save_customer_deliver_address_form").attr('action');
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
                        text: "Processing..",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function(resp){  /* A function to be called if request succeeds */
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_customer_deliver_address_form")[0].reset();
		                        let isCheckoutPage = respData.isCheckoutPage;
                                let customerAddressList = respData.customerAddressList;
                                //console.log(isCheckoutPage);
                                //console.log(customerAddressList);
                                if(isCheckoutPage==1){
                                    $("#deliveryAddressWrapper").empty('');
                                    $.each(customerAddressList,function(key, value){
                                        //console.log(value);
                                        var lastAddrId = '';
                                        var checked = '';
                                        if(lastAddrId==value.id){
                                            checked = 'checked';
                                        }
                                        var mrml = (lang == "en") ?'ml-2':'mr-2';
                                        var html_content = '<div class="checkout-wrapper">'+
                                            '<p class="delivery-address">'+value.address+' '+value.city_name+' '+value.state_name+' '+value.zipcode+' '+value.country_name+'</p>'+
                                            '<div class="deliver-add-btn">'+
                                                '<a href="javascript:void(0);"><input type="radio" name="customer_address_id" class="cstmrAddrId" value="'+value.id+'" data-error=".error1" '+checked+'> '+DelivertothisAddress+'</a>'+
                                            '</div>'+
                                            '<p class="error1"></p>'+
                                            '<a href="javascript:void(0);" class="g-brand-btn '+mrml+' editMyAddress" data-customerid="'+value.customer_id+'" data-actionurl="'+base_url+'/customer/edit-customer-deliver-address" data-id="'+value.id+'">'+EditBtn+'</a>'+
                                            '<a href="javascript:void(0);" class="g-brand-btn removeMyAddressbtn" id="rempveAddress" data-actionurl="'+base_url+'/customer/delete-customer-deliver-address" data-id="'+value.id+'" data-operation="delete"><i class="dw dw-delete-3"></i> '+DeleteBtn+'</a>'+
                                        '</div>';
                                        $("#deliveryAddressWrapper").append(html_content);
                                    });
                                    //swal.close();
                                }else{
                                    window.location.reload();
                                }
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                        //swal.close();
                    }
                }
            });
        }
    }); 

    $("#addEditAddressFormRow").on("submit","#update_customer_deliver_address_form", function(e) {
        e.preventDefault();
        var isvalidate = $("#update_customer_deliver_address_form").valid();
        if (!isvalidate) {
            return false;
        }else{
            var form = $('#update_customer_deliver_address_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#update_customer_deliver_address_form").attr('action');
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
                                $("#update_customer_deliver_address_form")[0].reset();
                                let isCheckoutPage = respData.isCheckoutPage;
                                let customerAddressList = respData.customerAddressList;
                                //console.log(isCheckoutPage);
                                //console.log(customerAddressList);
                                if(isCheckoutPage==1){
                                    $("#deliveryAddressWrapper").empty('');
                                    $.each(customerAddressList,function(key, value){
                                        //console.log(value);
                                        var lastAddrId = '';
                                        var checked = '';
                                        if(lastAddrId==value.id){
                                            checked = 'checked';
                                        }
                                        var mrml = (lang == "en") ?'ml-2':'mr-2';
                                        var html_content = '<div class="checkout-wrapper">'+
                                            '<p class="delivery-address">'+value.address+' '+value.city_name+' '+value.state_name+' '+value.zipcode+' '+value.country_name+'</p>'+
                                            '<div class="deliver-add-btn">'+
                                                '<a href="javascript:void(0);"><input type="radio" name="customer_address_id" class="cstmrAddrId" value="'+value.id+'" data-error=".error1" '+checked+'> '+DelivertothisAddress+'</a>'+
                                            '</div>'+
                                            '<p class="error1"></p>'+
                                            '<a href="javascript:void(0);" class="g-brand-btn '+mrml+' editMyAddress" data-customerid="'+value.customer_id+'" data-actionurl="'+base_url+'/customer/edit-customer-deliver-address" data-id="'+value.id+'">'+EditBtn+'</a>'+
                                            '<a href="javascript:void(0);" class="g-brand-btn removeMyAddressbtn" id="rempveAddress" data-actionurl="'+base_url+'/customer/delete-customer-deliver-address" data-id="'+value.id+'" data-operation="delete"><i class="dw dw-delete-3"></i> '+DeleteBtn+'</a>'+
                                        '</div>';
                                        $("#deliveryAddressWrapper").append(html_content);
                                    });
                                    //swal.close();
                                }else{
                                    window.location.reload();
                                }
                            }
                        );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    });
    
    $("#deliveryAddressWrapper").on('click', '.removeMyAddressbtn', function (e) {        
        e.preventDefault();    
        let _self = $(this);
        let baseurl = $(this).data('baseurl');
        let action_page = $(this).data('actionurl');
        let id = $(this).data('id');  
        let requestData = 'id='+id;            
        swal({
            title: (lang == "en") ? "هل أنت متأكد من إزالة هذا العنوان؟" : "Are you sure about to remove this Address ?",
            text: (lang == "en") ?"عنوانك سيزيل":"Your Address will remove",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: (lang == "en") ?"نعم ، قم بإزالة!":"Yes, remove !",
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
            } else {
                swal(Cancelled, record_is_safe, "error");
            }
        });

    });

    //$('.editMyAddress').click(function(e) { 
    $("#deliveryAddressWrapper").on('click', '.editMyAddress', function (e) {
        e.preventDefault();
        let addressid = $(this).data('id');
        let customerid = $(this).data('customerid');
        let language = $("#lang").val();
        var action_page = $(this).data('actionurl');
        let server_site_path = $("#server_site_path").val();
        let requestData = 'addressid='+addressid+'&customerid='+customerid;
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
                    let addressData = respData.addressData;
                    let stateList = respData.stateList;
                    let cityList = respData.cityList;
                    if(language == 'en'){
                        $("#address_heading").text("Edit Address");
                    }else{
                        $("#address_heading").text("تعديل العنوان");    
                    }
                    $("#address_id").val(addressData.id);
                    $("#addEditAddressFormRow").find('.customer_address_form').attr("name","update_customer_deliver_address_form");
                    $("#addEditAddressFormRow").find('.customer_address_form').attr("id","update_customer_deliver_address_form");
                    $("#addEditAddressFormRow").find('.customer_address_form').attr("action",server_site_path+"/customer/update-customer-deliver-address");
                    $("#address").val(addressData.address);

                    $('#country_id option[value='+addressData.country_id+']').prop('selected', true);
                    $.each(stateList,function(stateKey, stateValues){
                        $("#state_id").append('<option value=' + stateValues.id + '>' + stateValues.name + '</option>');
                    });
                    //$('#state_id option').eq(parseInt(addressData.state_id)).prop('selected', true);
                    $('#state_id option[value='+addressData.state_id+']').prop('selected', true);
                    $.each(cityList,function(cityKey, cityValues){
                        $("select#city_id").append('<option value=' + cityValues.id + '>' + cityValues.name + '</option>');
                    });
                    $('#city_id option[value='+addressData.city_id+']').prop('selected', true);

                    $("#zipcode").val(addressData.zipcode);
                    if(language == 'en'){
                        $("#saveUpdateBtn").text('Update');         
                    }else{
                        $("#saveUpdateBtn").text('تحديث');
                    }
                    
                }else{
                    swal({title: "", text: respData.responseMessage, type: "error"});
                }
            }
        });
    });

    $('#resetMyAddressFormBtn').click(function(e) {
        e.preventDefault();
        let server_site_path = $("#server_site_path").val();
        let language = $("#lang").val();
        if(language == 'en'){
            $("#address_heading").text("Add New Address");
        }else{
            $("#address_heading").text("أضف عنوان جديد");    
        }
        $("#address_id").val('');
        $("#addEditAddressFormRow").find('.customer_address_form').attr("name","save_customer_deliver_address_form");
        $("#addEditAddressFormRow").find('.customer_address_form').attr("id","save_customer_deliver_address_form");
        $("#addEditAddressFormRow").find('.customer_address_form').attr("action",server_site_path+"/customer/save-customer-deliver-address");
        if(language == 'en'){
            $("#saveUpdateBtn").text('Save');          
        }else{
            $("#saveUpdateBtn").text('يحفظ');
        }
        $("#save_customer_deliver_address_form")[0].reset();
    });

    $('#applyGCCodeBtn').click(function(e) {
        e.preventDefault();
        let gc_code = $("#giftcard_code").val();
        if(gc_code=='' || gc_code==undefined || gc_code==null){
            // $("#preloader").hide();
            // swal({title: "Fail", text: "Gift Card Code Should not be empty.", type: "error"});
            var gccodenotbeempty = (lang == "en") ? "يجب ألا يكون رمز بطاقة الهدايا فارغًا." : "Gift Card Code Should Not Be Empty.";
            $("#giftcard_code_applied_span").text(gccodenotbeempty);
            $("#giftcard_code_applied_span").addClass('text-danger');
            $("#is_giftcard_applied").val('');
            $("#giftcard_id").val('');
            $("#giftcard_prchsed_id").val('');
            $("#giftcard_amount").val('');
            return false;
        }
        let customerid = $(this).data('customerid');
        let totalprice = $(this).data('totalprice');
        let action_page = $(this).data('actionurl');
        let requestData = 'gc_code='+gc_code+'&customerid='+customerid+'&totalprice='+totalprice;
        $.ajax
        ({
            url: action_page, 		  /* Url to which the request is send */
            type: "POST",             /* Type of request to be send, called as method */
            enctype: 'multipart/form-data',
            data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
            // beforeSend: function() {
            //     $("#preloader").show();
            // },
            success: function(resp){  /* A function to be called if request succeeds */
                let respData = JSON.parse(resp);
                //console.log(respData);
                if(respData.responseCode == 200){
                    //$("#preloader").hide();
                    $("#giftcard_code_applied_span").text(respData.responseMessage);
                    $("#giftcard_code_applied_span").removeClass('text-danger');
                    $("#giftcard_code_applied_span").addClass('text-success');
                    let gcData = respData.responseData;
                    //console.log(gcData);
                    $("#is_giftcard_applied").val(1);
                    $("#giftcard_id").val(gcData.id);
                    $("#giftcard_prchsed_id").val(gcData.giftcard_prchsed_id);
                    $("#giftcard_amount").val(totalprice);
                }else{
                    //$("#preloader").hide();
                    $("#giftcard_code_applied_span").text(respData.responseMessage);
                    $("#giftcard_code_applied_span").addClass('text-danger');
                    //swal({title: "Fail", text: respData.responseMessage, type: "error"});
                    $("#is_giftcard_applied").val('');
                    $("#giftcard_id").val('');
                    $("#giftcard_prchsed_id").val('');
                    $("#giftcard_amount").val('');
                }
            }
        });
        
    });
    
    $('#proceedToCheckoutBtn').click(function(e) {
        e.preventDefault();
        var index_length = $('input[name="index[]"]:checked').length;
        if(index_length == 0){
            swal({title: "", text: (lang == "en") ? "يرجى تحديد عنصر عربة التسوق مرة على الأقل  للمغادرة." :'Please Select Atleast One Cart Item To Checkout.', type: "error"});
            return false;
        }else{
            $("#proceed_cart_form").submit();
        }
    });

    $("#proceed_checkout_btn").click(function(e) {
		e.preventDefault();
        var isvalidate = $("#proceed_checkout_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            
            if($("#customer_id").val()==''){
                swal({title: "", text: (lang == "en") ?"يجب ألا يكون الرقم التعريفي للعميل فارغًا.":'Customer ID Should not be Empty.', type: "error"});
            }else if($("#subtotal").val()==''){
                swal({title: "", text: (lang == "en") ?"يجب ألا يكون المجموع الفرعي فارغًا.":'Subtotal Should not be Empty.', type: "error"});
            }else if($("#total_price").val()==''){
                swal({title: "", text: (lang == "en") ?"يجب ألا يكون السعر الإجمالي فارغًا.":'Total Price Should not be Empty.', type: "error"});
            }else if($("#ship_cmp_id").val()==''){
                swal({title: "", text: (lang == "en") ?"يجب ألا يكون رقم تعريف شركة الشحن فارغًا.":'Shipping Company ID Should not be Empty.', type: "error"});
            }else if ($('.cstmrAddrId').is(':checked')){
                $("#proceed_checkout_form")[0].submit(); 
            }else{
                swal({title: "", text: (lang == "en") ?"يجب ألا يكون عنوان تسليم المنتج فارغًا.":'Product Delivery Address Should not be Empty.', type: "error"});
            }
        }
    });

    $(".cartItem").change(function(e){      /* In Cart checkbox check uncheck function*/   
        e.preventDefault();      
        $(".cartItem").each(function() { 
            if (!$(this).is(':checked')) {
                $('#chk_all_cart_items').prop('checked', false);
            }else{
                $('#chk_all_cart_items').prop('checked', true);
            }
        });
    });

    $("#chk_all_cart_items").change(function(e){
        e.preventDefault();
        $('.cartItem').not(this).prop('checked', this.checked);
        let subtotal = 0;
        if(this.checked) {
            $(".cartItemsTr .product_qty").each(function() {
                let cartItemChk = $(this).closest(".cartItemsTr").find(".cartItem").val();
                if(cartItemChk=='' || cartItemChk==undefined || cartItemChk==null){
                }else{
                    let product_qty_val = $(this).val();
                    let productid = $(this).data('productid');

                    let product_og_price = $(this).closest(".cartItemsTr").find("#product_price_"+productid).val();
                    let qty_product_price = parseFloat(product_og_price) * product_qty_val;
                    $("#new_product_price_"+productid).val(qty_product_price.toFixed(2));
                    $("#product_price_"+productid+"_span").text(qty_product_price.toFixed(2));

                    let sales_og_tax = $(this).closest(".cartItemsTr").find("#sales_tax_"+productid).val();
                    let qty_sales_tax = parseFloat(sales_og_tax) * product_qty_val;
                    $("#new_sales_tax_"+productid).val(qty_sales_tax.toFixed(2));
                    $("#sales_tax_"+productid+"_span").text(qty_sales_tax.toFixed(2));

                    let product_weight = $(this).closest(".cartItemsTr").find("#product_weight_"+productid).val();
                    let qty_weight = parseFloat(product_weight) * product_qty_val;
                    $("#new_product_weight_"+productid).val(qty_weight.toFixed(2));

                    subtotal += parseFloat(qty_product_price) + parseFloat(qty_sales_tax);

                }                
                
            });

        }else{

          
            let subtotal = $("#subtotal").val();
            $("#coupon_code").val('');

            $("#coupon_applied_tr").hide();
            $("#promotion_applied_amount_span").text('');
            $("#discount_type").val('');
            $("#discount_value").val('');
            $("#total_price").val(subtotal); 
            $("#total_price_span").text(subtotal);   
            $("#is_coupon_applied").val('');
            $("#coupon_id").val('');
            $("#coupon_amount").val('');
            $("#couponCodeMsg").text('');
            
        }

        $("#subtotal_span").text(subtotal.toFixed(2));
        $("#subtotal").val(subtotal.toFixed(2));

        // let coupon_amount = $("#coupon_amount").val();
        // if(coupon_amount=='' || coupon_amount==undefined || coupon_amount==null){
        //     coupon_amount = parseFloat(subtotal);
        // }else{
        //     coupon_amount = parseFloat(subtotal) - parseFloat(coupon_amount);
        // }
        let total_price = 0;
        let coupon_amount = $("#coupon_amount").val();
        if(coupon_amount=='' || coupon_amount==undefined || coupon_amount==null){
            total_price = parseFloat(subtotal);
            
        }else{
            //coupon_amount = parseFloat(subtotal) - parseFloat(coupon_amount);
            var discount_type = $("#discount_type").val();
            var discount_value = $("#discount_value").val();
            if(discount_type==1){
                let dscntPerValue = (parseFloat(subtotal) * parseInt(discount_value)) / 100;
                $('#coupon_amount').val(dscntPerValue.toFixed(2));
                $("#promotion_applied_amount_span").text(dscntPerValue.toFixed(2));
                let dscntTotalPrice = parseFloat(subtotal) - parseFloat(dscntPerValue);
                total_price = dscntTotalPrice;
            }else if(discount_type==2){
                $('#coupon_amount').val(discount_value);
                $("#promotion_applied_amount_span").text(dscntPerValue+'.00');
                let dscntTotalPrice = parseInt(subtotal) - parseInt(discount_value);
                total_price = dscntTotalPrice;
            }
            
        }

        $("#total_price_span").text(total_price.toFixed(2));
        $("#total_price").val(total_price.toFixed(2));
    });

    $(".cartItem").change(function(e){
        e.preventDefault();
        let productid = $(this).data('productid');
        let product_qty = $(this).closest(".cartItemsTr").find(".product_qty").val();
        let subtotal = 0;
        let subtotal_add_amount = 0;
        let subtotal_minus_amount = 0;
        if(this.checked) {
            let product_og_price = $(this).closest(".cartItemsTr").find("#product_price_"+productid).val();
            let qty_product_price = parseFloat(product_og_price) * product_qty;
            $("#new_product_price_"+productid).val(qty_product_price.toFixed(2));
            $("#product_price_"+productid+"_span").text(qty_product_price.toFixed(2));

            let sales_og_tax = $(this).closest(".cartItemsTr").find("#sales_tax_"+productid).val();
            let qty_sales_tax = parseFloat(sales_og_tax) * product_qty;
            $("#new_sales_tax_"+productid).val(qty_sales_tax.toFixed(2));
            $("#sales_tax_"+productid+"_span").text(qty_sales_tax.toFixed(2));

            let product_weight = $(this).closest(".cartItemsTr").find("#product_weight_"+productid).val();
            let qty_weight = parseFloat(product_weight) * product_qty;
            $("#new_product_weight_"+productid).val(qty_weight.toFixed(2));

            subtotal_add_amount = parseFloat(qty_product_price) + parseFloat(qty_sales_tax);            
            let current_subtotal = $("#subtotal").val();
            subtotal = parseFloat(current_subtotal) + parseFloat(subtotal_add_amount);
            
        }else{
            let product_og_price = $(this).closest(".cartItemsTr").find("#product_price_"+productid).val();
            let qty_product_price = parseFloat(product_og_price) * product_qty;
            $("#new_product_price_"+productid).val(qty_product_price.toFixed(2));
            $("#product_price_"+productid+"_span").text(qty_product_price.toFixed(2));

            let sales_og_tax = $(this).closest(".cartItemsTr").find("#sales_tax_"+productid).val();
            let qty_sales_tax = parseFloat(sales_og_tax) * product_qty;
            $("#new_sales_tax_"+productid).val(qty_sales_tax.toFixed(2));
            $("#sales_tax_"+productid+"_span").text(qty_sales_tax.toFixed(2));

            let product_weight = $(this).closest(".cartItemsTr").find("#product_weight_"+productid).val();
            let qty_weight = parseFloat(product_weight) * product_qty;
            $("#new_product_weight_"+productid).val(qty_weight.toFixed(2));

            subtotal_minus_amount = parseFloat(qty_product_price) + parseFloat(qty_sales_tax);  
                     
            let current_subtotal = $("#subtotal").val();
            if(current_subtotal>subtotal_minus_amount){
                subtotal = parseFloat(current_subtotal) - parseFloat(subtotal_minus_amount);
            }else{
                subtotal = 0;
            }
            
        }

        $("#subtotal_span").text(subtotal.toFixed(2));
        $("#subtotal").val(subtotal.toFixed(2));
                
        let total_price = 0;
        let coupon_amount = $("#coupon_amount").val();
        if(coupon_amount=='' || coupon_amount==undefined || coupon_amount==null){
            total_price = parseFloat(subtotal);
            
        }else{

            let discount_type = $("#discount_type").val();
            let discount_value = $("#discount_value").val();
            if(discount_type==1){
                let dscntPerValue = (parseFloat(subtotal) * parseInt(discount_value)) / 100;
                $('#coupon_amount').val(dscntPerValue.toFixed(2));
                $("#promotion_applied_amount_span").text(dscntPerValue.toFixed(2));
                var dscntTotalPrice = parseFloat(subtotal) - parseFloat(dscntPerValue);
                total_price = dscntTotalPrice;
            }else if(discount_type==2){
                $('#coupon_amount').val(discount_value);
                $("#promotion_applied_amount_span").text(discount_value+'.00');
                var dscntTotalPrice = parseInt(subtotal) - parseInt(discount_value);
                total_price = dscntTotalPrice;
            }
            
        }

        $("#total_price_span").text(total_price.toFixed(2));
        $("#total_price").val(total_price.toFixed(2));
        
        
    });

    $("#proceed_payment_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#proceed_payment_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#proceed_payment_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#proceed_payment_form").attr('action');
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
                    //swal.close();
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"});
                        window.location.href = respData.redirectUrl;
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#buyProductBtn").click(function(e){
        e.preventDefault();
        let action_page = $(this).data('actionurl');
        let customerid = $(this).data('customerid');
        let productid = $(this).data('productid');
        let requestData = 'customerid='+customerid+'&productid='+productid;
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
                //swal.close();
                if(respData.responseCode == 200){
                    window.location.href = respData.redirectUrl;
                }else{
                    swal({title: "", text: respData.responseMessage, type: "error"});
                }
            }
        });
    });
    
    $('#couponCodeApplyBtn').click(function() {
        
        let selft = $(this);
        //let base_url = $("#base_url").val();
        let coupon_code = $("#coupon_code").val();
        let customerid = $(this).data('customerid');
        let total_price = $("#total_price_span").text();
        //console.log(total_price);
        var action_page 		= $(this).data('actionurl');
        if(coupon_code=='' || coupon_code==undefined || coupon_code==null){
            
            $("#couponCodeMsg").text((lang == "en") ?'كود القسيمة مطلوب.':'Coupon code is required.');
            $("#couponCodeMsg").css('color','red');
            $("#coupon_applied_tr").hide();
            $("#promotion_applied_amount_span").text('');
            $("#discount_type").val();
            $("#discount_value").val();
            let subtotal = $("#subtotal").val();
            $("#total_price").val(subtotal);
            $("#total_price_span").text(subtotal);   

            $("#is_coupon_applied").val('');
            $("#coupon_id").val('');
            $("#coupon_amount").val('');
            
            return false;
        }else{
            if(total_price=='' || total_price==undefined || total_price==null || total_price=='0.00'){
                swal({title: "", text: (lang == "en") ?"يرجى تحديد عنصر عربة التسوق Atleast One للمتابعة.":"Please Select Atleast One Cart Item To Proceed.", type: "error"});
                return false;
            }else{
                var requestData = 'coupon_code='+coupon_code+'&customer_id='+customerid+'&total_price='+total_price;
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
                        swal.close();
                        if(respData.responseCode == 200){
                            //$("#preloader").hide();
                            $("#couponCodeMsg").empty('');
                            
                            $("#couponCodeMsg").text(respData.responseMessage);
                            $("#couponCodeMsg").css('color','green');
                            console.log(respData.responseData);
                            let couponInfo = respData.responseData;
                            let subtotal = $("#subtotal").val();
                            let discount_value = couponInfo.discount_value;
                            let dscntTotalPrice = 0;
                            let disApldAmnt = 0;
                            if(couponInfo.discount_type==1){
                                let dscntPerValue = (parseFloat(subtotal) * parseInt(discount_value)) / 100;
                                dscntTotalPrice = parseFloat(subtotal) - parseFloat(dscntPerValue);
                                disApldAmnt = dscntPerValue;
                            }else if(couponInfo.discount_type==2){
                                dscntTotalPrice = parseInt(subtotal) - parseInt(discount_value);
                                disApldAmnt = discount_value;
                            }
                            $("#total_price").val(dscntTotalPrice.toFixed(2));
                            $("#total_price_span").text(dscntTotalPrice.toFixed(2));
                            $("#coupon_applied_tr").show();
                            $("#promotion_applied_amount_span").text(disApldAmnt);
                            $("#discount_type").val(couponInfo.discount_type);
                            $("#discount_value").val(couponInfo.discount_value);
                            $("#is_coupon_applied").val(1);
                            $("#coupon_id").val(couponInfo.id);
                            $("#coupon_amount").val(disApldAmnt);
                        }else{
                            //$("#preloader").hide();
                            
                            $("#couponCodeMsg").empty('');
                            $("#coupon_applied_tr").hide();
                            $("#promotion_applied_amount_span").text('');
                            $("#discount_type").val();
                            $("#discount_value").val();
                            $("#couponCodeMsg").text(respData.responseMessage);
                            $("#couponCodeMsg").css('color','red');

                            let subtotal = $("#subtotal").val();
                            $("#total_price").val(subtotal);
                            $("#total_price_span").text(subtotal);   

                            $("#is_coupon_applied").val('');
                            $("#coupon_id").val('');
                            $("#coupon_amount").val('');
                        }
                    }
                });
            }
        }
    });

    $('#emptyCart').click(function(e) {  
        e.preventDefault();

        let customerid = $(this).data('customerid');
        var action_page = $(this).data('actionurl');
        let requestData = 'customerid='+customerid;
        swal({
            title: (lang == "en") ?"هل أنت متأكد من السلة الفارغة؟":"Are you sure about the empty cart?",
            text: (lang == "en") ?"عربة التسوق الخاصة بك سوف تفرغ":"Your Cart will Empty",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: (lang == "en") ?"نعم فارغ!":"Yes, Empty !",
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
                        //swal.close();
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
            } else {
                swal(Cancelled, record_is_safe, "error");
            }
        });
    });

    $("tbody#cartItemsTbody").on("click","#rempveSnglProdFromCart", function(e) { 
        e.preventDefault();

        let _self = $(this);
        let baseurl = $(this).data('baseurl');
        let action_page = $(this).data('actionurl');
        let productid = $(this).data('productid');
        let customerid = $(this).data('customerid');
        let requestData = 'productid='+productid+'&customerid='+customerid;
        
        swal({
            title: (lang == "en") ?"هل أنت متأكد من إزالة هذا المنتج من سلة التسوق الخاصة بك؟":"Are you sure about to remove this product from your cart ?",
            text: (lang == "en") ?"سيتم إزالة المنتج الخاص بك":"Your Product will remove",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: (lang == "en") ?"نعم ، قم بإزالة!":"Yes, remove !",
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
            } else {
                swal(Cancelled, record_is_safe, "error");
            }
        });

    });

    $('.paymentMethod').click(function() {  
        let paymentMethod = $(this).val();
        let locale = $("#locale").val();
        if(paymentMethod==1){ 
            $("#payment_gateway_div").hide();
            $("#gift_cart_payment_div").hide();

            $("#payment_gateway").prop("selected",false);
            $("#giftcard_code").val('');
            $("#is_giftcard_applied").val('');
            $("#giftcard_id").val('');
            $("#giftcard_prchsed_id").val('');
            $("#giftcard_amount").val('');

            $("#payBtn").text(place_order_txt);
        }else if(paymentMethod==2){ 
            $("#payment_gateway_div").show();
            $("#gift_cart_payment_div").hide();

            $("#giftcard_code").val('');
            $("#is_giftcard_applied").val('');
            $("#giftcard_id").val('');
            $("#giftcard_prchsed_id").val('');
            $("#giftcard_amount").val('');

            $("#payBtn").text(pay_order_txt);
        }else if(paymentMethod==3){ 
            $("#payment_gateway_div").hide();
            $("#gift_cart_payment_div").show();

            $("#payment_gateway").prop("selected",false);

            $("#payBtn").text(pay_order_txt);
        }else{
            $("#payment_gateway_div").hide();
            $("#gift_cart_payment_div").hide();

            $("#payment_gateway").prop("selected",false);
            $("#giftcard_code").val('');

            $("#payBtn").text(place_order_txt);
        }
    });

    $('.product_qty').change(function(e) { 
        e.preventDefault();
        let self = $(this);
        let product_qty = $(this).val();
        //alert(product_qty);
        if(product_qty==0){
            $(this).val(1);
            swal({title: "", text: (lang == "en") ?"مطلوب كمية واحدة على الأقل.":'Minimum One Quantity is Required.', type: "error"});
            return false;
        }else if (/^[0-9]{1,3}$/.test(product_qty)) { 

            let prodId = $(this).data('productid');
            //console.log(prodId);

            let action_page = $(this).data('actionurl');
            //console.log(action_page);
            let requestData = 'prodId='+prodId;
            $.ajax
            ({
                url: action_page, 		  /* Url to which the request is send */
                type: "POST",             /* Type of request to be send, called as method */
                enctype: 'multipart/form-data',
                data: requestData, 		  /* Data sent to server, a set of key/value pairs (i.e. form fields and values) */
                // beforeSend: function() {
                //     $("#preloader").show();
                // },
                success: function(resp){  /* A function to be called if request succeeds */
                    let respData = JSON.parse(resp);
                    //console.log(respData);
                    //console.log(respData.responseData.productDetails.order_limit_quantity);
                    if(parseInt(product_qty) > parseInt(respData.responseData.productDetails.order_limit_quantity)){
                        //let qty = product_qty-1;
                        $(self).val(1);

                        let subtotal = 0;
                        let taxtotal = 0;
                        $(".cartItemsTr .product_qty").each(function() {
                            let product_qty_val = $(this).val();
                            let productid = $(this).data('productid');
                            if($(this).closest(".cartItemsTr").find(".cartItem").prop('checked')){
                                //alert('checked');
                                let product_og_price = $(this).closest(".cartItemsTr").find("#product_price_"+productid).val();
                                let qty_product_price = parseFloat(product_og_price) * product_qty_val;
                                $("#new_product_price_"+productid).val(qty_product_price.toFixed(2));
                                $("#product_price_"+productid+"_span").text(qty_product_price.toFixed(2));

                                let sales_og_tax = $(this).closest(".cartItemsTr").find("#sales_tax_"+productid).val();
                                let qty_sales_tax = parseFloat(sales_og_tax) * product_qty_val;
                                $("#new_sales_tax_"+productid).val(qty_sales_tax.toFixed(2));
                                $("#sales_tax_"+productid+"_span").text(qty_sales_tax.toFixed(2));

                                let product_og_weight = $(this).closest(".cartItemsTr").find("#product_weight_"+productid).val();
                                let qty_weight = parseFloat(product_og_weight) * product_qty_val;
                                $("#new_product_weight_"+productid).val(qty_weight.toFixed(2));

                                subtotal += parseFloat(qty_product_price) + parseFloat(qty_sales_tax);
                                $("#subtotal_span").text(subtotal.toFixed(2));
                                $("#subtotal").val(subtotal.toFixed(2));
                               
                                taxtotal += parseFloat(qty_sales_tax);
                                $("#sales_taxs_span").text(taxtotal.toFixed(2));

                                // let coupon_code = $("#coupon_code").val();
                                // alert(coupon_code);



                            }else{
                                //alert('not checked');
                                let product_og_price = $(this).closest(".cartItemsTr").find("#product_price_"+productid).val();
                                let qty_product_price = parseFloat(product_og_price) * product_qty_val;
                                $("#new_product_price_"+productid).val(qty_product_price.toFixed(2));
                                $("#product_price_"+productid+"_span").text(qty_product_price.toFixed(2));

                                let sales_og_tax = $(this).closest(".cartItemsTr").find("#sales_tax_"+productid).val();
                                let qty_sales_tax = parseFloat(sales_og_tax) * product_qty_val;
                                $("#new_sales_tax_"+productid).val(qty_sales_tax.toFixed(2));
                                $("#sales_tax_"+productid+"_span").text(qty_sales_tax.toFixed(2));

                                let product_og_weight = $(this).closest(".cartItemsTr").find("#product_weight_"+productid).val();
                                let qty_weight = parseFloat(product_og_weight) * product_qty_val;
                                $("#new_product_weight_"+productid).val(qty_weight.toFixed(2));

                                subtotal += 0;
                                //totaltax += 0;
                               
                            }
                        });

                        let total_price = '';
                        let coupon_amount = $("#coupon_amount").val();
                        if(coupon_amount=='' || coupon_amount==undefined || coupon_amount==null){
                            total_price = parseFloat(subtotal);
                        }else{
                            
                            //coupon_amount = parseFloat(subtotal) - parseFloat(coupon_amount);

                            var discount_type = $("#discount_type").val();
                            var discount_value = $("#discount_value").val();
                            if(discount_type==1){
                                let dscntPerValue = (parseFloat(subtotal) * parseInt(discount_value)) / 100;
                                $('#coupon_amount').val(dscntPerValue);
                                $("#promotion_applied_amount_span").text(dscntPerValue);
                                dscntTotalPrice = parseFloat(subtotal) - parseFloat(dscntPerValue);
                                total_price = dscntTotalPrice;
                            }else if(discount_type==2){
                                $('#coupon_amount').val(discount_value);
                                $("#promotion_applied_amount_span").text(dscntPerValue);
                                dscntTotalPrice = parseInt(subtotal) - parseInt(discount_value);
                                total_price = dscntTotalPrice;
                            }
                        }
                        
                        $("#total_price_span").text(total_price.toFixed(2));
                        $("#total_price").val(total_price.toFixed(2));
                        
                        swal({title: "", text: (lang == "en") ?"المنتج له حد "+respData.responseData.productDetails.order_limit_quantity+" وحدات لكل طلب / عميل.":'The Product has a limit of '+respData.responseData.productDetails.order_limit_quantity+' Units per order/customer.', type: ""});
                        return false;
                    }else{
                        
                        let subtotal = 0;
                        let taxtotal = 0;
                        $(".cartItemsTr .product_qty").each(function() {
                            
                            let product_qty_val = $(this).val();
                            let productid = $(this).data('productid');
                            if($(this).closest(".cartItemsTr").find(".cartItem").prop('checked')){
                                //alert('checked');
                                let product_og_price = $(this).closest(".cartItemsTr").find("#product_price_"+productid).val();
                                let qty_product_price = parseFloat(product_og_price) * product_qty_val;
                                $("#new_product_price_"+productid).val(qty_product_price.toFixed(2));
                                $("#product_price_"+productid+"_span").text(qty_product_price.toFixed(2));

                                let sales_og_tax = $(this).closest(".cartItemsTr").find("#sales_tax_"+productid).val();
                                let qty_sales_tax = parseFloat(sales_og_tax) * product_qty_val;
                                $("#new_sales_tax_"+productid).val(qty_sales_tax.toFixed(2));
                                $("#sales_tax_"+productid+"_span").text(qty_sales_tax.toFixed(2));

                                let product_og_weight = $(this).closest(".cartItemsTr").find("#product_weight_"+productid).val();
                                let qty_weight = parseFloat(product_og_weight) * product_qty_val;
                                $("#new_product_weight_"+productid).val(qty_weight.toFixed(2));

                                subtotal += parseFloat(qty_product_price) + parseFloat(qty_sales_tax);
                                $("#subtotal_span").text(subtotal.toFixed(2));
                                $("#subtotal").val(subtotal.toFixed(2));
                              
                                taxtotal += parseFloat(qty_sales_tax);
                                $("#sales_taxs_span").text(taxtotal.toFixed(2));

                                // let coupon_code = $("#coupon_code").val();
                                // alert(coupon_code);



                            }else{
                                //alert('not checked');

                                let product_og_price = $(this).closest(".cartItemsTr").find("#product_price_"+productid).val();
                                let qty_product_price = parseFloat(product_og_price) * product_qty_val;
                                $("#new_product_price_"+productid).val(qty_product_price.toFixed(2));
                                $("#product_price_"+productid+"_span").text(qty_product_price.toFixed(2));

                                let sales_og_tax = $(this).closest(".cartItemsTr").find("#sales_tax_"+productid).val();
                                let qty_sales_tax = parseFloat(sales_og_tax) * product_qty_val;
                                $("#new_sales_tax_"+productid).val(qty_sales_tax.toFixed(2));
                                $("#sales_tax_"+productid+"_span").text(qty_sales_tax.toFixed(2));

                                let product_og_weight = $(this).closest(".cartItemsTr").find("#product_weight_"+productid).val();
                                let qty_weight = parseFloat(product_og_weight) * product_qty_val;
                                $("#new_product_weight_"+productid).val(qty_weight.toFixed(2));

                                subtotal += 0;
                                //totaltax += 0;
                               
                            }
                        });

                        let total_price = '';
                        let coupon_amount = $("#coupon_amount").val();
                        if(coupon_amount=='' || coupon_amount==undefined || coupon_amount==null){
                            total_price = parseFloat(subtotal);
                        }else{
                            
                            //coupon_amount = parseFloat(subtotal) - parseFloat(coupon_amount);

                            var discount_type = $("#discount_type").val();
                            var discount_value = $("#discount_value").val();
                            if(discount_type==1){
                                let dscntPerValue = (parseFloat(subtotal) * parseInt(discount_value)) / 100;
                                $('#coupon_amount').val(dscntPerValue);
                                $("#promotion_applied_amount_span").text(dscntPerValue);
                                dscntTotalPrice = parseFloat(subtotal) - parseFloat(dscntPerValue);
                                total_price = dscntTotalPrice;
                            }else if(discount_type==2){
                                $('#coupon_amount').val(discount_value);
                                $("#promotion_applied_amount_span").text(dscntPerValue);
                                dscntTotalPrice = parseInt(subtotal) - parseInt(discount_value);
                                total_price = dscntTotalPrice;
                            }
                        }
                        
                        $("#total_price_span").text(total_price.toFixed(2));
                        $("#total_price").val(total_price.toFixed(2));
                    }
                    
                }
            });

        }else{
            alert((lang == "en") ?"يسمح بحد أقصى 3 أرقام!":'Max 3 digits are allowed!'); // you can write your own logic to warn users 
            //showErrorMessage(classNameOfField);
            return false;
        }

    });

    $('#coupon_code').change(function(e) { 
        e.preventDefault();
        let coupon_code = $(this).val();
        let subtotal = $("#subtotal").val();
        if(coupon_code=='' || coupon_code==undefined || coupon_code==null){
            $("#coupon_applied_tr").hide();
            $("#promotion_applied_amount_span").text('');
            $("#discount_type").val('');
            $("#discount_value").val('');
            $("#total_price").val(subtotal);
            $("#total_price_span").text(subtotal);   
            $("#is_coupon_applied").val('');
            $("#coupon_id").val('');
            $("#coupon_amount").val('');
            $("#couponCodeMsg").text('');
        }
    });

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
                    $("#state_id").append('<option value="">'+SelectState+'</option>');
                    let stateList = respData.responseData;
                    $.each(stateList,function(key, value){
                        $("#state_id").append('<option value=' + value.id + '>' + value.name + '</option>');
                    });
                }else{
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
                    $("#city_id").append('<option value="">'+SelectCity+'</option>');
                    let stateList = respData.responseData;
                    $.each(stateList,function(key, value){
                        $("#city_id").append('<option value=' + value.id + '>' + value.name + '</option>');
                    });
                }else{
                    swal({title: "", text: respData.responseMessage, type: "error"});
                }
            }
        });
    });

    $('#gc_amount').keyup(function(e) { 
        e.preventDefault();
        let gc_amount = $(this).val();
        $("#gcAmountErrMsg").text('');
        if(gc_amount >= 100){
            if (gc_amount % 50 === 0) { 
                /* we are even */ 
                $("#buyGiftCardSbmtBtn").attr("disabled",false);
            }else { 
                /* we are odd */ 
                $("#gcAmountErrMsg").text((lang == "en") ?"يقبل مبلغ بطاقة الهدايا أكثر من 100 ريال سعودي ، 50 ريال سعودي.":'Gift card amount accept multiple SAR 100, 50.');
                $("#gcAmountErrMsg").css('color','red');
                $("#buyGiftCardSbmtBtn").attr("disabled",true);
            }
        }else{
            $("#gcAmountErrMsg").text((lang == "en") ?"يجب أن يكون مبلغ بطاقة الهدايا أكبر من 100 ريال سعودي.":'Gift card amount should be greater than SAR 100.');
            $("#gcAmountErrMsg").css('color','red');
            $("#buyGiftCardSbmtBtn").attr("disabled",true);
            return false;
        }
    });

    /* Customer js end */

    /* My Profile js start */
    $("#update_my_profile_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#update_my_profile_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_my_profile_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#update_my_profile_form").attr('action');
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
                    //swal.close();
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        $("#preloader").hide();
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_my_profile_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                        //window.location.reload();
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
    /* My Profile js end */

     /* Change password js start */
    $("#update_change_password_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#update_change_password_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#update_change_password_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#update_change_password_form").attr('action');
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
                    //swal.close();
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_change_password_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                        //window.location.reload();
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

     /* Change password js start End */

     /* Product Feedback js start */
    $("#save_feedback_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#save_feedback_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#save_feedback_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#save_feedback_form").attr('action');
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
                    //swal.close();
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_feedback_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                        //window.location.reload();
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    
     /* Product Feedback js start End */

     /* Gift Cards js start */
    $("#gift_card_save_feedback_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#gift_card_save_feedback_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#gift_card_save_feedback_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#gift_card_save_feedback_form").attr('action');
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
                    //swal.close();
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#gift_card_save_feedback_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                        //window.location.reload();
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    
     /* Gift Cards Feedback js start End */ 

     /* Contact Us js start */
    $("#save_contactus_form").on('submit',(function(e) {
		e.preventDefault();
        var isvalidate = $("#save_contactus_form").valid();
	    if (!isvalidate) {
	        return false;
	    }else{
            var form = $('#save_contactus_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#save_contactus_form").attr('action');
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
                    //swal.close();
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
		                    function(){ 
                                $("#save_contactus_form")[0].reset();
		                        window.location.href = respData.redirectUrl;
		                        //window.location.reload();
		                    }
		                );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    
     /* Contact Us js start End */

     /* Subscribes js start */
    $("#save_subscribe_form").on('submit',(function(e) {
        e.preventDefault();
        var isvalidate = $("#save_subscribe_form").valid();
        if (!isvalidate) {
            return false;
        }else{
            var form = $('#save_subscribe_form')[0];  /* Get form */
            var requestData = new FormData(form);  /* Create an FormData object  */
            var action_page 		= $("#save_subscribe_form").attr('action');
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
                    //swal.close();
                    respData = JSON.parse(resp);
                    if(respData.responseCode == 200){
                        swal({title: "", text: respData.responseMessage, type: "success"},
                            function(){ 
                                $("#save_subscribe_form")[0].reset();
                                window.location.href = respData.redirectUrl;
                                //window.location.reload();
                            }
                        );
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));
    
    $("div#profileCustomer").on("click","#rempveProfileImage", function(e) { 
        e.preventDefault();

        let _self = $(this);
        let baseurl = $(this).data('baseurl');
        let action_page = $(this).data('actionurl');
        let customerid = $(this).data('customerid');
        let requestData = 'customerid='+customerid;
        
        swal({
            title: (lang == "en") ?"هل أنت متأكد من إزالة هذه الصورة من ملفك الشخصي؟":"Are you sure about to remove this Picture from your profile ?",
            text: (lang == "en") ?"ستتم إزالة صورة ملفك الشخصي":"Your Profile Picture will remove",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: (lang == "en") ?"نعم ، قم بإزالة!":"Yes, remove !",
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
            } else {
                swal(Cancelled, record_is_safe, "error");
            }
        });

    });
    /* Subscribes js start End */
    
    // $('#viewAllMyOrderList').DataTable({
    //     'paging': true,
    //     'deferRender': true,
    //     'lengthChange': true,
    //     'searching': true,
    //     'info': true,
    //     'dom': 'Bfrtip',
    //     'buttons': [
    //         'copy', 'csv', 'excel', 'pdf', 'print'
    //     ],
    //     'pageLength': 10,
    //     'processing': true
    // });

    /* =================================Store Front-end js end ================================= */
    
    /* autosearch start */
    $('#gsearchsimple').keyup(function(){
        var query = $('#gsearchsimple').val();
        $('#detail').html('');
        $('.list-group').css({
            'display' : 'block',
            'height' : 'auto',
            'max-height' : '300px',
            'overflow-y' : 'scroll'
        });
        if(query.length >= 2)
        {
            var action_page = base_url+'/product/products?query='+query;
            $("#gsearchBtn").attr('href',action_page);
            $.ajax({
                url:base_url+"/search",
                method:"POST",
                data:{query:query},
                success:function(data)
                {
                    $('.list-group').html(data);
                    $('.list-group').css('background-color','rgb(255, 255, 255)');
                }
            })
        }
        if(query.length == 0)
        {
            $('.list-group').css('display', 'none');
            $("#gsearchBtn").attr('href','javascript:void(0);');
        }
    });

    $(document).on('click', '.gsearch', function(){
        var text = $(this).text();
        $('#gsearchsimple').val(text);
        $('.list-group').css('display', 'none');
    });

    /* autosearch end */

    /* ===================== Store Front-end motorev js end =================== */
    
    
    $(".cat-tab-item").click(function (e) {
        e.preventDefault();
        let customerid = $(this).data('customerid');
        let carouselid = $(this).data('carouselid');
        let catid = $(this).data('catid');
        var action_page = $(this).data('actionurl');
        let requestData = 'catid='+catid;
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
                swal.close();
                if(respData.responseCode == 200){
                    let html_content = '';
                    if(typeof respData.responseData !== 'undefined'){
                        $('#category-carousel-'+carouselid).html('');
                        let productList = respData.responseData;
                        $.each(productList,function(key, value){
                            var prodImg = value.image;
                            var retail_price = parseFloat(value.retail_price);
                            var product_price = parseFloat(value.product_price);
                            var product_title = value.title;
                            var maxLength = 10;
                            var ellipsis = "...";
                            var truncated_product_title = product_title.substr(0, maxLength) + ellipsis;
                            html_content += '<div class="owl-item" style="width: 270px; margin-right: 10px;">'+
                                '<div class="item">'+
                                    '<div class="prod-wrapper">'+
                                        '<a href="'+base_url+'product/product-details/'+value.id+'">'+
                                            '<img src="'+base_url+'/uploads/product/'+prodImg+'">'+
                                        '</a>'+
                                        '<div class="prod-detail text-center">'+
                                            '<a href="'+base_url+'/product/product-details/'+value.id+'" title="'+product_title+'">'+
                                                '<h4>'+truncated_product_title+'</h4>'+
                                            '</a>'+
                                            '<div class="home-prod-price mb-2">'+
                                                '<span class="strike-amount">SAR '+retail_price+'</span>'+
                                                '<span class="sale-amount">SAR '+product_price+'</span>'+
                                            '</div>'+
                                            '<div class="wishlist">'+
                                                '<i class="icofont-heart" data-carouselid="'+carouselid+'" data-productid="'+value.id+'" data-customerid="'+customerid+'"></i>'+
                                            '</div>'+
                                            '<a href="'+base_url+'/product/product-details/'+value.id+'" class="g-brand-btn">Details</a>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                        });
                    }else{
                        html_content = (lang == "en") ?'<p>لم يتم العثور على أي منتج في هذه الفئة</p>':'<p>No Product Found In This Category</p>';
                    }
                    $('#category-carousel-'+carouselid).html(html_content);
                }
            }
        });
    });

    
    $("section.section-spacing").on("click",".addProdToWshlst", function(e) { 
        e.preventDefault();
        let _self = $(this);
        let addProductToWishlistUrl = base_url+'/customer/add-product-wishlist';
        let productid = $(this).data('productid');
        let customerid = $(this).data('customerid');
        if(customerid==''){
            swal({title: "", text: (lang == "en") ?"الرجاء تسجيل الدخول للمتابعة ...":"Please Login To Proceed...", type: "error"});
            return false;
        }else{
            let requestData = {productid:productid,customerid:customerid};
            $.ajax
            ({
                type: "POST",
                data: requestData,
                url: addProductToWishlistUrl,
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
                        $(_self).toggleClass("press", 1000);
                        $(_self).addClass('removeProdFromWshlst');
                        $(_self).removeClass('addProdToWshlst');
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
        
    });

    $("section.section-spacing").on("click",".removeProdFromWshlst", function(e) { 
        e.preventDefault();
        let _self = $(this);
        let removeProductFromWishlistUrl = base_url+'/customer/remove-product-wishlist';
        let productid = $(this).data('productid');
        let customerid = $(this).data('customerid');
        if(customerid==''){
            swal({title: "", text: (lang == "en") ?"الرجاء تسجيل الدخول للمتابعة ...":"Please Login To Proceed...", type: "error"});
            return false;
        }else{
            let requestData = {productid:productid,customerid:customerid};
            $.ajax
            ({
                type: "POST",
                data: requestData,
                url: removeProductFromWishlistUrl,
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
                        $(_self).toggleClass("press", 1000);
                        $(_self).addClass('addProdToWshlst');
                        $(_self).removeClass('removeProdFromWshlst');
                    }else{
                        swal({title: "", text: respData.responseMessage, type: "error"});
                    }
                }
            });
        }
        
    });

    /* ===================== Store Front-end motorev js end =================== */

    

});






