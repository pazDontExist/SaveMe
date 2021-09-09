function update_password(){
    $("#change_password_result").html('<div class="spinner-border text-info" role="status">\n' +
        '                    <span class="visually-hidden">Loading...</span>\n' +
        '                  </div>');

    if ( $('#one-profile-edit-password-new').length < 5 ) {
        $("#change_password_result").html('<div class="alert alert-danger alert-dismissible" role="alert">\n' +
            '                    <p class="mb-0">\n' +
            '                      Password must be at least 5 char long!\n' +
            '                    </p>\n' +
            '                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\n' +
            '                  </div>');
        return;
    }

    if( !$("#one-profile-edit-password-new").val() || !$("#one-profile-edit-password-new-confirm").val()){
        $("#change_password_result").html('<div class="alert alert-danger alert-dismissible" role="alert">\n' +
            '                    <p class="mb-0">\n' +
            '                      All fields are mandatory!\n' +
            '                    </p>\n' +
            '                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\n' +
            '                  </div>');
        return;
    }

    if(!$("#one-profile-edit-password-new").val() != !$("#one-profile-edit-password-new-confirm").val()){
        $("#change_password_result").html('<div class="alert alert-danger alert-dismissible" role="alert">\n' +
            '                    <p class="mb-0">\n' +
            '                      Password dont\'t match!\n' +
            '                    </p>\n' +
            '                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\n' +
            '                  </div>');
        return;
    }

    $.post('/api/user/password/update', {
        password:$("#one-profile-edit-password-new-confirm").val()
    }, function(resp){
        if ( resp.status == 'success') {
            $("#change_password_result").html('<div class="alert alert-success alert-dismissible" role="alert">\n' +
                '                    <p class="mb-0">\n' +
                '                      '+resp.message+'\n' +
                '                    </p>\n' +
                '                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\n' +
                '                  </div>');
        } else {
            $("#change_password_result").html('<div class="alert alert-danger alert-dismissible" role="alert">\n' +
                '                    <p class="mb-0">\n' +
                '                      '+resp.message+'\n' +
                '                    </p>\n' +
                '                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\n' +
                '                  </div>');
        }
    });


}

function update_basic_info(){
    $("#basic_info_result").html('<div class="spinner-border text-info" role="status">\n' +
        '                    <span class="visually-hidden">Loading...</span>\n' +
        '                  </div>');

    if(!$("#one-profile-edit-name").val() || !$("#one-profile-edit-surname").val() || !$("#one-profile-edit-email").val() ) {
        $("#basic_info_result").html('<div class="alert alert-danger alert-dismissible" role="alert">\n' +
            '                    <p class="mb-0">\n' +
            '                      All fields are mandatory!\n' +
            '                    </p>\n' +
            '                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\n' +
            '                  </div>');
        return;
    }

    $.post('/api/user/update', {
        first_name:$("#one-profile-edit-name").val(),
        last_name:$("#one-profile-edit-surname").val(),
        email:$("#one-profile-edit-email").val()
    }, function(resp){
            if(resp.status == 'success') {
                $("#basic_info_result").html('<div class="alert alert-success alert-dismissible" role="alert">\n' +
                    '                    <p class="mb-0">\n' +
                    '                      '+resp.message+'\n' +
                    '                    </p>\n' +
                    '                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\n' +
                    '                  </div>');
            } else {
                $("#basic_info_result").html('<div class="alert alert-danger alert-dismissible" role="alert">\n' +
                    '                    <p class="mb-0">\n' +
                    '                      '+resp.message+'!\n' +
                    '                    </p>\n' +
                    '                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\n' +
                    '                  </div>');
            }
    });
}