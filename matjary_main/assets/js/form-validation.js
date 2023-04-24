$(document).ready(function () {

    let current_lang = $('html')[0].lang;
    let validPwd = '';
    let validCnfPwd = '';
    let pwdLength = '';
    let pwdUpper = '';
    let pwdLower = '';
    let pwdNumber = '';
    let pwdSpecial = '';
    let validEmail = '';
    let validStore = '';
    let validZip = '';
    let validCountry = '';
    let validCity = '';
    let validState = '';
    let validFname = '';
    let validLname = '';
    let validAddress = '';
    let validPhone = '';
    let validName = '';
    let validQuery = '';
    console.log(current_lang);
    if (current_lang == 'en') {
        validPwd = 'Please Enter a valid Password';
        validCnfPwd = 'Confirm password must be same as new password';
        pwdLength = 'Password Must be of length between 8 and 16 characters.';
        pwdUpper = 'Must Contain least one uppercase character.';
        pwdLower = 'Must Have least one lowercase character.';
        pwdNumber = 'Must Have a number.';
        pwdSpecial = 'Must Have at least one special character: !@#$%^&()’[]”?+-/*';
        validEmail = 'Enter a Valid Email';
        validStore = 'Enter Store Name';
        validZip = 'Please enter Zipcode';
        validCountry = 'Select Country';
        validState = 'Select State';
        validCity = 'Select city';
        validFname = 'Please enter your firstname';
        validLname = 'Please enter your lastname';
        validAddress = 'Please enter your address';
        validPhone = 'Please enter valid phone no.';
        validName = 'Please enter your name';
        validQuery = 'Please enter your query';
    } else if (current_lang == 'ar') {
        validPwd = 'الرجاء إدخال كلمة السر الصحيحة';
        validCnfPwd = 'تأكيد كلمة المرور لا يتطابق';
        pwdLength = 'يجب أن يتراوح طول كلمة المرور بين8 و 16 حرفًا';
        pwdUpper = 'يجب أن يحتوي على حرف كبير واحد على الأقل';
        pwdLower = 'يجب أن يحتوي على حرف صغير واحد على الأقل.';
        pwdNumber = 'يجب أن يكون لديك رقم';
        pwdSpecial = "يجب أن يكون لديك حرف خاص واحد على الأقل :! @ # $٪ ^ & () '[]'؟ + - / *";
        validEmail = 'أدخل بريد إلكتروني متاح';
        validStore = 'أدخل اسم المتجر';
        validZip = 'الرجاء إدخال الرمز البريدي';
        validCountry = 'اختر الدولة';
        validState = 'اختر ولاية';
        validCity = 'اختر مدينة';
        validFname = 'الرجاء إدخال الاسم الأول';
        validLname = 'الرجاء إدخال اسمك الأخير';
        validAddress = 'الرجاء إدخال عنوانك';
        validPhone = 'يرجى إدخال رقم هاتف صالح';
        validName = 'يرجى إدخال اسمك';
        validQuery = 'الرجاء إدخال الاستعلام الخاص بك';
    }

    /*custom regex validation for password in my profile*/
    $.validator.addMethod("regexp", function (value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    }, "");

    /* check valid strong passsword start */
        $.validator.addMethod("pwdLength", function (value, element) {
                return this.optional(element) || /^.{8,16}$/.test(value);
        }, pwdLength);

        $.validator.addMethod("pwdUpper", function (value, element) {
                return this.optional(element) || /[A-Z]+/.test(value);
        }, pwdUpper);

        $.validator.addMethod("pwdLower", function (value, element) {
                return this.optional(element) || /[a-z]+/.test(value);
        }, pwdLower);

        $.validator.addMethod("pwdNumber", function (value, element) {
                return this.optional(element) || /[0-9]+/.test(value);
        }, pwdNumber);

        $.validator.addMethod("pwdSpecial", function (value, element) {
                return this.optional(element) || /[!@#$%^&()'[\]"?+-/*={}.,;:_]+/.test(value);
        }, pwdSpecial);
        /* check valid strong passsword end */

    $("#save_user_form").validate({
        rules: {
            fname: {
                required: true
            },
            lname: {
                required: true
            },
            email: {
                required: true
            },
            phone_no: {
                required: true,
                minlength: 9,
                maxlength: 10
            },
            password: {
                required: true,
                pwdLength: true,
                pwdUpper: true,
                pwdLower: true,
                pwdNumber: true,
                pwdSpecial: true,
                minlength: 8,
                maxlength: 16
            },
            passconf: {
                required: true,
                equalTo: '[name="password"]',
                minlength: 8,
                maxlength: 16
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

    $("#user_login_form").validate({
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

    $("#update_user_profile_form").validate({
        rules: {
            fname: {
                required: true
            },
            lname: {
                required: true
            },
            email: {
                required: true
            },
            address: {
                required: true
            },
            country: {
                required: true
            },
            state: {
                required: true
            },
            city: {
                required: true
            },
            zipcode: {
                required: true
            },
            phone_no: {
                required: true,
                minlength: 9,
                maxlength: 10
            },
            fax_no: {}
        },
        messages: {
            fname: validFname,
            lname: validLname,
            email: validEmail,
            address: validAddress,
            country: validCountry,
            state: validState,
            city: validCity,
            zipcode: validZip,
            phone_no: validPhone
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

    $("#update_usr_pro_pass_frm").validate({
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

    $("#proceed_payment_form, #proceed_template_payment_form").validate({
        rules: {
            b_fname: {
                required: true
            },
            b_lname: {
                required: true
            },
            b_email: {
                required: true
            },
            b_tel: {
                required: true,
                minlength: 9,
                maxlength: 10
            },
            b_address: {
                required: true
            },
            b_country: {
                required: true
            },
            b_state: {
                required: true
            },
            b_city: {
                required: true
            },
            b_zipcode: {
                required: true
            }
        },
        messages: {
            b_fname: validFname,
            b_lname: validLname,
            b_email: validEmail,
            b_tel: validPhone,
            b_address: validAddress,
            b_country: validCountry,
            b_state: validState,
            b_city: validCity,
            b_zipcode: validZip
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

    $("#submit_contact_form").validate({
        rules: {
            cont_name: {
                required: true
            },
            cont_email: {
                required: true
            },
            con_phone_no: {
                required: true,
                minlength: 9,
                maxlength: 10
            },
            cont_subject: {
            },
            cont_message: {
                required: true
            }
        },
        messages: {
            cont_name: validName,
            cont_email: validEmail,
            con_phone_no: validPhone,
            cont_subject: "",
            cont_message: validQuery
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

    $("#free_trial_form").validate({
        rules: {
            fname: {
                required: true
            },
            lname: {
                required: true
            },
            email: {
                required: true
            },
            phone_no: {
                required: true,
                minlength: 9,
                maxlength: 10
            },
            password: {
                required: true,
                pwdLength: true,
                pwdUpper: true,
                pwdLower: true,
                pwdNumber: true,
                pwdSpecial: true,
                minlength: 8,
                maxlength: 16
            },
            passconf: {
                required: true,
                equalTo: '[name="password"]',
                minlength: 8,
                maxlength: 16
            },

            free_trial_domain: {
                required: true
            }
        },
        messages: {
            free_trial_email: validEmail,
            free_trial_domain: validStore
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

    $("#send_reset_password_link").validate({
        rules: {
            reset_pwd_email: {
                required: true,
                email: true
            }
        },
        messages: {
            reset_pwd_email: validEmail
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

    $("#set_usr_reset_password").validate({
        rules: {
            new_rst_pwd: {
                required: true,
                pwdLength: true,
                pwdUpper: true,
                pwdLower: true,
                pwdNumber: true,
                pwdSpecial: true,
                minlength: 8,
                maxlength: 16
            },
            cnf_new_rst_pwd: {
                required: true,
                equalTo: '[name="new_rst_pwd"]',
                minlength: 8,
                maxlength: 16
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

    $("#save_newsletter_email_form").validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            email: validEmail
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

    $("#submit_customer_enquiry_form").validate({
        rules: {            
            cont_subject: {
            },
            cont_message: {
                required: true
            }
        },
        messages: {          
            cont_subject: "",
            cont_message: validQuery
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