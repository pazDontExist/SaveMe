function address_to_coord(address){
    $.get('https://geocode.search.hereapi.com/v1/geocode?q='+$("#full_addr").val() + '&apiKey=5sErVRExWWS1Geh4LKSGI_Ba_6KXF5a4nfl7tWREz_c', function(data){
        $("#lat").val(data.items[0].position.lat)
        $("#lon").val(data.items[0].position.lng)
    });
}

function set_position(){
    if (navigator.geolocation) {
        $("#full_addr").val("Loading...");
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Cannot access the geolocation");
    }
}

function showPosition(position){
    $("#lat").val(position.coords.latitude);
    $("#lon").val(position.coords.longitude);
    $.get('https://revgeocode.search.hereapi.com/v1/revgeocode?at='+position.coords.latitude+'%2C'+position.coords.longitude+'&lang=en-US&apiKey=5sErVRExWWS1Geh4LKSGI_Ba_6KXF5a4nfl7tWREz_c', function(resp){
        $("#full_addr").val(resp.items[0].title);
    });
}

$(function() {
    $("#frm_new_report").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: '/api/reports/new',
            data: formData,
            processData: false,
            contentType: false,
        }).done(function(data){
            console.log(data);
            if ( data.status == 'success'){
                Swal.fire("Success!", 'report inserted successfully', 'success');
                document.getElementById("frm_new_report").reset();
            } else {
                Swal.fire("Whoops!", 'Something went wrong, try again later', 'error');
            }
        }).fail(function(e){
            Swal.fire("Whoops!", 'Something went wrong, try again later...', 'error');
        });
    });

});