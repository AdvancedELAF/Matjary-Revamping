$(document).ready(function() {
    let lang = $("#languageChange").data('lang');

    /* custom validation for String */
    $.validator.addMethod("validString", function(value, element) {
        /* allow any non-whitespace characters as the host part */
        /*return this.optional( element ) || /^[a-zA-Z0-9- ]*$/.test( value ); */
        return this.optional( element ) || /^[\u0621-\u064Aa-zA-Z0-9- ]*$/.test( value ); /* allow arabic characters as well */
    }, (lang == "en") ?'سلسلة الإدخال الخاصة بك تحتوي على أحرف غير قانونية.':'Your input string contains illegal characters.');

    $.validator.addMethod("validStringSpecalChr", function(value, element) {
        /*  allow any non-whitespace characters as the host part */
        return this.optional( element ) || /^[a-zA-Z0-9- %.]*$/.test( value );
    }, (lang == "en") ?'سلسلة الإدخال الخاصة بك تحتوي على أحرف غير قانونية.':'Your input string contains illegal characters.');

    $.validator.addMethod("productKeywords", function(value, element) {
        /* allow any non-whitespace characters as the host part */
        return this.optional( element ) || /^[a-zA-Z0-9-, ,]*$/.test( value );
    }, (lang == "en") ?'كلماتك الرئيسية الإدخال تحتوي على أحرف غير قانونية.':'Your input keywords contains illegal characters.');
    
    $.validator.addMethod("productTags", function(value, element) {
        /* allow any non-whitespace characters as the host part */
        return this.optional( element ) || /^[a-zA-Z0-9-, ,]*$/.test( value );
    }, (lang == "en") ?'كلماتك الرئيسية الإدخال تحتوي على أحرف غير قانونية.':'Your input keywords contains illegal characters.');

    $.validator.addMethod("notEqualTo", function(value, element, param) {
        /*  Bind to the blur event of the target in order to revalidate whenever the target field is updated */
        var target = $( param );
        if ( this.settings.onfocusout && target.not( ".validate-equalTo-blur" ).length ) {
            target.addClass( "validate-equalTo-blur" ).on( "blur.validate-equalTo", function() {
                $( element ).valid();
            } );
        }
        return value !== target.val();
        /* condition returns true or false */
    }, (lang == "en") ?'يجب أن تكون القيم فريدة.':'Values Must Be Unique.');

    $.validator.addMethod("adminnotEqualTosupport", function(value, element, param) {
        /* Bind to the blur event of the target in order to revalidate whenever the target field is updated */
        var target = $( param );
        if ( this.settings.onfocusout && target.not( ".validate-equalTo-blur" ).length ) {
            target.addClass( "validate-equalTo-blur" ).on( "blur.validate-equalTo", function() {
                $( element ).valid();
            } );
        }
        return value !== target.val();
       /* condition returns true or false */
    }, "Values must be unique");

    $.validator.addMethod('greaterThan', function(value, element) {
        var dateFrom = $("#coupon_startdate").val();
        var dateTo = $('#coupon_expirydate').val();
        return dateTo >= dateFrom;
    });

    /*Custom validation for file extension */
    $.validator.addMethod("extension", function (value, element, param) {
        param = typeof param === "string" ? param.replace(/,/g, '|') : "png|jpe?g|gif";
        return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
    }, jQuery.format((lang == "en") ?"تنسيق صورة غير صالح! يجب أن يكون تنسيق الصورة JPG أو JPEG أو PNG أو GIF.":"Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF."));
  
    /* Custom validation for file size */
    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param * 500000) 
    }, (lang == "en") ?'الحد الأقصى لحجم الملف هو 500 كيلو بايت.':'Maximum File Size Limit is 500kb.');

    /* Custom validation for file imageWidth */
    $.validator.addMethod('minImageWidth', function(value, element, minWidth) {
        return ($(element).data('imageWidth') || 0) > minWidth;
      }, function(minWidth, element) {
        var imageWidth = $(element).data('imageWidth');
        return (imageWidth)
            ? ("Your image's width must be greater than " + minWidth + "px")
            : "Selected file is not an image.";
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

    /* Grater than retails price product validations */
        $.validator.addMethod('greaterThans', function(value, element) {
            var retail_price = $("#retail_price").val();
            var wholesale_price = $('#wholesale_price').val();
            return retail_price >= wholesale_price;
        });
    /* End */

    /* user password forgoted start */
    $("#chk_password_forgoted_user_email").validate({
        rules: {
            email:{
                required:true
            }

        },
       /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    /* user password forgoted end */
    
    /* Product Category form-validation js start */
    $("#save_product_category_form").validate({
        rules: {
            parent_cat_id:{
                required:false
            },
            category_name:{
                required:true,
                validString:true
            },
            category_name_ar:{
                required:true
            },
            category_img:{
                required:true,
                extension:true,
                filesize:true
            }

        },
        /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#update_product_category_form").validate({
        rules: {
            parent_cat_id:{
                required:false
            },
            category_name:{
                required:true,
                validString:true
            },
            category_name_ar:{
                required:true
            },
            category_img:{
                required:false,
                extension:true,
                filesize:true
            }

        },
        /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    /* Product Category form-validation js end */

    /* Product Brand form-validation js start */
    $("#save_product_brand_form").validate({
        rules: {
            brand_name:{
                required:true,
                validString:true
            },
            brand_image:{
                required:true,
                extension:true,
                filesize:true
            }

        },
        /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#update_product_brand_form").validate({
        rules: {
            brand_name:{
                required:true,
                validString:true
            },
            brand_image:{
                required:false,
                extension:true,
                filesize:true
            }

        },
        /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    /* Product Brand form-validation js end */

    /* Ganaral Setting form-validation js start */
    $("#save_general_setting_form").validate({
        rules: {
            logo:{
                required:true,
                extension:true,
                filesize:true
            },
            favicon:{
                required:true,
                extension:true,
                filesize:true
            },
            name:{
                required:true,
                validString:true
            },
            name_ar:{
                required:true
            },
            site_email:{
                required:true
            },
            address:{
                required:true,
                maxlength:50
            },
            short_desc:{
                required:true
            },
            long_desc:{
                required:true
            },
            address_ar:{
                required:true,
                maxlength:50
            },
            short_desc_ar:{
                required:true
            },
            long_desc_ar:{
                required:true
            },
            administraitor_email:{
                required:true,
                notEqualTo: '#site_email,#support_email',
            },
            contact_no:{
                required:true,
                number: true,
		        minlength: 9,
		        maxlength: 10
            }, 
            support_email:{
                required:true,
                adminnotEqualTosupport:'#administraitor_email',
            },          
            smtp_host:{
                required:true,
            },             
            smtp_username:{
                required:true
            },           
                smtp_password:{
            required:true
                },             
            smtp_port:{
                required:true,
                digits:true
            },
            smtp_from:{
                required:true             
            },

        },
        /* For custom messages */
        messages: {
            'logo':{
                required: (lang == "en") ?"الرجاء تحميل الشعار.":"Please upload logo."
            },           
            'favicon':{
                required: (lang == "en") ?"يرجى تحميل الأيقونة المفضلة.":"Please upload favicon."
            },
            'name': (lang == "en") ?"الرجاء إدخال اسم الموقع.":"Please enter site name.",
            'site_email': (lang == "en") ?"الرجاء إدخال عنوان بريد إلكتروني صالح للموقع.":"Please enter a valid site email address.",           
            address:{
                required : (lang == "en") ?"الرجاء إدخال عنوان المتجر.":'Please enter a store address.',
                maxlength: (lang == "en") ?"يجب ألا يزيد العنوان عن 50 حرفًا.":'Address should not be greater than 50 characters.'
            },
            'short_desc': (lang == "en") ?"الرجاء إدخال وصف قصير.":"Please enter a short desc.",
            'long_desc': (lang == "en") ?"الرجاء إدخال وصف طويل.":"Please enter a long desc.",
            'administraitor_email':
            { 
                required:(lang == "en") ?"الرجاء إدخال بريد إلكتروني صالح للمسؤول.":"Please enter a valid administrator email.",
                notEqualTo:(lang == "en") ?"يجب ألا يكون البريد الإلكتروني للمسؤول مساويًا للبريد الإلكتروني الخاص بالموقع والبريد الإلكتروني للدعم.":"Administrator email should not equal to site email and support email."
            },
            'contact_no': { 
                required:(lang == "en") ?"الرجاء إدخال رقم الاتصال.":"Please enter a contact number.",
                number: (lang == "en") ?"من فضلك أدخل رقما صالحا.":"Please enter a valid number."
             },
            'support_email':
            { 
               required : (lang == "en") ?"الرجاء إدخال عنوان بريد إلكتروني صالح للاتصال.":"Please enter a valid contact email address.",
               adminnotEqualTosupport:(lang == "en") ?"يجب ألا يساوي البريد الإلكتروني للدعم البريد الإلكتروني للمسؤول.":"Support email should not equal to  Administrator email." 
            },
            'smtp_host':{ 
                required: (lang == "en") ?"الرجاء إدخال مضيف SMTP.":"Please enter a SMTP host.",
            },
            'smtp_username': (lang == "en") ?"الرجاء إدخال اسم مستخدم SMTP.":"Please enter a SMTP username.",
            'smtp_password': (lang == "en") ?"الرجاء إدخال كلمة مرور SMTP.":"Please enter a SMTP password.",
            'smtp_port': { 
                required:(lang == "en") ?"الرجاء إدخال منفذ SMTP.":"Please enter a SMTP port.",
                digits: (lang == "en") ?"الرجاء إدخال منفذ SMTP صالح.":"Please enter a valid SMTP port."
             },
             'smtp_from': { 
                required:(lang == "en") ?"الرجاء إدخال نموذج SMTP.":"Please enter a SMTP Form.",               
             },
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#update_general_setting_form").validate({
        rules: {
            logo:{
                required:false,
                extension:true,
                filesize:true
            },
            favicon:{
                required:false,
                extension:true,
                filesize:true
            },
            name:{
                required:true,
                validString:true
            },
            name_ar:{
                required:true
            },
            site_email:{
                required:true
            },            
            address:{
                required:true,
                maxlength:50
            },
            short_desc:{
                required:true
            },
            long_desc:{
                required:true
            },
            address_ar:{
                required:true,
                maxlength:50
            },
            short_desc_ar:{
                required:true
            },
            long_desc_ar:{
                required:true
            },
            administraitor_email:{
                required:true,
                notEqualTo: '#site_email,#support_email',
            },
        
            contact_no:{
                required:true,
                number: true,
                minlength: 9,
                maxlength: 10
            }, 
            support_email:{
                required:true,
                adminnotEqualTosupport:'#administraitor_email',
            },           
             smtp_host:{
                required:true,
             },             
             smtp_username:{
                required:true
             },           
             smtp_password:{
                required:true
             },             
             smtp_port:{
                required:true,
                digits:true
             },
             smtp_from:{
                required:true             
             },

        },
        /* For custom messages */
        messages: {
            'logo':{
                required: (lang == "en") ?"الرجاء تحميل الشعار.":"Please upload logo."
            },
            'favicon':{
                required: (lang == "en") ?"يرجى تحميل الأيقونة المفضلة.":"Please upload favicon."
            },
            'name': (lang == "en") ?"الرجاء إدخال اسم الموقع.":"Please enter site name.",
            'site_email': (lang == "en") ?"الرجاء إدخال عنوان بريد إلكتروني صالح للموقع.":"Please enter a valid site email address.",

            'address':{
                required : (lang == "en") ?"الرجاء إدخال عنوان المتجر.":'Please enter a store address.',
                maxlength: (lang == "en") ?"يجب ألا يزيد العنوان عن 50 حرفًا.":'Address should not be greater than 50 characters.'
            },
            'short_desc': (lang == "en") ?"الرجاء إدخال وصف قصير.":"Please enter a short Description.",
            'long_desc': (lang == "en") ?"الرجاء إدخال وصف طويل.":"Please enter a long Description.",
            'administraitor_email':
            { 
                required:(lang == "en") ?"الرجاء إدخال بريد إلكتروني صالح للمسؤول.":"Please enter a valid administrator email.",
                notEqualTo:(lang == "en") ?"يجب ألا يكون البريد الإلكتروني للمسؤول مساويًا للبريد الإلكتروني الخاص بالموقع والبريد الإلكتروني للدعم.":"Administrator email should not equal to site email and support email."
            },
            
            'contact_no': { 
                required:(lang == "en") ?"الرجاء إدخال رقم الاتصال.":"Please enter a contact number.",
                number: (lang == "en") ?"من فضلك أدخل رقما صالحا.":"Please enter a valid number."
             },
            'support_email':
            { 
                required : (lang == "en") ?"الرجاء إدخال عنوان بريد إلكتروني صالح للاتصال.":"Please enter a valid contact email address.",
                adminnotEqualTosupport:(lang == "en") ?"يجب ألا يساوي البريد الإلكتروني للدعم البريد الإلكتروني للمسؤول.":"Support email should not equal to  Administrator email." 
            },
            'smtp_host':{ 
                required: (lang == "en") ?"الرجاء إدخال مضيف SMTP.":"Please enter a SMTP host.",
            },
            'smtp_username': (lang == "en") ?"الرجاء إدخال اسم مستخدم SMTP.":"Please enter a SMTP username.",
            'smtp_password': (lang == "en") ?"الرجاء إدخال كلمة مرور SMTP.":"Please enter a SMTP password.",
            'smtp_port': { 
                required:(lang == "en") ?"الرجاء إدخال منفذ SMTP.":"Please enter a SMTP port.",
                digits: (lang == "en") ?"الرجاء إدخال منفذ SMTP صالح.":"Please enter a valid SMTP port."
             },
             'smtp_from': { 
                required:(lang == "en") ?"الرجاء إدخال نموذج SMTP.":"Please enter a SMTP Form.",               
             },
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    /* Ganaral Setting form-validation js end */

    /* Product Color form-validation js start */
    $("#save_product_color_form").validate({
        rules: {
            color_name:{
                required:true,
                validString:true
            }

        },
        /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#update_product_color_form").validate({
        rules: {
            color_name:{
                required:true,
                validString:true
            }

        },
       /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    /* Product Color form-validation js end */

    /* Product Size form-validation js start */
    $("#save_product_size_form").validate({
        rules: {
            size:{
                required:true,
                validString:true
            }

        },
        /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#update_product_size_form").validate({
        rules: {
            size:{
                required:true,
                validString:true
            }

        },
        /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    /* Product Size form-validation js end */

    /* Shipping settings form-validation js start */
    $("#save_shipping_setting_form").validate({
       
        rules: {
            address:{
                required:true,
                maxlength:50
            },           
            cost:{
                required:true,
                digits: true
            },          
            ac_no:{
                required:true,
                digits:true
            },             
            username:{
                required:true
            },           
            password:{
                required:true
            }           

        },
        /* For custom messages */
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
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#update_shipping_setting_form").validate({
       
        rules: {
            address:{
                required:true,
                maxlength:50
            },           
            cost:{
                required:true,
                digits: true
            },          
            ac_no:{
                required:true,
                digits:true
            },             
            username:{
                required:true
            },           
            password:{
                required:true
            }       

        },
       /* For custom messages */
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
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#submit_create_pickup_request_form").validate({
        rules: {
            shipping_company_id:{
                required:true
            }

        },
        /* For custom messages */
        messages: {
           
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    /* Shipping settings form-validation js end */

    /* Payment settings form-validation js start */
    $("#save_payment_setting_form").validate({
       
        rules: {         
            ac_no:{
                required:true,
                digits:true
            },             
            username:{
                required:true
            },           
            password:{
                required:true
            }           

        },
       /* For custom messages */
        messages: {
           
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#update_payment_setting_form").validate({
       
        rules: {       
            ac_no:{
                required:true,
                digits:true
            },             
            username:{
                required:true
            },           
            password:{
                required:true
            }       

        },
        /* For custom messages */
        messages: {
           
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    /* Payment settings form-validation js end */

    /* Product form-validation js start */
    $("#save_product_form").validate({
        rules: {
            title:{
                required:true,
                validString:true
            },
            title_ar:{
                required:true
            },
            short_desc:{
                required:false
            },
            long_desc:{
                required:false
            },
            image:{
                required:true,
                extension:true,
                filesize:true
            },
            retail_price:{
                required:true
            },
            wholesale_price:{
                required:true,
                greaterThans: "#retail_price"
            },
            discount_per:{
                required:false
            },
            sales_tax:{
                required:false
            },
            stock_quantity:{
                required:true
            },
            order_limit_quantity:{
                required:true
            },
            threshold_quantity:{
                required:true
            },
            category_id:{
                required:true
            },
            brand_id:{
                required:false
            },
            color_id:{
                required:false
            },
            size_id:{
                required:false
            },
            weight:{
                required:true,
                number:true
            },
            keywords:{
                required:true,
                productKeywords:true
            },
            keywords_ar:{
                required:true,
            },
            tags:{
                required:true,
                productTags:true
            },
            tags_ar:{
                required:true,
            },
            promotion_status:{
                required:true
            },
            feature:{
                required:true
            }

        },
        /* For custom messages */
        messages: {
            'wholesale_price': {
                greaterThans: (lang == "en") ?'يجب أن يكون سعر الجملة أقل من سعر التجزئة':'Wholesale Price Should be less than the Retail Price.' 
            } 
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#update_product_form").validate({
        rules: {
            title:{
                required:true,
                validString:true
            },
            title_ar:{
                required:true
            },
            short_desc:{
                required:false
            },
            long_desc:{
                required:false
            },
            image:{
                required:false,
                extension:true,
                filesize:true
            },
            retail_price:{
                required:true
            },
            wholesale_price:{
                required:true
            },
            discount_per:{
                required:false
            },
            sales_tax:{
                required:false
            },
            stock_quantity:{
                required:true
            },
            order_limit_quantity:{
                required:true
            },
            threshold_quantity:{
                required:true
            },
            category_id:{
                required:true
            },
            brand_id:{
                required:false
            },
            color_id:{
                required:false
            },
            size_id:{
                required:false
            },
            weight:{
                required:true,
                number:true
            },
            keywords:{
                required:true,
                productKeywords:true
            },
            keywords_ar:{
                required:true,
            },
            tags:{
                required:true,
                productTags:true
            },
            tags_ar:{
                required:true,
            },
            promotion_status:{
                required:true
            },
            feature:{
                required:true
            }

        },
        /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    /* Product form-validation js end */

    /* User form-validation js start */
    $("#save_user_form").validate({
        rules: {           
            name:{
                required:true,
                validString:true
            },
            email:{
                required:true
            },            
            addr_residential:{
                required:true
            },
            addr_permanent:{
                required:true
            },           
            contact_no:{
                required:true,
                number: true,
		        minlength: 9,
		        maxlength: 10
            },  
            role_id:{
                required:true
            },           

        },
        /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#update_user_form").validate({
        rules: {           
            name:{
                required:true,
                validString:true
            },
            email:{
                required:true
            },            
            addr_residential:{
                required:true
            },
            addr_permanent:{
                required:true
            },           
            contact_no:{
                required:true,
                number: true,
		        minlength: 9,
		        maxlength: 10
            },  
            role_id:{
                required:false
            },           

        },
        /* For custom messages */
        messages: {
           
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    /* User form-validation js End */

    /* Customer form-validation js start */
    $("#save_customer_form").validate({
        rules: {           
            name:{
                required:true,
                validString:true
            },
            email:{
                required:true
            },  
            contact_no:{
                required:true,
                number: true,
		        minlength: 9,
		        maxlength: 10
             },  
                  

        },
        /* For custom messages */
        messages: {       
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#update_customer_form").validate({
        rules: {           
            name:{
                required:true,
                validString:true
            },
            email:{
                required:true
            },
            contact_no:{
                required:true,
                number: true,
		        minlength: 9,
		        maxlength: 10
            },  
            
        },
        /* For custom messages */
        messages: {
                     
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    /* Customer form-validation js End */

     /* Coupon form-validation js Start */
     $("#save_coupon_form").validate({
        rules: {           
            coupon_title:{
                required:true,
                validStringSpecalChr:true
            },
            coupon_title_ar:{
                required:true
            },
            coupon_code:{
                required:true,
                validStringSpecalChr:true
            },  
            coupon_desc:{
                required:true               
             }, 
             coupon_startdate:{
                required:true      
             },  
             coupon_expirydate:{
                required:true,
                greaterThan: "#coupon_startdate"             
             },
             discount_type : {
                required:true,  
             },
             discount_value:{
                required:true,                          
             }, 
             min_amount:{
                required:true
                               
             },  
             for_orders:{
                required:true
             }
                  

        },
        /* For custom messages */
        messages: {     
            'coupon_expirydate': {
                greaterThan: (lang == "en") ?'الرجاء تحديد تاريخ انتهاء أكبر من تاريخ البدء.':'Please select end date greater than start date.' 
            }, 
            'discount_value': (lang == "en") ?'الرجاء إدخال قيمة الخصم.':'Please enter discount value.',
             
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#update_coupon_form").validate({
       
        rules: {          
            coupon_title:{
                required:true               
             },
            coupon_desc:{
                required:true               
             },
             coupon_startdate:{
                required:true               
             },  
             coupon_expirydate:{
                required:true,
                greaterThan: "#coupon_startdate"              
             },
             discount_value:{
                required:true,                          
             }, 
             min_amount:{
                required:true                      
             },                    

        },
        /* For custom messages */
        messages: {      
            'coupon_desc': (lang == "en") ?'الرجاء إدخال وصف القسيمة.':"Please enter coupon description.",
            'coupon_startdate': (lang == "en") ?'الرجاء تحديد تاريخ البدء.':"Please select start date.",
            'coupon_expirydate': {
                required : (lang == "en") ?'الرجاء تحديد تاريخ الانتهاء.':'Please select end date.',
                greaterThan: (lang == "en") ?'الرجاء تحديد تاريخ انتهاء أكبر من تاريخ البدء.':"Please select end date greater than start date."
            },
            'discount_value': (lang == "en") ?'الرجاء إدخال قيمة الخصم.':'Please enter discount value.',
            'min_amount': {
                required: (lang == "en") ?'الرجاء إدخال الحد الأدنى للمبلغ المطبق.':'Please enter Minimum Applicable Amount.',
                digits : (lang == "en") ?'الرجاء إدخال رقم فقط.':'Please enter only Number.'
            } 
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    /* Coupon form-validation js End */

    /* Banner form-validation js start */
    $("#save_banner_form").validate({
        rules: {
            title:{
                required:true,
                validString:true
            },
            title_ar:{
                required:true
            },
            sub_title:{
                required:true,
                validString:true
            },
            sub_title_ar:{
                required:true
            },
            image:{
                required:true,
                extension:true,
                filesize:true
            },
            banner_url:{
                required:false  
            }            

        },
       /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#update_banner_form").validate({
        rules: {
            title:{
                required:true,
                validString:true
            },
            title_ar:{
                required:true
            },
            sub_title:{
                required:true,
                validString:true
            },
            sub_title_ar:{
                required:true
            },
            image:{
                required:false,
                extension:true,
                filesize:true
            },
            banner_url:{
                required:false  
            }  

        },
        /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    /* Banner form-validation js end */

     /* Faq form-validation js start */
    $("#save_faq_form").validate({
        rules: {
            question:{
                required:true
            },
            question_ar:{
                required:true
            },
            answear:{
                required:true
            },
            answear_ar:{
                required:true
            }

        },
        /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#update_faq_form").validate({
        rules: {
            question:{
                required:true
            },
            question_ar:{
                required:true
            },
            answear:{
                required:true
            },
            answear_ar:{
                required:true
            }

        },
        /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    /* Faq form-validation js end */

    /* Terms and Conditions form-validation js start */
     $("#update_terms_conditions_form").validate({
        ignore: [],
        debug: false,
        rules: {
            title:{
                required:true
            },           
            description:{
                required: function() 
               {
                CKEDITOR.instances.description.updateElement();
               },

           }
        },
        /* For custom messages */
        messages: {
            description:{
                required: (lang == "en") ?'هذه الخانة مطلوبه.':'This field is required.',
            }
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#save_terms_conditions_form").validate({
        ignore: [],
        debug: false,
        rules: {
            title:{
                required:true
            },           
            description:{
                required: function() 
               {
                CKEDITOR.instances.description.updateElement();
               },

           }
        },
        /* For custom messages */
        messages: {
            description:{
                required: (lang == "en") ?'هذه الخانة مطلوبه.':'This field is required.',
            }
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    /* Terms and Conditions form-validation js end */

    /* Customer Help form-validation  */
    $("#save_customer_help_form").validate({
        ignore: [],
        debug: false,
        rules: {           
            customer_help:{
                required: function() 
               {
                CKEDITOR.instances.customer_help.updateElement();
               },

           }          

        },
        /* For custom messages */
        messages: {
            customer_help:{
                required: (lang == "en") ?'هذه الخانة مطلوبه.':'This field is required.',
            },
          
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#update_customer_help_form").validate({
        ignore: [],
        debug: false,
        rules: {           
            customer_help:{
                required: function() 
               {
                CKEDITOR.instances.customer_help.updateElement();
               },

           }          

        },
        /* For custom messages */
        messages: {
            customer_help:{
                required: (lang == "en") ?'هذه الخانة مطلوبه.':'This field is required.',
            },
          
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    /* Customer Help form-validation End*/

    /* About Us form-validation js start */
    $("#save_about_us_form").validate({
        ignore: [],
        debug: false,
        rules: {
            title:{
                required:true
            },
            image:{
                required:true
            },
            short_description:{
                required:true
            },
            long_description:{
                required:true
            }

        },
        /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#update_about_us_form").validate({
        ignore: [],
        debug: false,
        rules: {
            title:{
                required:true
            },
            image:{
                required:false
            },
            short_description:{
                required: function() 
               {
                CKEDITOR.instances.short_description.updateElement();
               },

            },
            long_description:{
                required: function() 
               {
                CKEDITOR.instances.long_description.updateElement();
               },

           }          

        },
        /* For custom messages */
        messages: {
            short_description:{
                required: (lang == "en") ?'هذه الخانة مطلوبه.':'This field is required.',
            },
            long_description:{
                required: (lang == "en") ?'هذه الخانة مطلوبه.':'This field is required.',
            }
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    /* About Us form-validation js end */ 
    
    /* gift card form-validation js start */
    $("#save_gift_card_form").validate({
        rules: {
            name:{
                required:true,
                validString:true
            },   
            name_ar:{
                required:true
            },       
            image:{
                required:true,
                extension:true,
                filesize:true
            },
            start_date:{
                required:true  
            },
            expiry_date:{
                required:true  
            }               

        },
        /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#update_gift_card_form").validate({
        rules: {
            name:{
                required:true,
                validString:true
            },          
            name_ar:{
                required:true
            }, 
            image:{
                required:false,
                extension:true,
                filesize:true
            },
            start_date:{
                required:true  
            },
            expiry_date:{
                required:true  
            }       

        },
        /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    /* gift card form-validation js end */

    /* Advertasement form-validation js start */
    $("#save_advertisement_form").validate({
        rules: {
            add_img:{
                required:true,
                extension:true,
                filesize:true
            },
            title:{
                required:true,
                validString:true
            },
            sub_title:{
                required:true,
                validString:true
            },
            title_ar:{
                required:true
            },
            sub_title_ar:{
                required:true
            },
            advertise_link:{
                required:true  
            },           
            add_position:{
                required:true  
            }            

        },
        /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#update_advertisement_form").validate({
        rules: {
            add_img:{
                required:false,
                extension:true,
                filesize:true
            },
            title:{
                required:true,
                validString:true
            },
            sub_title:{
                required:true,
                validString:true
            },
            title_ar:{
                required:true
            },
            sub_title_ar:{
                required:true
            },
            advertise_link:{
                required:true  
            },            
            add_position:{
                required:true  
            }   

        },
        /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    /* Advertasement form-validation js end */

    $("#user_set_new_password_form").validate({
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
        /* For custom messages */
        messages: {
            cnf_password:(lang == "en") ?'يجب أن تكون كلمة المرور وتأكيد كلمة المرور متطابقة.كلمة المرور':'Password & confirm Password should be same.'
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });

    
    $("#user_login_form").validate({
        rules: {
            email:{
                required:true
            },
            password:{
                required:true,
                minlength: 6
            }

        },
        /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
            
        }
    });

    $("#update_user_profile_form").validate({
        rules: {           
            name:{
                required:true,
                validString:true
            },
            email:{
                required:true
            },            
            addr_residential:{
                required:true
            },
            gender:{
                required:true
            },
            addr_permanent:{
                required:true,
                maxlength: 50
            },           
            contact_no:{
                required:true,
                number: true,
		        minlength: 9,
		        maxlength: 10
            },  
            role_id:{
                required:true
            }, 
            date_of_birth:{
                required:true
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
                digits:true
            },
            social_fb_link:{
                required:true 
            },
            social_linkedin_link:{
                required:true
            },
            social_twitter_link:{
                required:true
            },           
            social_skype_link:{
                required:true
            }


        },
        /* For custom messages */
        messages: {
            'address':{
                maxlength:(lang == "en") ?'يجب ألا يزيد العنوان عن 50 حرفًا.':"Address should not be greater than 50 characters."
            }
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });

    /* Change User Password form-validation js Start */
    $("#update_user_change_password_form").validate({
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
        /* For custom messages */
        messages: {
            cnf_password:(lang == "en") ?'يجب أن تكون كلمة المرور وتأكيد كلمة المرور متطابقة.':"Password & Confirm Password should be same.",
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });

    /* Change User Password form-validation js end */
    /* Reply contact us form form-validation js start */
    $("#reply_contact_form").validate({
        rules: {
            
            admin_reply:{
                required:true
            }

        },
        /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    /* Reply contact us form form-validation js End */

    $("#user_profile_picture").validate({
        rules: {            
            profile_image:{
                required:true,
                extension:true,
                filesize:true               
            }
        },
        /* For custom messages */
        messages: {
            
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if(placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });   

});