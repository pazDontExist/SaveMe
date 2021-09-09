<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>SaveMe - Login</title>

    <meta name="robots" content="noindex, nofollow">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="assets/media/favicons/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/media/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/media/favicons/apple-touch-icon-180x180.png">
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
                        <!-- Sign In Block -->
                        <div class="block block-rounded mb-0">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Sign In</h3>
                                <div class="block-options">
                                    <a class="btn-block-option fs-sm" href="op_auth_reminder.html">Forgot Password?</a>
                                    <a class="btn-block-option" href="/public/register" data-bs-toggle="tooltip" data-bs-placement="left" title="New Account">
                                        <i class="fa fa-user-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                                    <h1 class="h2 mb-1">SaveMe</h1>
                                    <div class="fw-medium text-muted login-box-msg">
                                        <?php echo __('Welcome, please login.'); ?>
                                    </div>

                                    <form class="js-validation-signin" id="login_form">
                                        <div class="py-3">
                                            <div class="mb-4">
                                                <input type="text" class="form-control form-control-alt form-control-lg" id="login-username" name="login-username" placeholder="E-Mail">
                                            </div>
                                            <div class="mb-4">
                                                <input type="password" class="form-control form-control-alt form-control-lg" id="login-password" name="login-password" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-6 col-xl-5">
                                                <button onclick="do_login()" class="btn w-100 btn-alt-primary">
                                                    <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> <?php echo __('Login');?>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END Sign In Form -->
                                </div>
                            </div>
                        </div>
                        <!-- END Sign In Block -->
                    </div>
                </div>
                <div class="fs-sm text-muted text-center">
                    <strong>SaveMe 1.0</strong> &copy; <span data-toggle="year-copy"></span>
                </div>
            </div>
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
<script src="/assets/js/pages/op_auth_signin.min.js"></script>
<script>

    $("#login_form").submit(function(e){
        return false;
    });


    function do_login(){
        $.post('/login', {
            username:$("#login-username").val(),
            password:$("#login-password").val()
        }, function(resp){
            if ( resp.status == 'success' ){
                $(".login-box-msg").html("Login Corretto, andando in dashboard");
                window.location = "/pages/home";
            } else {
                $(".login-box-msg").html("<b>E-Mail o Password errati</b>");
            }
        }).fail(function(){
            $(".login-box-msg").html("<b>E-Mail o Password errati</b>");
        });
    }
</script>
</body>
</html>