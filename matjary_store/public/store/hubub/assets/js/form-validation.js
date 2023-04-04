$(document).ready(function() {
    let lang = $("#languageChange").data('lang');
    /* custom validation for String */
    $.validator.addMethod("validString", function(value, element) {
        /* allow any non-whitespace characters as the host part */
        /*return this.optional( element ) || /^[a-zA-Z0-9- ]*$/.test( value ); */
        return this.optional( element ) || /^[\u0621-\u064Aa-zA-Z0-9- ]*$/.test( value ); /* allow arabic characters as well */
    }, (lang == "en") ?'سلسلة الإدخال الخاصة بك تحتوي على أحرف غير قانونية.':'Your input string contains illegal characters.');

    $.validator.addMethod("notEqualTo", function(value, element, param) {
        // Bind to the blur event of the target in order to revalidate whenever the target field is updated
        var target = $( param );
        if ( this.settings.onfocusout && target.not( ".validate-equalTo-blur" ).length ) {
            target.addClass( "validate-equalTo-blur" ).on( "blur.validate-equalTo", function() {
                $( element ).valid();
            } );
        }
        return value !== target.val();
        // condition returns true or false
    }, (lang == "en") ?"يجب أن تكون القيم فريدة":"Values must be unique");

    $.validator.addMethod('greaterThan', function(value, element) {
        var dateFrom = $("#coupon_startdate").val();
        var dateTo = $('#coupon_expirydate').val();
        return dateTo >= dateFrom;
    });
    /* check valid strong passsword start */
    $.validator.addMethod("pwdLength", function(value, element) {
        return this.optional( element ) || /^.{8,16}$/.test( value );
    }, (lang == "en") ?'توقع أن يتراوح طول كلمة المرور بين 8 و 16 حرفًا.':'Expect a password length between 8 and 16 characters.');
    $.validator.addMethod("pwdUpper", function(value, element) {
        return this.optional( element ) || /[A-Z]+/.test( value );
    }, (lang == "en") ?'توقع وجود حرف كبير واحد على الأقل.':'Expect at least one uppercase character.');
    $.validator.addMethod("pwdLower", function(value, element) {
        return this.optional( element ) || /[a-z]+/.test( value );
    }, (lang == "en") ?'توقع وجود حرف صغير واحد على الأقل.':'Expect at least one lowercase character.');
    $.validator.addMethod("pwdNumber", function(value, element) {
        return this.optional( element ) || /[0-9]+/.test( value );
    }, (lang == "en") ?'توقع رقمًا.':'Expect a number.');
    $.validator.addMethod("pwdSpecial", function(value, element) {
        return this.optional( element ) || /[!@#$%^&()'[\]"?+-/*={}.,;:_]+/.test( value );
    }, (lang == "en") ?'توقع شخصية خاصة واحدة على الأقل:! @ # $٪ ^ & () ’[]”؟ + - / *':'Expect at least one special character: !@#$%^&()’[]”?+-/*');
    /* check valid strong passsword end */

    //Custom validation for file size
    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param * 500000) 
    }, (lang == "en") ?'الحد الأقصى لحجم الملف هو 500 كيلو بايت.':'Maximum File Size Limit is 500kb.');

    //Custom validation for file extension
    $.validator.addMethod("extension", function (value, element, param) {
        param = typeof param === "string" ? param.replace(/,/g, '|') : "png|jpe?g|gif";
        return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
    }, jQuery.format((lang == "en") ?"تنسيق صورة غير صالح! يجب أن يكون تنسيق الصورة JPG أو JPEG أو PNG أو GIF.":"Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF."));

    /* Customer form-validation js start */
    $("#save_customer_register_form").validate({
        rules: {
            name: {
                required:true,
                validString:true
            },
            contact_no:{
                required:true,
                digits:true,
                minlength: 9,
		        maxlength: 10
            },
            email:{
                required:true
            },
            password:{
                required:true,
                pwdLength:true,
                pwdUpper:true,
                pwdLower:true,
                pwdNumber:true,
                pwdSpecial:true
            },
            cnf_password:{
                required:true,
                equalTo : "#password",
                minlength: 6
            }

        },
        //For custom messages
        messages: {
            cnf_password:(lang == "en") ?'يجب أن تكون كلمة المرور وكلمة المرور المطابقة متطابقة.':'Password & confirm Password should be same.'
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error);
                $(placement).css('color','red');
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#customer_login_form").validate({
        rules: {
            email:{
                required:true
            },
            password:{
                required:true,
                minlength: 6
            }

        },
        //For custom messages
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error);
                $(placement).css('color','red');
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#customer_reset_forgot_pass_form").validate({
        rules: {
            email:{
                required:true
            }

        },
        //For custom messages
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error);
                $(placement).css('color','red');
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#customer_set_new_password_form").validate({
        rules: {
            password:{
                required:true,
                pwdLength:true,
                pwdUpper:true,
                pwdLower:true,
                pwdNumber:true,
                pwdSpecial:true
            },
            cnf_password:{
                required:true,
                equalTo : "#password",
                minlength: 6
            }

        },
        //For custom messages
        messages: {
            cnf_password:(lang == "en") ?'يجب أن تكون كلمة المرور وكلمة المرور المطابقة متطابقة.':'Password & Confirm Password should be same.'
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error);
                $(placement).css('color','red');
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#save_customer_deliver_address_form").validate({
        rules: {
            address:{
                required:true,
                maxlength:50
            },
            country_id:{
                required:true
            },
            state_id:{
                required:true
            },
            city_id:{
                required:true
            },
            zipcode:{
                required:true,
                number:true
            }

        },
        //For custom messages
        messages: {
            address:{
                maxlength: (lang == "en") ?'يجب ألا يزيد العنوان عن 50 حرفًا.':'Address should not be greater than 50 characters.'
            },
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error);
                $(placement).css('color','red');
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#update_customer_deliver_address_form").validate({
        rules: {
            address:{
                required:true,
                maxlength:50
            },
            country_id:{
                required:true
            },
            state_id:{
                required:true
            },
            city_id:{
                required:true
            },
            zipcode:{
                required:true,
                number:true
            }

        },
        //For custom messages
        messages: {
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error);
                $(placement).css('color','red');
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#proceed_checkout_form").validate({
        rules: {
            customer_address_id:{
                required:true
            },
            ship_cmp_id:{
                required:true
            }

        },
        //For custom messages
        messages: {
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error);
                $(placement).css('color','red');
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#proceed_payment_form").validate({
        rules: {
            payment_option:{
                required:true
            },
            payment_gateway:{
                required:true
            },
            giftcard_code:{
                required:true
            }

        },
        //For custom messages
        messages: {
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error);
                $(placement).css('color','red');
            } else {
                error.insertAfter(element);
            }
        }
    });
    
    $("#coupon_code_form").validate({
        rules: {
            coupon_code:{
                required:true
            }

        },
        //For custom messages
        messages: {
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error);
                $(placement).css('color','red');
            } else {
                error.insertAfter(element);
            }
        }
    });
    
    /* Customer form-validation js end */
    
    /* My Profile form-validation js Start */
    $("#update_my_profile_form").validate({
        rules: {
            name:{
                required:true,
                validString : true,
                maxlength: 25
            },
            contact_no:{
                required:true,
                number: true,
		        minlength: 9,
		        maxlength: 10
            },
            profile_image:{
                required:false,
                extension:true,
                filesize:true               
            },
            address:{
                required:true,
                maxlength: 50
            },
            country_id:{
                required:true
            },
            state_id:{
                required:true
            },
            city_id:{
                required:true
            }, 
            zipcode:{
                required:true,
                number:true
            } 

        },
        //For custom messages
        messages: {
            'address':{
                maxlength: (lang == "en") ?'يجب ألا يزيد العنوان عن 50 حرفًا.':'Address should not be greater than 50 characters.'
            }, 
           
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error);
                $(placement).css('color','red');
            } else {
                error.insertAfter(element);
            }
        }
    });

    /* My Profile form-validation js end */

    /* Change Password form-validation js Start */
    $("#update_change_password_form").validate({
        rules: {
            oldpassword:{
                required:true,
                minlength: 6
            },
            password:{
                required:true,
                pwdLength:true,
                pwdUpper:true,
                pwdLower:true,
                pwdNumber:true,
                pwdSpecial:true

            },
            cnf_password:{
                required:true,
                equalTo : "#password",
                minlength: 6
            }

        },
        //For custom messages
        messages: {
            cnf_password:(lang == "en") ?'يجب أن تكون كلمة المرور وتأكيد كلمة المرور متطابقة.':'Password & Confirm Password should be same.'
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error);
                $(placement).css('color','red');
            } else {
                error.insertAfter(element);
            }
        }
    });

    /* Change Password form-validation js end */

    /* Product Feedback form-validation js Start */
    $("#save_feedback_form").validate({
        rules: {
            ratting:{
                required:true,
                
            },
            feedback:{
                required:true,
                maxlength:5000
            }

        },
        //For custom messages
        messages: {
            feedback:{
                maxlength: (lang == "en") ?'يجب ألا تزيد التعليقات عن 5000 حرف.':'Feedback should not be greater than 5000 characters.'
            },
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error);
                $(placement).css('color','red');
            } else {
                error.insertAfter(element);
            }
        }
    });    
    
    /* Product Feedback form-validation js end */

    /* Gift Cards Feedback form-validation js Start */
    $("#gift_card_save_feedback_form").validate({
        rules: {
            ratting:{
                required:true
            },
            feedback:{
                required:true,
                maxlength:5000
            }

        },
        //For custom messages
        messages: {
            feedback:{
                maxlength: (lang == "en") ?'يجب ألا تزيد التعليقات عن 5000 حرف.':'Feedback should not be greater than 5000 characters.'
            },
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error);
                $(placement).css('color','red');
            } else {
                error.insertAfter(element);
            }
        }
    });    
    
    /* Gift Cards Feedback form-validation js end */

    /* Contact Us form-validation js Start */
    $("#save_contactus_form").validate({
        rules: {
            name:{
                required:true
            },
            contact_no:{
                required:true,
                number: true,
		        minlength: 9,
		        maxlength: 10
            },
            email:{
                required:true
            },
            massage:{
                required:true
            }

        },
        //For custom messages
        messages: {
         
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error);
                $(placement).css('color','red');
            } else {
                error.insertAfter(element);
            }
        }
    });    
    
    /* Contact Us form-validation js end */

    /* Subscribes form-validation js Start */
    $("#save_subscribe_form").validate({
        rules: {            
            email:{
                required:true
            }

        },
        //For custom messages
        messages: {
            'email': { 
                required:(lang == "en") ?'الرجاء إدخال عنوان البريد الإلكتروني الخاص بك.':"Please enter your email address.",
               
             },
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error);
                $(placement).css('color','red');
            } else {
                error.insertAfter(element);
            }
        }
    });   
    
    $("#purchase_giftcard_form").validate({
        rules: {            
            gc_amount:{
                required:true
            }

        },
        //For custom messages
        messages: {
         
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error);
                $(placement).css('color','red');
            } else {
                error.insertAfter(element);
            }
        }
    });   
    
    /* Subscribes form-validation js end */
    // $("#edit_customer_deliver_address_form").validate({ 
    //     rules: {
    //         address:{
    //             required:true
    //         },
    //         country_id:{
    //             required:true
    //         },
    //         state_id:{
    //             required:true
    //         },
    //         city_id:{ 
    //             required:true
    //         }, 
    //         zipcode:{
    //             required:true,
    //             number:true
    //         }

    //     },
    //     //For custom messages
    //     messages: {
    //     },
    //     debug: true,
    //     errorElement: 'span',
    //     errorPlacement: function(error, element) {
    //         var placement = $(element).data('error');
    //         if(placement) {
    //             $(placement).append(error);
    //            $(placement).css('color','red');
    //         } else {
    //             error.insertAfter(element);
    //         }
    //     }
    // });

});