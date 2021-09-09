var tbl_reports;

$(document).ready(function () {
    load_stat();
    tbl_reports = $("#tbl_pending_reports").DataTable({
        ajax: '/api/reports/list/1',
        order: [[ 0, "desc" ]],
        dom:'Bfrtip',
        scrollX:true,
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "columns": [
            {"data": "id"},
            {"data": null, render:function(row){
                return '<a class="link-fx" onclick="user_detail('+row.user_id+')" href="javascript:void(0)">'+row.first_name + ' ' + row.last_name+'</a>';
                }},
            {"data": "report_type", render: function (row) {
                switch (row) {
                    case "1":
                        return 'BAD CONDITION';
                    case "2":
                        return 'ABANDONED';
                    case "3":
                        return 'STRAY';
                    default:
                        return 'UNKNOW';
                }

            }},
            {"data": "full_addr"},
            {"data": "created_at"},
            {"data": "status", render:function (row) {
                switch (row) {
                    case "1":
                        return '<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">Pending</span>';
                    case "2":
                        return '<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-primary-light text-primary">WORKING</span>';
                    case "3":
                        return '<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success">Closed</span>';
                    case "4":
                        return '<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-success">DELETED</span>';
                    default:
                        return 'UNKNOW';
                }
            }},
            {"data": null, render:function (row) {
                if ( row.status > "1") {
                    return '<a class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-report-detail" onclick="load_report_detail('+ row.id +')"><i class="fa fa-glasses"></i></a>';
                } else {
                    return '<a class="btn btn-sm btn-danger"><i class="fa fa-window-close"></i></a>&nbsp;' +
                        '<a data-bs-toggle="modal" data-bs-target="#modal-report-detail" onclick="load_report_detail('+ row.id +')" class="btn btn-sm btn-primary"><i class="fa fa-glasses"></i></a>';
                }

            }},
        ]
    });
});

function load_stat(){
    $.get('/statistics/reports/total', function(data){
        $("#lbl_pending_reports").text(data.total_pending);
        $("#lbl_working_closed").text(data.total_working + "/" + data.total_closed);
        $("#lbl_total_reports").text(parseInt(data.total_pending) + parseInt(data.total_working)+parseInt(data.total_closed));
    });

    $.get('/statistics/user/total', function(data){
        $("#lbl_reporters").text(data.total_user);
    });
}

function load_report_detail(id)
{
    $("#loader").show();
    $.get('/api/reports/detail/'+id, function (report) {
        switch (report.report_type) {
            case "1":
                $("#report_type").text('BAD CONDITION');
            case "2":
                $("#report_type").text('ABANDONED');
            case "3":
                $("#report_type").text('STRAY');
            default:
                $("#report_type").text('UNKNOW');
        }

        let photo;
        let extension;

        photo = report.photo.substr(0, report.photo.indexOf('.'));
        extension = report.photo.split(".").pop();

        $("#photo").attr('src', '/api/img/'+ photo + "/" + extension);

        $("#notes").val(report.notes);

        $("#coordinates").text(report.lat + " " + report.lon);

        $("#full_addr").text(report.full_addr);

        $("#created_at").text(report.created_at);

        $("#map").html('<iframe width="100%" height="auto" id="gmap_canvas" src="https://maps.google.com/maps?q='+report.lat+','+report.lon+'&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>');

        $("#loader").hide();
    });
}

setInterval(function(){
    load_stat();
    tbl_reports.ajax.reload(null, false);
}, 5000);

function user_detail(user_id){
    alert(user_id);
}