$(document).ready(function () {

    let base_url = window.location.origin;    
    let current_lang = $('html')[0].lang;
    let processing = 'Processing...';
    let selectCountry = 'Select Country';
    let selectState = 'Select State';
    let selectCity = 'Select City';    

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
                    imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
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
                    imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
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
    
    $('input[name="free_paid_flag"]').click(function(){       
        var free_paid_flag = $("input[name='free_paid_flag']:checked").val();        
        if(free_paid_flag == 2){
            $("#cost").show();
        }else{
            $("#template_cost").val(0);
            $("#cost").hide();
        }        
    });

    var free_paid_flag = $("input[name='free_paid_flag']:checked").val();
        if(free_paid_flag == 1){
            $("#cost").hide();
        }else{
            $("#cost").show();
        }
   
    /* add-remove-input-field-dynamically-with-jquery start*/
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $("#planFeaturesWrapper"); //Fields wrapper
        var add_button      = $("#addMoreFeaturesBtn"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append(
                    '<div class="featureItem">'+
                        '<div class="row">'+
                            '<div class="col-md-5">'+
                                '<div class="form-group">'+
                                    '<input type="text" class="form-control" id="feature_name_en" placeholder="Enter Feature In English" name="feature_name_en[]" autocomplete="off">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-5">'+
                                '<div class="form-group">'+
                                    '<input type="text" class="form-control" id="feature_name_ar" placeholder="Enter Feature In Arabic" name="feature_name_ar[]" autocomplete="off">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-2">'+
                                '<a href="javascript:void(0);" class="btn btn-danger removePlanFeature">X</a>'+
                            '</div>'+
                        '</div>'+
                    '</div>'); //add input box
            }
        });

        $(wrapper).on("click",".removePlanFeature", function(e){ //user click on remove text
            e.preventDefault(); 
            $(this).closest('div.featureItem').remove();
            x--;
        });

    /* add-remove-input-field-dynamically-with-jquery end*/   

    Chart.register(ChartDataLabels); /** Chart Value Shows On Chart */

    //Contact Us replay
    $("#replayadmin").click(function(){
        alert(1111);
        $("#replayEmail").show();
    }); 
    
});

$(function () {
  //Initialize Select2 Elements
  $('.select2').select2()
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

    $('#start_date').attr('min', maxDate);
    $('#expiry_date').attr('min', maxDate);
});

function drawLineChart(id,chartData,label,chartName,yAxesLabel,xAxesLabel) {
    let lineChartData = chartData.split(',');
    let GetChartId = id;

    new Chart(GetChartId, {        
        type : 'line', 
              
        data : {
            labels : label,
            datasets : [
                    {
                        data : lineChartData,
                        //data : [ ,45,30,40,30,55,30,45,12,54,13,15,3],
                        label : '',
                        borderColor: ['gold'],
                        borderWidth: 2,
                        pointRadius: 1,
                        
                        fill : false
                    }]
        },
        options : {           
                      
            plugins: {
                datalabels: {
                    anchor: 'end',
                    align: 'top',
                    formatter: Math.round,
                    font: {
                        weight: 'bold',
                        size: 16
                    }
                },
                legend: {
                    display: false,
                },            
            },
            scales: {
                y: {
                  title: {
                    display: true,
                    text: yAxesLabel
                  }
                },
               x: {
                  title: {
                    display: true,
                    text: xAxesLabel
                  }
                }
            }
                   
        }
    });
    
}
function drawBarChart(id,chartData,label,chartName,yAxesLabel,xAxesLabel) {
    let lineChartData = chartData.split(',');
    //let lineLabel = label.split(',');
    let GetChartId = id;
    new Chart(GetChartId, {
		type: 'bar',
		data: {
		labels: label,
		
		datasets: [{
			label: '',
			data: lineChartData,		
			borderWidth: 1
		}]
		},
		options: {
            legend: {
                display: false
            },            
            plugins: {
                datalabels: {
                    anchor: 'end',
                    align: 'top',
                    formatter: Math.round,
                    font: {
                        weight: 'bold',
                        size: 16
                    }
                },
                legend: {
                    display: false,
                },          
            },
            scales: {
                y: {
                  title: {
                    display: true,
                    text: yAxesLabel
                  }
                },
               x: {
                  title: {
                    display: true,
                    text: xAxesLabel
                  }
                }
            }
		}
	});
}
function drawMixedChart(id,chartDataLine,chartDataBar,label,chartName,yAxesLabel,xAxesLabel){
    let lineChartline = chartDataLine.split(',');
    let lineChartbar = chartDataBar.split(',');
    //let lineLabel = label.split(',');
    let GetChartId = id;
    var chartIds = new Chart(GetChartId, {
         type: 'scatter',
         data: {
			datasets: [{
            type: 'bar',
            label: 'Order',
            data: lineChartbar
            //data: [12,15,20,0,55,30,22,24,20,19,30,13]
        }, {
            type: 'line',
            label: 'Sales',
            data: lineChartline,
            //data: [45,30,40,30,25,15,66,12,54,13,15,3],
        }],
        labels: label
         },
         options: {
            //responsive: false,
            legend: {
                display: false
            },            
            plugins: {
                datalabels: {
                    anchor: 'end',
                    align: 'top',
                    formatter: Math.round,
                    font: {
                        weight: 'bold',
                        size: 16
                    }
                },            
            },            
            scales: {
                y: {
                beginAtZero: true,
                  title: {
                    display: true,
                    text: yAxesLabel
                  }
                }
            }
         },
    });
}

  
