<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>SaveMe - Registration</title>

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="/assets/media/favicons/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/assets/media/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/media/favicons/apple-touch-icon-180x180.png">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Fonts and OneUI framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="/assets/css/oneui.min.css">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/amethyst.min.css"> -->
    <!-- END Stylesheets -->
</head>
<body>

<div id="page-container">

    <!-- Main Container -->
    <main id="main-container">

        <!-- Page Content -->
        <div class="hero-static d-flex align-items-center">
            <div class="content">
                <div class="row justify-content-center push">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <!-- Sign Up Block -->
                        <div class="block block-rounded mb-0">
                            <div class="block-header block-header-default">
                                <h3 class="block-title"><?php echo __('Create Account');?></h3>
                                <div class="block-options">
                                    <a class="btn-block-option fs-sm" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#one-signup-terms">View Terms</a>
                                    <a class="btn-block-option" href="/public/login" data-bs-toggle="tooltip" data-bs-placement="left" title="Sign In">
                                        <i class="fa fa-sign-in-alt"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                                    <h1 class="h2 mb-1">SaveMe</h1>
                                    <p class="fw-medium text-muted">
                                        <?php echo __('Please fill the following details to create a new account.'); ?>
                                    </p>
                                    <div id="register_result"></div>

                                    <!-- Sign Up Form -->
                                    <!-- jQuery Validation (.js-validation-signup class is initialized in js/pages/op_auth_signup.min.js which was auto compiled from _js/pages/op_auth_signup.js) -->
                                    <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                    <form class="js-validation-signup" id="register_form">
                                        <div class="py-3">
                                            <div class="mb-4">
                                                <input type="text" class="form-control form-control-lg form-control-alt" id="signup-name" name="signup-name" placeholder="<?php echo __('Name');?>">
                                            </div>
                                            <div class="mb-4">
                                                <input type="text" class="form-control form-control-lg form-control-alt" id="signup-surname" name="signup-surname" placeholder="<?php echo __('Surname');?>">
                                            </div>
                                            <div class="mb-4">
                                                <input type="email" class="form-control form-control-lg form-control-alt" id="signup-email" name="signup-email" placeholder="Email">
                                            </div>
                                            <div class="mb-4">
                                                <input type="password" class="form-control form-control-lg form-control-alt" id="signup-password" name="signup-password" placeholder="Password">
                                            </div>
                                            <div class="mb-4">
                                                <input type="password" class="form-control form-control-lg form-control-alt" id="signup-password-confirm" name="signup-password-confirm" placeholder="Confirm Password">
                                            </div>
                                            <div class="mb-4">
                                                <select id="locale" class="form-control form-control-lg form-control-alt">
                                                    <option value="it_IT">ITALIANO</option>
                                                    <option value="en_EN">ENGLISH</option>
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="signup-terms" name="signup-terms">
                                                    <label class="form-check-label" for="signup-terms"><?php echo __('I agree to Terms &amp; Conditions');?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-12 col-xl-12">
                                                <a type="submit" onclick="register()" class="btn w-100 btn-alt-success">
                                                    <i class="fa fa-fw fa-plus me-1 opacity-50"></i> <?php echo __('Sign Up');?>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END Sign Up Form -->
                                </div>
                            </div>
                        </div>
                        <!-- END Sign Up Block -->
                    </div>
                </div>
                <div class="fs-sm text-muted text-center">
                    <strong>SaveMe 1.0</strong> &copy; <span data-toggle="year-copy"></span>
                </div>
            </div>

            <!-- Terms Modal -->
            <div class="modal fade" id="one-signup-terms" tabindex="-1" role="dialog" aria-labelledby="one-signup-terms" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-popout" role="document">
                    <div class="modal-content">
                        <div class="block block-rounded block-transparent mb-0">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Terms &amp; Conditions</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content">
                                <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                            </div>
                            <div class="block-content block-content-full text-end bg-body">
                                <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">I Agree</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Terms Modal -->
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
</div>
<!-- END Page Container -->

<!--
    OneUI JS

    Core libraries and functionality
    webpack is putting everything together at assets/_js/main/app.js
-->
<script src="/assets/js/oneui.app.min.js"></script>

<!-- jQuery (required for jQuery Validation plugin) -->
<script src="/assets/js/lib/jquery.min.js"></script>

<!-- Page JS Plugins -->
<script src="/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>

<!-- Page JS Code -->
<script src="/assets/js/pages/op_auth_signup.min.js"></script>

<script>

    $("#register_form").submit(function(e){
        return false;
    });


    function register(){
        $("#register_result").html("Loading...");

        if( !$("#signup-name").val() || !$("#signup-surname").val()  ||
            !$("#signup-email").val() || !$("#signup-password").val() ||
            !$("#signup-password-confirm").val() || !$("#signup-terms").is(':checked')
        ) {
            $("#register_result").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                '<h3 class="alert-heading h4 my-2">Attention</h3>'+
                '<p class="mb-0">'+
                'Missing Parameter!'+
                '</p>'+
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                '</div>');
            return;
        }

        if( $("#signup-password").val() != $("#signup-password-confirm").val()) {
            $("#register_result").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                '<h3 class="alert-heading h4 my-2">Warning</h3>'+
            '<p class="mb-0">'+
                'Password dont\'t Match!'+
            '</p>'+
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
            '</div>');
            return;
        }

        $.post('/register', {
            first_name: $("#signup-name").val(),
            last_name: $("#signup-surname").val(),
            email: $("#signup-email").val(),
            password: $("#signup-password").val(),
            locale:$("#locale").val()
        }, function(response){
            if( response.status == 'error' ) {
                $("#register_result").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                    '<h3 class="alert-heading h4 my-2">Error</h3>'+
                    '<p class="mb-0">'+
                    'Something went wrong, try again later'+
                    '</p>'+
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                    '</div>');

            } else {
                $("#register_result").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                    '<h3 class="alert-heading h4 my-2">Success</h3>'+
                    '<p class="mb-0">'+
                    'You can now do login'+
                    '</p>'+
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                    '</div>');
            }
        }).fail(function(e){
            $("#register_result").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                '<h3 class="alert-heading h4 my-2">Error</h3>'+
                '<p class="mb-0">'+
                'E-Mail already registered'+
                '</p>'+
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                '</div>');
        });
    }
</script>
</body>
</html>
