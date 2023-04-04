$(document).ready(function(){
    let current_lang = $('html')[0].lang;
    let sProcessing = "";
    let sLengthMenu = "";
    let sZeroRecords = "";
    let sInfo = "";
    let sInfoEmpty = "";
    let sInfoFiltered = "";
    let sInfoPostFix = "";
    let sSearch = "";
    let sUrl = "";
    let oPaginate = "";

    if (current_lang == 'ar') {
        sProcessing = "جارٍ التحميل...";
        sLengthMenu = "أظهر _MENU_ مدخلات";
        sZeroRecords = "لم يعثر على أية سجلات";
        sInfo = "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل";
        sInfoEmpty = "يعرض 0 إلى 0 من أصل 0 سجل";
        sInfoFiltered = "(منتقاة من مجموع _MAX_ مُدخل)";
        sInfoPostFix = "";
        sSearch = "ابحث:";
        sUrl = "";
        oPaginate = {'sFirst': "الأول", 'sPrevious': "السابق", 'sNext': "التالي", 'sLast': "الأخير"};
    } else {
        sProcessing = "loading ...";
        sLengthMenu = "Show _MENU_ Input";
        sZeroRecords = "No records found";
        sInfo = "Show _START_ to _END_ out of _TOTAL_ entry";
        sInfoEmpty = "Displaying 0 to 0 out of 0 records";
        sInfoFiltered = "(selected from sum of _MAX_ entered)";
        sInfoPostFix = "";
        sSearch = "Search:";
        sUrl = "";
        oPaginate = {'sFirst': "first", 'sPrevious': "previous", 'sNext': "next", 'sLast': "last"};
    }

    $('#viewAllMyOrderList').DataTable({
        "paging": true,
        "deferRender": true,
        "lengthChange": true,
        "searching": true,
        "info": true,
        "dom": 'Bfrtip',
        "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "pageLength": 10,
        "processing": true,
        'language': {
            'sProcessing': sProcessing,
            'sLengthMenu': sLengthMenu,
            'sZeroRecords': sZeroRecords,
            'sInfo': sInfo,
            'sInfoEmpty': sInfoEmpty,
            'sInfoFiltered': sInfoFiltered,
            'sInfoPostFix': sInfoPostFix,
            'sSearch': sSearch,
            'sUrl': sUrl,
            'oPaginate': oPaginate
        }
    });
    $('#viewAllGiftOrderHistortyList').DataTable({
        "paging": true,
        "deferRender": true,
        "lengthChange": true,
        "searching": true,
        "info": true,
        "dom": 'Bfrtip',
        "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "pageLength": 10,
        "processing": true,
        'language': {
            'sProcessing': sProcessing,
            'sLengthMenu': sLengthMenu,
            'sZeroRecords': sZeroRecords,
            'sInfo': sInfo,
            'sInfoEmpty': sInfoEmpty,
            'sInfoFiltered': sInfoFiltered,
            'sInfoPostFix': sInfoPostFix,
            'sSearch': sSearch,
            'sUrl': sUrl,
            'oPaginate': oPaginate
        }
    }); 
 
    // var table = $('#viewAllMyOrderList').DataTable(); 
    // if ( ! table.data().count() ) {
    //     table.buttons( $('a.dt-button.csv') ).disable();
    // }

});