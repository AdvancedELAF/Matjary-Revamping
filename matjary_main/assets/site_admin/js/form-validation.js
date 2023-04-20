$(document).ready(function () {
    let validPwd = '';
    let validCnfPwd = '';

    validPwd = 'Please Enter a valid Password';
    validCnfPwd = 'Confirm password must be same as new password';

    $.validator.addMethod("validString", function(value, element) {
        /* allow any non-whitespace characters as the host part */
        /*return this.optional( element ) || /^[a-zA-Z0-9- ]*$/.test( value ); */
        return this.optional( element ) || /^[\u0621-\u064Aa-zA-Z0-9- ]*$/.test( value ); /* allow arabic characters as well */
    }, 'Your input string contains illegal characters.');
    /* check valid strong passsword start */
    $.validator.addMethod("pwdLength", function(value, element) {
        return this.optional( element ) || /^.{8,16}$/.test( value );
    },'Expect a password length between 8 and 16 characters.');
    $.validator.addMethod("pwdUpper", function(value, element) {
        return this.optional( element ) || /[A-Z]+/.test( value );
    }, 'Expect at least one uppercase character.');
    $.validator.addMethod("pwdLower", function(value, element) {
        return this.optional( element ) || /[a-z]+/.test( value );
    }, 'Expect at least one lowercase character.');
    $.validator.addMethod("pwdNumber", function(value, element) {
        return this.optional( element ) || /[0-9]+/.test( value );
    }, 'Expect a number.');
    $.validator.addMethod("pwdSpecial", function(value, element) {
        return this.optional( element ) || /[!@#$%^&()'[\]"?+-/*={}.,;:_]+/.test( value );
    }, 'Expect at least one special character: !@#$%^&()’[]”?+-/*');
    /* check valid strong passsword end */

    $.validator.addMethod('greaterThan', function(value, element) {
        var dateFrom = $("#start_date").val();
        var dateTo = $('#expiry_date').val();
        return dateTo >= dateFrom;
    });

    $("#chk_admin_login").validate({
        rules: {
            email: {
                required: true
            },
            password: {
                required: true
            }
        },
        messages: {

        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });

    $("#save_admin_user").validate({
        rules: {
            fname: {
                required: true,
                validString:true
            },
            lname: {
                required: true,
                validString:true
            },
            email: {
                required: true
            },
            phone_no: {
                required:true,
                digits:true,
                minlength: 9,
		        maxlength: 10
            },           
            address: {
                required: true,
                minlength: 2,
                maxlength: 30
            },
            country_id: {
                required: true
            },
            state_id: {
                required: true
            },
            city_id: {
                required: true
            },
            zipcode: {
                required: true,
                number:true,
                digits:true
            },
            fax_no: {
                required: true,
                number:true,
                digits:true
            }

        },
        messages: {

        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });

    $("#save_edit_admin_user").validate({
        rules: {
            fname: {
                required: true
            },
            lname: {
                required: true
            },
            phone_no: {
                required:true,
                digits:true,
                minlength: 9,
		        maxlength: 10
            },
            usr_role: {
                required: true
            },
            address: {
                required: true,
                minlength: 2,
                maxlength: 30
            },
            country_id: {
                required: false
            },
            state_id: {
                required: false
            },
            city_id: {
                required: false
            },
            zipcode: {
                required: true,
                number:true,
                digits:true
            },
            fax_no: {
                required: true,
                number:true,
                digits:true
            }

        },
        messages: {

        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    
    $("#set_admin_reset_password").validate({
        rules: {
            password:{
                required:true,
                pwdLength:true,
                pwdUpper:true,
                pwdLower:true,
                pwdNumber:true,
                pwdSpecial:true
            },
            conf_password:{
                required:true,
                equalTo : "#password",
                minlength: 6
            }
        },
        messages: {

        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });

    $("#save_template_category").validate({
        rules: {
            theme_cat_name: {
                required: true,
                validString:true
            },
            theme_cat_name_ar: {
                required: true,
                validString:true
            },
            is_active: {
                required: true
            }           

        },
        messages: {

        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#save_category").validate({
        rules: {
            theme_cat_name: {
                required: true,
                validString:true
            },
            theme_cat_name_ar: {
                required: true,
                validString:true
            },
            is_active: {
                required: true
            }           

        },
        messages: {

        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    }); 

    $("#save_template").validate({
        rules: {
            name: {
                required: true,
                validString:true
            },
            name_ar: {
                required: true,
                validString:true
            },
            template_half_banner: {
                required: true
            },
            template_full_banner: {
                required: true
            },
            category_id: {
                required: true
            },
            is_active: {
                required: true
            },
            free_paid_flag: {
                required: true
            },
            template_cost: {
                required: true,
                number:true,
                digits:true
            },
            demo_link: {
                required: true
            },
            description: {
                required: true
            },
            description_ar:{
                required: true
            },
            is_active: {
                required: true
            }           

        },
        messages: {

        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });

    $("#edit_save_template").validate({
        rules: {
            name: {
                required: true,
                validString:true
            },
            name_ar: {
                required: true,
                validString:true
            },
            template_half_banner: {
                required: false
            },
            template_full_banner: {
                required: false
            },
            category_id: {
                required: true
            },
            is_active: {
                required: true
            },
            free_paid_flag: {
                required: true
            },
            template_cost: {
                required: true,
                number:true,
                digits:true
            },
            demo_link: {
                required: true
            },
            description: {
                required: true
            },
            description_ar:{
                required: true
            },
            is_active: {
                required: true
            }           

        },
        messages: {

        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });

    $("#save_plan").validate({
        rules: {
            plan_name: {
                required: true
            },
            plan_desc: {
                required: true
            },
            price: {
                required: true
            },           
            validity_in_months: {
                required: true
            }                    

        },
        messages: {

        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });

    $("#update_plan").validate({
        rules: {
            plan_name: {
                required: true
            },
            plan_desc: {
                required: true
            },
            price: {
                required: true
            },           
            validity_in_months: {
                required: true
            }                    

        },
        messages: {

        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });

    $("#save_profile").validate({
        rules: {
            fname: {
                required: true
            },
            lname: {
                required: true
            },
            phone_no: {
                required:true,
                digits:true,
                minlength: 9,
		        maxlength: 10
            },
            // usr_role: {
            //     required: true
            // },
            address: {
                required: true
            },
            country_id: {
                required: true
            },
            state_id: {
                required: true
            },
            city_id: {
                required: true
            },
            zipcode: {
                required: true,
                number:true,
                digits:true
            },
            fax_no: {
                required: true,
                number:true,
                digits:true
            }

        },
        messages: {

        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });

    
    $("#change_admin_password").validate({
        rules: {
            old_pass: {
                required: true
            },
            new_pass: {
                required: true,
                pwdLength: true,
                pwdUpper: true,
                pwdLower: true,
                pwdNumber: true,
                pwdSpecial: true,
                minlength: 8,
                maxlength: 16
            },
            cnf_pass: {
                required: true,
                equalTo: '[name="new_pass"]',
                minlength: 8,
                maxlength: 16
            }
        },
        messages: {
            old_pass: validPwd,
            cnf_pass: validCnfPwd
        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });

    $("#save_coupon").validate({
        rules: {
            code: {
                required: true,
                validString:true,
                maxlength: 10
            },
            start_date: {
                required: true
            },
            expiry_date: {
                required: true,
                greaterThan: "#start_date"
            },
            discount_in_percent: {
                required:true,
                digits:true,
		        maxlength: 2
            },
            is_active: {
                required: true
            }
        },
        messages: {
            'expiry_date': {
                greaterThan: 'Please select expiry date greater than start date.' 
            }

        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    
    $("#save_employee").validate({
        rules: {
            fname: {
                required: true,
                validString:true
            },
            lname: {
                required: true,
                validString:true
            },
            role: {
                required: true
            },
            email: {
                required: true
            },
            phone_no: {
                required:true,
                digits:true,
                minlength: 9,
		        maxlength: 10
            },           
            address: {
                required: true,
                minlength: 2,
                maxlength: 30
            },
            country_id: {
                required: true
            },
            state_id: {
                required: true
            },
            city_id: {
                required: true
            },
            zipcode: {
                required: true,
                number:true,
                digits:true
            },
            fax_no: {
                required: true,
                number:true,
                digits:true
            }

        },
        messages: {

        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });

    $("#update_employee").validate({
        rules: {
            fname: {
                required: true
            },
            lname: {
                required: true
            },
            role: {
                required: true
            },
            phone_no: {
                required:true,
                digits:true,
                minlength: 9,
		        maxlength: 10
            },
            usr_role: {
                required: true
            },
            address: {
                required: true,
                minlength: 2,
                maxlength: 30
            },
            country_id: {
                required: false
            },
            state_id: {
                required: false
            },
            city_id: {
                required: false
            },
            zipcode: {
                required: true,
                number:true,
                digits:true
            },
            fax_no: {
                required: true,
                number:true,
                digits:true
            }

        },
        messages: {

        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });

    $("#reply_customer_enquiry").validate({
        rules: {
            admin_reply: {
                required: true
            }           

        },
        messages: {

        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    
});