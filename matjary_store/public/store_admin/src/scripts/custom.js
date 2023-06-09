$(document).ready(function () {
    let lang = $("#languageChange").data('lang');

    $("#discountTypeList").change(function () {

        var percString = "perc";
        var amtString = "amt";

        var dtlOptionSelected = $("#discountTypeList option:selected").val();

        if (dtlOptionSelected == percString) {
            $("#dTypeInput").css("display", "block");
        }

        else {
            $("#dTypeInput").css("display", "none");
        }
    })
    
    $("#discount_type").change(function () {
        let discount_type = $(this).val(); 
        if(discount_type==2){
            $("#discount_value").attr("maxlength",4);
        }else{
            $("#discount_value").attr("maxlength",2);
        }
    })

    $("#couponForList").change(function () {

        var ovString = "ordersOver";
        var catString = "category";
        var prodString = "product";

        var cflOptionSelected = $("#couponForList option:selected").val();

        if (cflOptionSelected == ovString) {
            $("#minAppAmt").css("display", "block");
            $("#couponCategory").css("display", "none");
            $("#couponProduct").css("display", "none");
        }



        else if (cflOptionSelected == catString) {
            $("#couponCategory").css("display", "block");
            $("#minAppAmt").css("display", "none");
            $("#couponProduct").css("display", "none");
        }



        else if (cflOptionSelected == prodString) {
            $("#couponProduct").css("display", "block");
            $("#minAppAmt").css("display", "none");
            $("#couponCategory").css("display", "none");
        }

        else {
            $("#minAppAmt").css("display", "none");
            $("#couponCategory").css("display", "none");
            $("#couponProduct").css("display", "none");
        }
    })

    $("#billingShippingCheck").change(function () {
        if ($(this).is(':checked')) {
            $('#userShippingAddress').hide();
        }
        else {
            $('#userShippingAddress').show();
        }
    })

    $('#fixedTaxInput').hide();
    $('#specificTaxInput').hide();

    $("#taxOptionList").change(function () {

        var fixedTaxString = "fixedTax";
        var specificTaxString = "specificTax";

        var taxOptionSelected = $("#taxOptionList option:selected").val();

        if (taxOptionSelected == fixedTaxString) {
            $("#fixedTaxInput").show();
            $('#specificTaxInput').hide();
        }

        else if (taxOptionSelected == specificTaxString) {
            $("#specificTaxInput").show();
            $('#fixedTaxInput').hide();
        }

        else {
            $('#fixedTaxInput').hide();
            $('#specificTaxInput').hide();
        }

    })

    $('#orderPriceSettingForm').hide();
    $('#orderWeightSettingForm').hide();

    $("#shippingRateList").change(function () {
        var orderPriceString = "orderPrice";
        var orderWeightString = "orderWeight";

        var orderRateTypeSelected = $("#shippingRateList option:selected").val();

        if (orderRateTypeSelected == orderPriceString) {
            $('#orderPriceSettingForm').show();
            $('#orderWeightSettingForm').hide();
        }

        else if (orderRateTypeSelected == orderWeightString) {
            $('#orderWeightSettingForm').show();
            $('#orderPriceSettingForm').hide();
        }

        else {
            $('#orderPriceSettingForm').hide();
            $('#orderWeightSettingForm').hide();
        }
    })

    $( '#DataTables_Table_0_wrapper' ).on( 'click', '.payCmp', function () {
        let paycmpid = $(this).data('paycmpid');
        let html = '';
        let profileID = (lang == "en") ? "ملف البطاقة الشخصية" : "Profile ID";
        let api_key = (lang == "en") ? "مفتاح API" : "API Key";
        if($(this).prop('checked') == true){
            if(paycmpid==1){
                html += 
                '<div class="row pay_cmp_form_div" id="Form'+paycmpid+'">'+
                    '<div class="col-md-1"></div>'+
                    '<div class="col-md-11">'+
                        '<div class="row">'+
                            '<input type="hidden" name="pay_cmp_id[]" value="'+paycmpid+'">'+
                            '<div class="col-md-4">'+
                                '<label>Payment Account Number</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="ac_no[]" class="form-control" placeholder="Payment Account Number">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Username</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="username[]" class="form-control" placeholder="Payment Username">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Password</label>'+
                                '<div class="mb-2">'+
                                    '<input type="password" name="password[]" class="form-control" placeholder="Payment Password">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            }else if(paycmpid==2){
                html += 
                '<div class="row pay_cmp_form_div" id="Form'+paycmpid+'">'+
                    '<div class="col-md-1"></div>'+
                    '<div class="col-md-11">'+
                        '<div class="row">'+
                            '<input type="hidden" name="pay_cmp_id[]" value="'+paycmpid+'">'+
                            '<div class="col-md-4">'+
                                '<label>Payment Account Number</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="ac_no[]" class="form-control" placeholder="Payment Account Number">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Username</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="username[]" class="form-control" placeholder="Payment Username">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Password</label>'+
                                '<div class="mb-2">'+
                                    '<input type="password" name="password[]" class="form-control" placeholder="Payment Password">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            }else if(paycmpid==3){
                html += 
                '<div class="row pay_cmp_form_div" id="Form'+paycmpid+'">'+
                    '<div class="col-md-1"></div>'+
                    '<div class="col-md-11">'+
                        '<div class="row">'+
                            '<input type="hidden" name="pay_cmp_id[]" value="'+paycmpid+'">'+
                            '<div class="col-md-4">'+
                                '<label>Payment Account Number</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="ac_no[]" class="form-control" placeholder="Payment Account Number">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Username</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="username[]" class="form-control" placeholder="Payment Username">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Password</label>'+
                                '<div class="mb-2">'+
                                    '<input type="password" name="password[]" class="form-control" placeholder="Payment Password">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            }else if(paycmpid==4){
                html += 
                '<div class="row pay_cmp_form_div" id="Form'+paycmpid+'">'+
                    '<div class="col-md-1"></div>'+
                    '<div class="col-md-11">'+
                        '<div class="row">'+
                            '<input type="hidden" name="pay_cmp_id[]" value="'+paycmpid+'">'+
                            '<div class="col-md-4">'+
                                '<label>Payment Account Number</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="ac_no[]" class="form-control" placeholder="Payment Account Number">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Username</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="username[]" class="form-control" placeholder="Payment Username">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Password</label>'+
                                '<div class="mb-2">'+
                                    '<input type="password" name="password[]" class="form-control" placeholder="Payment Password">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            }else if(paycmpid==5){
                html += 
                '<div class="row pay_cmp_form_div" id="Form'+paycmpid+'">'+
                    '<div class="col-md-1"></div>'+
                    '<div class="col-md-11">'+
                        '<div class="row">'+
                            '<input type="hidden" name="pay_cmp_id[]" value="'+paycmpid+'">'+
                            '<div class="col-md-4">'+
                                '<label>'+profileID+'</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="profile_id[]" id="profile_id" class="form-control" placeholder="PayTabs '+profileID+'">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>'+api_key+'</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="apikey[]" id="apikey" class="form-control" placeholder="'+api_key+'">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            }else if(paycmpid==6){
                html += 
                '<div class="row pay_cmp_form_div" id="Form'+paycmpid+'">'+
                    '<div class="col-md-1"></div>'+
                    '<div class="col-md-11">'+
                        '<div class="row">'+
                            '<input type="hidden" name="pay_cmp_id[]" value="'+paycmpid+'">'+
                            '<div class="col-md-4">'+
                                '<label>Payment Account Number</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="ac_no[]" class="form-control" placeholder="Payment Account Number">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Username</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="username[]" class="form-control" placeholder="Payment Username">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Password</label>'+
                                '<div class="mb-2">'+
                                    '<input type="password" name="password[]" class="form-control" placeholder="Payment Password">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            }else if(paycmpid==7){
                html += 
                '<div class="row pay_cmp_form_div" id="Form'+paycmpid+'">'+
                    '<div class="col-md-1"></div>'+
                    '<div class="col-md-11">'+
                        '<div class="row">'+
                            '<input type="hidden" name="pay_cmp_id[]" value="'+paycmpid+'">'+
                            '<div class="col-md-4">'+
                                '<label>Payment Account Number</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="ac_no[]" class="form-control" placeholder="Payment Account Number">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Username</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="username[]" class="form-control" placeholder="Payment Username">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Password</label>'+
                                '<div class="mb-2">'+
                                    '<input type="password" name="password[]" class="form-control" placeholder="Payment Password">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            }else if(paycmpid==8){
                html += 
                '<div class="row pay_cmp_form_div" id="Form'+paycmpid+'">'+
                    '<div class="col-md-1"></div>'+
                    '<div class="col-md-11">'+
                        '<div class="row">'+
                            '<input type="hidden" name="pay_cmp_id[]" value="'+paycmpid+'">'+
                            '<div class="col-md-4">'+
                                '<label>Payment Account Number</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="ac_no[]" class="form-control" placeholder="Payment Account Number">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Username</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="username[]" class="form-control" placeholder="Payment Username">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Password</label>'+
                                '<div class="mb-2">'+
                                    '<input type="password" name="password[]" class="form-control" placeholder="Payment Password">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            }else if(paycmpid==9){
                html += 
                '<div class="row pay_cmp_form_div" id="Form'+paycmpid+'">'+
                    '<div class="col-md-1"></div>'+
                    '<div class="col-md-11">'+
                        '<div class="row">'+
                            '<input type="hidden" name="pay_cmp_id[]" value="'+paycmpid+'">'+
                            '<div class="col-md-4">'+
                                '<label>Payment Account Number</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="ac_no[]" class="form-control" placeholder="Payment Account Number">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Username</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="username[]" class="form-control" placeholder="Payment Username">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Password</label>'+
                                '<div class="mb-2">'+
                                    '<input type="password" name="password[]" class="form-control" placeholder="Payment Password">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            }else if(paycmpid==10){
                html += 
                '<div class="row pay_cmp_form_div" id="Form'+paycmpid+'">'+
                    '<div class="col-md-1"></div>'+
                    '<div class="col-md-11">'+
                        '<div class="row">'+
                            '<input type="hidden" name="pay_cmp_id[]" value="'+paycmpid+'">'+
                            '<div class="col-md-4">'+
                                '<label>Payment Account Number</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="ac_no[]" class="form-control" placeholder="Payment Account Number">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Username</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="username[]" class="form-control" placeholder="Payment Username">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Password</label>'+
                                '<div class="mb-2">'+
                                    '<input type="password" name="password[]" class="form-control" placeholder="Payment Password">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            }else if(paycmpid==11){
                html += 
                '<div class="row pay_cmp_form_div" id="Form'+paycmpid+'">'+
                    '<div class="col-md-1"></div>'+
                    '<div class="col-md-11">'+
                        '<div class="row">'+
                            '<input type="hidden" name="pay_cmp_id[]" value="'+paycmpid+'">'+
                            '<div class="col-md-4">'+
                                '<label>Payment Account Number</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="ac_no[]" class="form-control" placeholder="Payment Account Number">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Username</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="username[]" class="form-control" placeholder="Payment Username">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Password</label>'+
                                '<div class="mb-2">'+
                                    '<input type="password" name="password[]" class="form-control" placeholder="Payment Password">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            }else if(paycmpid==12){
                html += 
                '<div class="row pay_cmp_form_div" id="Form'+paycmpid+'">'+
                    '<div class="col-md-1"></div>'+
                    '<div class="col-md-11">'+
                        '<div class="row">'+
                            '<input type="hidden" name="pay_cmp_id[]" value="'+paycmpid+'">'+
                            '<div class="col-md-4">'+
                                '<label>Payment Account Number</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="ac_no[]" class="form-control" placeholder="Payment Account Number">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Username</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="username[]" class="form-control" placeholder="Payment Username">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Password</label>'+
                                '<div class="mb-2">'+
                                    '<input type="password" name="password[]" class="form-control" placeholder="Payment Password">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            }else if(paycmpid==13){
                html += 
                '<div class="row pay_cmp_form_div" id="Form'+paycmpid+'">'+
                    '<div class="col-md-1"></div>'+
                    '<div class="col-md-11">'+
                        '<div class="row">'+
                            '<input type="hidden" name="pay_cmp_id[]" value="'+paycmpid+'">'+
                            '<div class="col-md-4">'+
                                '<label>Payment Account Number</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="ac_no[]" class="form-control numberonly" maxlength="15" placeholder="Payment Account Number">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Username</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="username[]" class="form-control" placeholder="Payment Username">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>Payment Password</label>'+
                                '<div class="mb-2">'+
                                    '<input type="password" name="password[]" class="form-control" placeholder="Payment Password">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>API Key</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="apikey[]" id="apikey" class="form-control" placeholder="API KEY">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            }
            $( '#DataTables_Table_0_wrapper' ).find("#payment_setting_form_"+paycmpid+"_wrapper").append(html);
        }else{
            $("#payment_setting_form_"+paycmpid+"_wrapper").find("#Form"+paycmpid).remove();
        }
    });

    $( '#DataTables_Table_0_wrapper' ).on( 'click', '.shipCmp', function () {
        let shipcmpid = $(this).data('shipcmpid');
        //alert(shipcmpid);
        let html = '';
        if($(this).prop('checked') == true){
            
            let var1 = (lang == "en") ? "عنوان الشحن (ملاحظة: مسموح بـ 50 حرفًا فقط)" : "Shipping Address (Note : Only 50 charactors are allowed)";
            let var2 = (lang == "en") ? "عنوان الشحن" : "Shipping Address";
            let Zipcode = (lang == "en") ? "الرمز البريدي" : "Zipcode";
            let var3 = (lang == "en") ? "تكلفة الشحن" : "Shipping Cost";
            let var4 = (lang == "en") ? "رقم حساب أرامكس" : "Aramex Account Number";
            let var5 = (lang == "en") ? "رقم التعريف الشخصي لحساب أرامكس" : "Aramex Account Pin";
            let var6 = (lang == "en") ? "اسم مستخدم أرامكس" : "Aramex Username";
            let var7 = (lang == "en") ? "كلمة مرور أرامكس" : "Aramex Password";
            let var8 = (lang == "en") ? "اسم مستخدم ZipShip" : "ZipShip Username";
            let var9 = (lang == "en") ? "كلمة مرور ZipShip" : "ZipShip Password";
            if(shipcmpid==1){
                html += 
                '<div class="row ship_cmp_form_div" id="Form'+shipcmpid+'">'+
                    '<div class="col-md-1"></div>'+
                    '<div class="col-md-11">'+
                        '<div class="row">'+
                            '<input type="hidden" name="ship_cmp_id[]" value="'+shipcmpid+'">'+
                            '<input type="hidden" name="ship_cmp_city[]" value="Riyadh">'+
                            '<input type="hidden" name="ship_cmp_country_code[]" value="SA">'+
                            '<div class="col-md-12">'+
                                '<label>'+var1+' </label>'+
                                '<div class="mb-2">'+
                                    '<textarea name="address[]" class="form-control ship_cmp_addr" rows="2" maxlength ="52" placeholder="'+var2+'" id="address"  ></textarea>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>'+Zipcode+'</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="zipcode[]" class="form-control" placeholder="'+Zipcode+'" id="zipcode"  >'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>'+var3+'</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="cost[]" class="form-control ship_cmp_cost" placeholder="'+var3+'" id="cost"  >'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>'+var4+'</label>'+
                                '<div class="mb-2">'+
                                    '<input type="tel" name="ac_no[]" class="form-control ship_cmp_ac_no" placeholder="'+var4+'">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>'+var5+'</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="ac_pin[]" id="ac_pin" class="form-control" placeholder="'+var5+'">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>'+var6+'</label>'+
                                '<div class="mb-2">'+
                                    '<input type="tel" name="username[]" class="form-control ship_cmp_username" placeholder="'+var6+'">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>'+var7+'</label>'+
                                '<div class="mb-2">'+
                                    '<input type="password" name="password[]" class="form-control ship_cmp_password" placeholder="'+var7+'">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            }else if(shipcmpid==2){
                html += 
                
                '<div class="row ship_cmp_form_div" id="Form'+shipcmpid+'">'+
                    '<div class="col-md-1"></div>'+
                    '<div class="col-md-11">'+
                        '<div class="row">'+
                            '<input type="hidden" name="ship_cmp_id[]" value="'+shipcmpid+'">'+
                            '<div class="col-md-12">'+
                                '<label>'+var1+'</label>'+
                                '<div class="mb-2">'+
                                    '<textarea name="address[]" class="form-control" rows="2" placeholder="'+var1+'" id="address"  ></textarea>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>'+var3+'</label>'+
                                '<div class="mb-2">'+
                                    '<input type="text" name="cost[]" class="form-control" placeholder="'+var3+'" id="cost"  >'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>'+var4+'</label>'+
                                '<div class="mb-2">'+
                                    '<input type="tel" name="ac_no[]" class="form-control" placeholder="'+var4+'">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>'+var8+'</label>'+
                                '<div class="mb-2">'+
                                    '<input type="tel" name="username[]" class="form-control" placeholder="'+var8+'">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<label>'+var9+'</label>'+
                                '<div class="mb-2">'+
                                    '<input type="password" name="password[]" class="form-control" placeholder="'+var9+'">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            }
            $( '#DataTables_Table_0_wrapper' ).find("#shipping_setting_form_"+shipcmpid+"_wrapper").append(html);
        }else{
            $("#shipping_setting_form_"+shipcmpid+"_wrapper").find("#Form"+shipcmpid).remove();
        }
    });

    $('#for_orders').on('change', function () { 
        if(this.value == "2"){
            $("#min_amount_div").show();
        } else {
            $("#min_amount").val('0');
            $("#min_amount_div").hide();
        }
    });
    var getorderval = $('#for_orders').find(":selected").val();  
    if(getorderval == "2"){
        $("#min_amount_div").show();
    }else{
        $("#min_amount").val('0');
        $("#min_amount_div").hide();
    }

    //Contact Us replay
    $("#replay").click(function(){
        $("#replayEmail").show();
    });

    /* Allow Only Number Validation */
    $('.numberonly').keypress(function (e) {  
        var charCode = (e.which) ? e.which : event.keyCode   
            if (String.fromCharCode(charCode).match(/[^0-9]/g))    
        return false;   
    });

     /* Flat Number Only Validation */
     $('.floatNumberOnly').keypress(function (e) {  
        var charCode = (e.which) ? e.which : event.keyCode   
            if (String.fromCharCode(charCode).match(/[^0-9-.]/g))    
        return false;   
    });

    $("#languageChange").click(function () {
        let action_page = $(this).data('actionurl');
        let lang = $(this).data('lang');
        let requestData = {lang:lang};
        $.ajax
        ({
            type: "POST",
            data: requestData,
            url: action_page,
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
                window.location.reload();
            }
        });
    });
    
    /**Listing table checkbutton */
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
  
});

$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;

    // or instead:
    // var maxDate = dtToday.toISOString().substr(0, 10);

    //alert(maxDate);
    $('#coupon_startdate').attr('min', maxDate);
    $('#coupon_expirydate').attr('min', maxDate);
    $('#start_date').attr('min', maxDate);
    $('#expiry_date').attr('min', maxDate);
});

    