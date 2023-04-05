$(document).ready(function () {

    let base_url = window.location.origin;

    let current_lang = $('html')[0].lang;
    let processing = '';
    let selectCountry = '';
    let selectState = '';
    let selectCity = '';

    if (current_lang == 'en') {
        processing = 'Processing...';
        selectCountry = 'Select Country';
        selectState = 'Select State';
        selectCity = 'Select City';
    } else {
        processing = 'يعالج...';
        selectCountry = 'اختر الدولة';
        selectState = 'اختر ولاية';
        selectCity = 'اختر مدينة';
    }

    $('#country_id').change(function (e) {
        e.preventDefault();
        let country_id = $(this).val();
        var action_page = $(this).data('actionurl');
        let requestData = 'country_id=' + country_id;
        $.ajax({
            url: action_page,
            type: "POST",
            enctype: 'multipart/form-data',
            data: requestData,
            beforeSend: function () {
                swal({
                    title: '',
                    text: processing,
                    imageUrl: base_url + "/assets/images/loader/matjary-loader.gif",
                    buttons: false,
                    closeOnClickOutside: false,
                    timer: 1000,
                    showCancelButton: false,
                    showConfirmButton: false
                });
            },
            success: function (resp) {
                respData = JSON.parse(resp);
                if (respData.responseCode == 200) {
                    $("#state_id").empty('');
                    $("#state_id").append('<option value="">' + selectState + '</option>');
                    let stateList = respData.responseData;
                    $.each(stateList, function (key, value) {
                        $("#state_id").append('<option value=' + value.id + '>' + value.name + '</option>');
                    });
                } else {
                    //swal({title: "Fail", text: respData.responseMessage, type: "error"});
                }
            }
        });
    });

    $('#state_id').change(function (e) {
        e.preventDefault();
        let state_id = $(this).val();
        var action_page = $(this).data('actionurl');
        let requestData = 'state_id=' + state_id;
        $.ajax({
            url: action_page,
            type: "POST",
            enctype: 'multipart/form-data',
            data: requestData,
            beforeSend: function () {
                swal({
                    title: '',
                    text: processing,
                    imageUrl: base_url + "/assets/images/loader/matjary-loader.gif",
                    buttons: false,
                    closeOnClickOutside: false,
                    timer: 1000,
                    showCancelButton: false,
                    showConfirmButton: false
                });
            },
            success: function (resp) {
                respData = JSON.parse(resp);
                if (respData.responseCode == 200) {
                    $("#city_id").empty('');
                    $("#city_id").append('<option value="">' + selectCity + '</option>');
                    let stateList = respData.responseData;
                    $.each(stateList, function (key, value) {
                        $("#city_id").append('<option value=' + value.id + '>' + value.name + '</option>');
                    });
                } else {
                    //swal({title: "Fail", text: respData.responseMessage, type: "error"});
                }
            }
        });
    });

});

window.onload = () => {
    const sub_domain_name = document.getElementById('sub_domain_name');
    if (sub_domain_name !== null) {
        sub_domain_name.onpaste = e => e.preventDefault();
    }
}

window.onload = () => {
    const free_trial_domain = document.getElementById('free_trial_domain');
    if (free_trial_domain !== null) {
        free_trial_domain.onpaste = e => e.preventDefault();
    }
}
